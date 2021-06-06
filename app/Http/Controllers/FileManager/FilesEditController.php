<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use File;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;

class FilesEditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    function GetDetails($id)
    {
        if (!(Files::where('id', $id)->exists())) {
          return redirect()->back()->with(['error'=>"This file does not exist"]);
        }
        $file_Edit=Files::find($id);
        $shared_Folders= Files::find($id)->folders()->wherePivot('is_belong','=',false)->get();
        $all_Folders=Folders::all();
        $Original_Folder =Files::find($id)->folders()->wherePivot('is_belong','=',true)->first();

        $params = [
                    'Original_Folder' => $Original_Folder,
                    'shared_Folders' => $shared_Folders,
                    'all_Folders' => $all_Folders,
                    'file_Edit' => $file_Edit,
                  ];
        return view('FileManager\layout\FileEditForm')->with($params);
    }



    function UpdateDetails(Request $request,$id)
    {
       $request->validate([
          'Name' => [
                'required','min:4','max:40','regex:/^[a-zA-Z0-9\s\.\(\)\_\-]+$/',
                Rule::unique('files','real_name')->ignore($id,'id'),
          ],
          'Description'=>'max:255',
          'ApproveFile'=>'boolean',
          'SeeInGallery'=>'boolean',
          'SeeInHomePage'=> 'boolean',
          'FoldersId'    => 'array',
          'FoldersId.*' => [
              'required','integer',
              Rule::exists('folders','id'),
          ],
        ]);
    
      if (!(Files::where('id', $id)->exists())) {
        return redirect()->back()->with(['error'=>'This file does not exist']);
      }
      if($request->input('SeeInHomePage')==1){
        $file_count=Files::where('see_in_homepage', '=', true)->count();
        if(40<($file_count+1)){ 
          return redirect()->back()->with(['error'=>'The maximum number of files that can be inserted is 40, and ".(40-$file_count)." more files can be inserted!']);
        }
      }
     
      $file_Update=Files::find($id);
      
      $real_name=$request->input('Name');
      $file_Update->real_name=$real_name;

      $file_Update->file_description=$request->input('Description');


      if($request->input('ApproveFile')==1)
      {
        $file_Update->approval=true;
      }
      else if($request->input('ApproveFile')!=1)
      {
        $file_Update->approval=false;
      }

      if($request->input('SeeInGallery')==1)
      {
          if($request->input('ApproveFile')==1){
            $file_Update->see_in_gallery=true;
          }
          if($file_Update->approval==true){
            $file_Update->see_in_gallery=true;
          }
      }
      else if($request->input('SeeInGallery')!=1)
      {
        $file_Update->see_in_gallery=false;
      }

      if($file_Update->path=="archive/ImagesOfLandingPage"){
        $file_Update->see_in_homepage=true;
      }else{
        if($request->input('SeeInHomePage')==1)
        {
          if($file_Update->file_type!="IMAGE"){
            return redirect()->back()->with(['error'=>'Only image type files can be inserted for the landing page !']);
          }
          $file_Update->see_in_homepage=true;
        }
        else if($request->input('SeeInHomePage')!=1)
        {
          $file_Update->see_in_homepage=false;
        }
      }
           

      $folder_id_array=$request->input('FoldersId');
      $files_Folders=FilesFolders::where('files_id',$id)->where('is_belong','=',false)->get();
      foreach($files_Folders as $filesFolders){
        $status=0;
        if($folder_id_array!=null){
          foreach($folder_id_array as $folder_id){
              if($folder_id==$filesFolders->folders_id){
                  $status=1;
                  break;
              }
          }
        }
        if($status==0){
            FilesFolders::where('folders_id',$filesFolders->folders_id)->where('files_id',$id)->where('is_belong','=',false)->delete();
        }
      }
      if($folder_id_array!=null){
        foreach($folder_id_array as $folder_id){
            if(!(FilesFolders::where('folders_id',$folder_id)->where('files_id',$id)->exists())){
              $update_Folder_List= new FilesFolders;
              $update_Folder_List->folders_id=$folder_id;
              $update_Folder_List->files_id=$id;
              $update_Folder_List->is_belong=false;
              $update_Folder_List->SAVE();
            }
        }
      }

      $file_Update->save();
      return redirect()->back()->with(['success'=>'Files update successful']);

    }

    public function MultipleApprove(Request $request){
      $validator = Validator::make($request->all(), [
          'ids'=>"required|min:1",
      ]);
      if (!($validator->passes())) {
          $message='';
          foreach($validator->errors()->all() as $error){
              $message=$message.' '.$error;
          }
          return response()->json(['status'=>false,'message'=>$message]);
      }
      $ids = $request->ids;
      foreach (explode(",",$ids) as $id) {
          if (Files::where('id', $id)->where('approval', false)->exists()) {
            $file_approve=Files::find($id);
            $file_approve->approval=1;
            $file_approve->save();
          }
      }
      return response()->json(['status'=>true,'message'=>"Files approval was successful."]);
  }
}
