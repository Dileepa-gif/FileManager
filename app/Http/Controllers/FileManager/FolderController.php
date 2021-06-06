<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use File;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;

class FolderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    function FolderCreate(Request $request){
        if(Auth::guard('admin')->check()){    
            $validator = Validator::make($request->all(), [
                'FolderName' => [
                    'required','min:2','max:60','regex:/^[a-zA-Z0-9\s\(\)\_\-]+$/',
                    Rule::unique('folders','folder_name')->where(function ($query) {
                        return $query->where('separate', true);
                    }),
                ],
                'FolderCoverImage' => 'required|mimes:jpeg,jpg,png,gif', 
                'FolderDescription'=>'required',
                'hideFromMember'=>'boolean',
                'hideFromVisitor'=>'boolean',
            ]);
    
            if (!($validator->passes())) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            if($request->hasFile('UploadFiles')){
                $files_validator = Validator::make($request->all(), [
                    'UploadFiles.*' => 'mimes:jpeg,jpg,png,gif,mpeg,mpga,mp3,wav,mp4,pdf,txt,zip,7z,rar,docx',
                ]);
                if (!($files_validator->passes())) {
                    return response()->json(['error'=>$files_validator->errors()->all()]);
                }
            }

            if($request->hasFile('FolderCoverImage')){
                $folder_name = $request->input('FolderName');
                $folder_cover_image = $request->file('FolderCoverImage');
                $folder_description=  $request->input('FolderDescription');

                $new_folder = new Folders;
                $FolderPath = storage_path('/app/public/archive/SeparateFolders/').$folder_name;
                if(!File::isDirectory($FolderPath)){
                    File::makeDirectory($FolderPath, 0777, true, true);
                }
                $cover_image_ext=strtolower($folder_cover_image->getClientOriginalExtension());
                $folder_cover_image->storeAs('archive/SeparateFolders/'.$folder_name,'cover.'.$cover_image_ext,'public');  
                $cover_image_path='cover.'.$cover_image_ext;

                $new_folder->gallery=false;
                $new_folder->separate=true;
                $new_folder->folder_name=$folder_name;
                $new_folder->folder_description=$folder_description;
                $new_folder->cover_image_path=$cover_image_path;

                if($request->input('hideFromMember')==1){
                    $new_folder->hidden_for_member=true;
                }else{
                    $new_folder->hidden_for_member=false;
                }

                if($request->input('hideFromVisitor')==1){
                    $new_folder->hidden_for_visitor=true;
                }else{
                    $new_folder->hidden_for_visitor=false;
                }

                if(Auth::guard('admin')->check()){
                    $new_folder->admin_id=Auth::guard('admin')->user()->id;
                }
                             
                $pathIamge = $FolderPath.'/IMAGE';
                $pathVideo = $FolderPath.'/VIDEO';
                $pathAudio = $FolderPath.'/AUDIO';
                $pathDocument = $FolderPath.'/DOCUMENT';
                $pathArchive = $FolderPath.'/ARCHIVE';
                $pathOther = $FolderPath.'/OTHER';
    
                $this->createFolder($pathIamge);
                $this->createFolder($pathVideo);
                $this->createFolder($pathAudio);
                $this->createFolder($pathDocument);
                $this->createFolder($pathArchive);
                $this->createFolder($pathOther);
                
                $new_folder->save();  
                $folder_id= $new_folder->id;
                $path='archive/SeparateFolders/'.$folder_name.'/';
                if($request->hasFile('UploadFiles')){
                    $file_array=$request->file('UploadFiles');
                    app('App\Http\Controllers\FileManager\FilesUploadController')->fileTypeSet($file_array,$folder_id,$path);
                }else{
                    return response()->json(['success'=>'Folder Created Successfully']);
                }
                return response()->json(['success'=>'Files Uploaded Successfully']);
            }
        }
    }


    
    function AlbumCreater(Request $request){
        if(Auth::guard('admin')->check()){    
            $validator = Validator::make($request->all(), [
                'FolderName' => [
                    'required','min:2','max:60','regex:/^[a-zA-Z0-9\s\(\)\_\-]+$/',
                    Rule::unique('folders','folder_name')->where(function ($query) {
                        return $query->where('gallery', true);
                    }),
                ],
                'FolderCoverImage' => 'required|mimes:jpeg,jpg,png,gif', 
                'FolderDescription'=>'required',
                'hideFromMember'=>'boolean',
                'hideFromVisitor'=>'boolean',
            ]);
    
            if (!($validator->passes())) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            if($request->hasFile('UploadFiles')){
                $files_validator = Validator::make($request->all(), [
                    'UploadFiles.*' => 'mimes:jpeg,jpg,png,gif,mpeg,mpga,mp3,wav,mp4,pdf,txt,zip,7z,rar,docx',
                ]);
                if (!($files_validator->passes())) {
                    return response()->json(['error'=>$files_validator->errors()->all()]);
                }
            }

            if($request->hasFile('FolderCoverImage')){
                $folder_name = $request->input('FolderName');
                $folder_cover_image = $request->file('FolderCoverImage');
                $folder_description=  $request->input('FolderDescription');

                $new_folder = new Folders;
                $FolderPath = storage_path('/app/public/archive/GalleryFolders/').$folder_name;
                if(!File::isDirectory($FolderPath)){
                    File::makeDirectory($FolderPath, 0777, true, true);
                }
                $cover_image_ext=strtolower($folder_cover_image->getClientOriginalExtension());
                $folder_cover_image->storeAs('archive/GalleryFolders/'.$folder_name,'cover.'.$cover_image_ext,'public');  
                $cover_image_path='cover.'.$cover_image_ext;

                $new_folder->gallery=true;
                $new_folder->separate=false;
                $new_folder->folder_name=$folder_name;
                $new_folder->folder_description=$folder_description;
                $new_folder->cover_image_path=$cover_image_path;

                if($request->input('hideFromMember')==1){
                    $new_folder->hidden_for_member=true;
                }else{
                    $new_folder->hidden_for_member=false;
                }

                if($request->input('hideFromVisitor')==1){
                    $new_folder->hidden_for_visitor=true;
                }else{
                    $new_folder->hidden_for_visitor=false;
                }

                if(Auth::guard('admin')->check()){
                    $new_folder->admin_id=Auth::guard('admin')->user()->id;
                }           
                $pathIamge = $FolderPath.'/IMAGE';
                $pathVideo = $FolderPath.'/VIDEO';
                $pathAudio = $FolderPath.'/AUDIO';
                $pathDocument = $FolderPath.'/DOCUMENT';
                $pathArchive = $FolderPath.'/ARCHIVE';
                $pathOther = $FolderPath.'/OTHER';
    
                $this->createFolder($pathIamge);
                $this->createFolder($pathVideo);
                $this->createFolder($pathAudio);
                $this->createFolder($pathDocument);
                $this->createFolder($pathArchive);
                $this->createFolder($pathOther);
                
                $new_folder->save();  
                $folder_id= $new_folder->id;
                $path='archive/GalleryFolders/'.$folder_name.'/';
                if($request->hasFile('UploadFiles')){
                    $file_array=$request->file('UploadFiles');
                    app('App\Http\Controllers\FileManager\FilesUploadController')->fileTypeSet($file_array,$folder_id,$path);
                }else{
                    return response()->json(['success'=>'Folder Created Successfully']);
                }
                return response()->json(['success'=>'Files Uploaded Successfully']);
            }
        }
    }


    protected function createFolder($folder_path)
    {
        if(!File::isDirectory($folder_path)){
            File::makeDirectory($folder_path, 0777, true, true);
        }
        return ;
    }

    public function FolderDelete(Request $request){
        if(Auth::guard('admin')->check()){

            $validator = Validator::make($request->all(), [
                'Folders'=>"required|array|min:1",
                'Folders.*' => [
                    'required','integer',
                    Rule::exists('folders','id'),
                ]
                
            ]);
            if (!($validator->passes())) {
                $message='';
                foreach($validator->errors()->all() as $error){
                    $message=$message.' '.$error;
                }
                return response()->json(['status'=>false,'message'=>$message]);
            }
            $ids=$request->input('Folders');
            foreach ($ids as $id){
                $folder_delete=Folders::find($id);           
                if($folder_delete->gallery){
                    if(\File::exists(storage_path('/app/public/archive/GalleryFolders/'.$folder_delete->folder_name))){
                        \File::deleteDirectory(storage_path('/app/public/archive/GalleryFolders/'.$folder_delete->folder_name));
                    }
                }else{
                    if(\File::exists(storage_path('/app/public/archive/SeparateFolders/'.$folder_delete->folder_name))){
                        \File::deleteDirectory(storage_path('/app/public/archive/SeparateFolders/'.$folder_delete->folder_name));
                    }
                }
                $folders_files_list=FilesFolders::where('folders_id', $id)->get();
                foreach($folders_files_list as $file_id){  
                    if($file_id->is_belong==1){
                        Files::where('id', $file_id->files_id)->delete();
                    }
                }
                $folder_delete->delete();
            }
            return response()->json(['status'=>true,'message'=>"Folders deleted successfully."]);
        }
      
    }


    public function GetDetails($id)
    {
        if(Auth::guard('admin')->check()){
            if (!(Folders::where('id', $id)->exists())) {
                return redirect()->back()->with(['error'=>"This folder not exists!!"]);
            }
            $Folder_Edit =Folders::find($id);
            return view('FileManager\layout\FolderEditForm')->with('Folder_Edit',$Folder_Edit);
        }
    }

    public function UpdateDetails(Request $request,$id)
    {
        if(Auth::guard('admin')->check()){
            if (!(Folders::where('id', $id)->exists())) {
                $id_error=array("This folder does not exist");
                return redirect()->back()->with(['error'=>$id_error]);
            }
            $request->validate([
                'FolderName' => [
                    'required','min:2','max:60','regex:/^[a-zA-Z0-9\s\(\)\_\-]+$/',
                    Rule::unique('folders','folder_name')->where(function ($query) use($id) {
                        if(Folders::where('id', $id)->where('gallery', true)->exists()){
                            return $query->where('gallery', true);
                        }else{
                            return $query->where('separate', true);
                        }
                    })->ignore($id,'id'),
                ],
                'FolderCoverImage' => 'mimes:jpeg,jpg,png,gif', 
                'FolderDescription'=>'required|max:50',
                'hideFromMember'=>'boolean',
                'hideFromVisitor'=>'boolean',
              ]);

            $folder_Update=Folders::find($id);
           
            $cover_image_path=$folder_Update->cover_image_path;
            $folder_name=$folder_Update->folder_name;


            if($folder_Update->gallery){
                if($request->hasFile('FolderCoverImage')){
                    if(\File::exists(storage_path( 'app/public/archive/GalleryFolders/'.$folder_Update->folder_name.'/'.$folder_Update->cover_image_path))){
                        \File::delete(storage_path( 'app/public/archive/GalleryFolders/'.$folder_Update->folder_name.'/'.$folder_Update->cover_image_path));
                    }
                    $folder_cover_image=$request->file('FolderCoverImage');
                    $cover_image_ext=strtolower($folder_cover_image->getClientOriginalExtension());
                    $folder_cover_image->storeAs('archive/GalleryFolders/'.$folder_name,'cover.'.$cover_image_ext,'public');
                    $folder_Update->cover_image_path='cover.'.$cover_image_ext;
                }

            }else{
                if($request->hasFile('FolderCoverImage')){
                    if(\File::exists(storage_path('app/public/archive/SeparateFolders/'.$folder_Update->folder_name.'/'.$folder_Update->cover_image_path))){
                        \File::delete(storage_path( 'app/public/archive/SeparateFolders/'.$folder_Update->folder_name.'/'.$folder_Update->cover_image_path));
                    }
                    $folder_cover_image=$request->file('FolderCoverImage');
                    $cover_image_ext=strtolower($folder_cover_image->getClientOriginalExtension());
                    $folder_cover_image->storeAs('archive/SeparateFolders/'.$folder_name,'cover.'.$cover_image_ext,'public');  
                    $folder_Update->cover_image_path='cover.'.$cover_image_ext;
                }
            }           
           if($request->input('hideFromMember')==1){
                $folder_Update->hidden_for_member=true;
            }else{
                $folder_Update->hidden_for_member=false;
            }

            if($request->input('hideFromVisitor')==1){
                $folder_Update->hidden_for_visitor=true;
            }else{
                $folder_Update->hidden_for_visitor=false;
            }

            $folder_Update->folder_description=$request->input('FolderDescription');
            if(Auth::guard('admin')->check()){
                $folder_Update->admin_id=Auth::guard('admin')->user()->id;
            } 
            if(($folder_Update->folder_name)!=($request->input('FolderName'))){
                $folder_name = $request->input('FolderName');
                if($folder_Update->gallery){
                    Storage::move('public/archive/GalleryFolders/'.$folder_Update->folder_name,'public/archive/GalleryFolders/'.$folder_name);
                }else{
                    Storage::move('public/archive/SeparateFolders/'.$folder_Update->folder_name,'public/archive/SeparateFolders/'.$folder_name);
                }
                $folder_Update->folder_name= $folder_name;
            }
            $folder_Update->save();
            return redirect()->back()->with(['success'=>'Update Successfully']);
        }
        return redirect()->back()->with(['error'=>'']);    
    }


    

}
