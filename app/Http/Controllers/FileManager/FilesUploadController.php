<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;
class FilesUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,web');
    }
    
    public function SingalFileUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FileName' => [
                'required','min:4','max:40','regex:/^[a-zA-Z0-9\s\.\(\)\_\-]+$/',
                Rule::unique('files','real_name'),
            ],
            'FileDescription'=>'max:255',
            'FolderId' => [
                'required','integer',
                Rule::exists('folders','id'),
            ],
            'UploadFile' => 'required|file|max:204800|mimes:jpeg,jpg,png,gif,mpeg,mpga,mp3,wav,mp4,pdf,txt,zip,7z,rar,docx,pptx,jfif', 
        ]);
        if (!($validator->passes())) {
            return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
        }

        $file=$request->file('UploadFile');
        $folder_id = $request->input('FolderId');
        if($request->hasFile('UploadFile'))
        {
            $folder_details=Folders::where('id', $folder_id)->first();

            if($folder_details->gallery){
                $path='archive/Gallery/'.$folder_details->folder_name.'/';
            }
            else{
                $path='archive/SeparateFolders/'.$folder_details->folder_name.'/';
            }

            $file_ext= strtolower($file->getClientOriginalExtension());
            switch($file_ext) {
                case 'png':
                case 'jpg':
                case 'jpeg':
                case 'jfif':
                case 'jif':
                case 'jfi':
                case 'gif':
                case 'webp':
                case 'tiff':
                case 'tif':
                case 'svg':
                case 'svgz':
                case 'psd':
                case 'raw':
                case 'bmp':
                                                
                {
                    $file_type = 'IMAGE';
                    break;
                }
                case 'mp4':
                case 'm4a':
                case 'm4v':
                case 'f4v':
                case 'm4b':
                case 'm4r':
                case 'mov':
                case '3gp':
                case '3gp2':
                case '3gpp':
                case '3gpp2':
                case 'wmv':
                case 'wma':
                case 'asf':
                case 'webm':
                                                
                {
                        $file_type = 'VIDEO';
                        break;
                }
                case 'mp3':
                case 'aac':
                case 'flac':
                case 'ogg':
                case 'wma':
                {
                    $file_type = 'AUDIO';
                    break;
                }

                case 'pdf':
                case 'txt':
                {
                    $file_type ='DOCUMENT';
                    break;
                }

                case 'zip':
                case '7z':
                case 'rar':
                {
                    $file_type ='ARCHIVE';
                    break;
                }    
            
                default:
                {
                    $file_type ='OTHER';
                    break;
                }
            }
            $new_file = new Files;
            $file_size=$file->getSize();
            $real_name= $request->input('FileName');
            $real_name=Str::substr($real_name, 0, 30).$file_ext;
            $data_name=$this->generateDataName($file_ext);
            $path=$path.$file_type;
            $file->storeAs($path.'/',$data_name,'public');  
    
            $new_file->real_name=$real_name;
            $new_file->data_name=$data_name;
            $new_file->file_type=$file_type;
            $new_file->size=$file_size;
            $new_file->file_description= $request->input('FileDescription');
            $new_file->path=$path;

            if(Auth::guard('admin')->check()){
                $new_file->approval=true;
                $new_file->user_id=Auth::guard('admin')->user()->user_id;
            }else if(Auth::guard('web')->check()){
                $new_file->user_id=Auth::guard('web')->user()->id;
            }

            $new_file->save();
            $file_id=$new_file->id;
    
            $new_folder_file = new FilesFolders;
            $new_folder_file->folders_id=$folder_id;
            $new_folder_file->is_belong= true;
            $new_file->FilesFolders()->save($new_folder_file);
            return redirect()->back()->with(['success'=>'File Uploaded Successfully']);		  
        }
        return redirect()->back()->with(['error'=>'File must want!']);		
    }

    public function MultipleFilesUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'FolderId' => [
                'required','integer',
                Rule::exists('folders','id'),
            ],
            
            'UploadFiles'=>"required|array|min:1|max:15",
            'UploadFiles.*' => 'required|file|mimes:jpeg,jpg,png,gif,mpeg,mpga,mp3,wav,mp4,pdf,txt,zip,7z,rar,docx,pptx,jfif',
        ]);
        if (!($validator->passes())) {
			return response()->json(['error'=>$validator->errors()->all()]);
        }

        $file_array=$request->file('UploadFiles');
        $folder_id = $request->input('FolderId');
	
        if($request->hasFile('UploadFiles'))
        {   
            $folder_details=Folders::where('id', $folder_id)->first();
            if($folder_details->gallery){
                $path='archive/Gallery/'.$folder_details->folder_name.'/';
            }
            else{
                $path='archive/SeparateFolders/'.$folder_details->folder_name.'/';
            }
            $file_array=$request->file('UploadFiles');
            $this->fileTypeSet($file_array,$folder_id,$path);
            return response()->json(['success'=>'Files Uploaded Successfully']);		  
        }
        return response()->json(['error'=>'Files must want!']);		  
    }

    function fileTypeSet($file_array,$folder_id,$path)
    {
        if(!($this->maximumFileSizeCheck($file_array))){
            return response()->json(['error'=>'The maximum capacity that can be uploaded is 200 MB.']);
        }
        $array_len=count($file_array); 
            for($i=0;$i<$array_len;$i++)
            {
                $file_ext= strtolower($file_array[$i]->getClientOriginalExtension());
                $file=$file_array[$i];
                        switch($file_ext) {
                            case 'png':
                            case 'jpg':
                            case 'jpeg':
                            case 'jfif':
                            case 'jif':
                            case 'jfi':
                            case 'gif':
                            case 'webp':
                            case 'tiff':
                            case 'tif':
                            case 'svg':
                            case 'svgz':
                            case 'psd':
                            case 'raw':
                            case 'bmp':
                                                            
                            {
                                $file_type = 'IMAGE';
                                $this->storeFiles($file,$file_type,$folder_id,$path);
                                continue 2;
                                
                                
                            }
    
                            
                            case 'mp4':
                            case 'm4a':
                            case 'm4v':
                            case 'f4v':
                            case 'm4b':
                            case 'm4r':
                            case 'mov':
                            case '3gp':
                            case '3gp2':
                            case '3gpp':
                            case '3gpp2':
                            case 'wmv':
                            case 'wma':
                            case 'asf':
                            case 'webm':
                                                            
                            {
                                    $file_type = 'VIDEO';
                                    $this->storeFiles($file,$file_type,$folder_id,$path);
                                    continue 2;
                                        
                                        
                            }
                            case 'mp3':
                            case 'aac':
                            case 'flac':
                            case 'ogg':
                            case 'wma':
                            {
                                $file_type = 'AUDIO';
                                $this->storeFiles($file,$file_type,$folder_id,$path);
                                continue 2;
                                
                                
                            }
    
                            case 'pdf':
                            case 'txt':
                            {
                                $file_type ='DOCUMENT';
                                $this->storeFiles($file,$file_type,$folder_id,$path);
                                continue 2;
    
                            }
    
                            case 'zip':
                            case '7z':
                            case 'rar':
                            {
                                $file_type ='ARCHIVE';
                                $this->storeFiles($file,$file_type,$folder_id,$path);
                                continue 2; 
                            }    
                        
                            default:
                            {
                                $file_type ='OTHER';
                                $this->storeFiles($file,$file_type,$folder_id,$path);
                                continue 2;   
                            }
                        }
            }
        return;
    }

    function generateDataName($file_ext)
    {
        $data_name =Str::random(5).rand(1000,9999).time().'.'.$file_ext;
        while(Files::where('data_name', $data_name)->exists()) {
            $data_name =Str::random(5).rand(1000,9999).time().'.'.$file_ext;
        }
        return $data_name;
    }
    function storeFiles($file,$file_type,$folder_id,$path)
    {
        $new_file = new Files;
        $file_ext= strtolower($file->getClientOriginalExtension());
        $file_size=$file->getSize();
        $real_name=$file->getClientOriginalName();

        $real_name=Str::substr($real_name, 0, 30);
        $data_name=$this->generateDataName($file_ext);
        $path=$path.$file_type;
        $file->storeAs($path.'/',$data_name,'public');  
        

        $i=1;
        $temp=$real_name;
        while(Files::where('real_name',$real_name)->exists()) {
            $real_name =pathinfo($temp, PATHINFO_FILENAME).'('.$i.').'.pathinfo($temp, PATHINFO_EXTENSION);
            $i=$i+1;
        }
        $new_file->real_name=$real_name;

        $new_file->data_name=$data_name;
        $new_file->file_type=$file_type;
        $new_file->size=$file_size;
        $new_file->path=$path;

        $new_file->user_id=Auth::user()->id;
        if(Auth::guard('admin')->check()){
            $new_file->approval=true;
            $new_file->user_id=Auth::user()->user_id;
        }
        $new_file->save();
        $file_id=$new_file->id;

        $new_folder_file = new FilesFolders;
        $new_folder_file->folders_id=$folder_id;
        $new_folder_file->is_belong= true;
        $new_file->FilesFolders()->save($new_folder_file);
        return;
    }



    public function HomePageFilesUpload(Request $request)
    {
        if(Auth::guard('admin')->check()){
            $validator = Validator::make($request->all(), [
                'UploadFiles'=>"required|array|min:1|max:15",
                'UploadFiles.*' => 'required|file|mimes:jpeg,jpg,png,gif',
            ]);
            
            if (!($validator->passes())) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            $file_array=$request->file('UploadFiles');
            if($request->hasFile('UploadFiles'))
            {
                if(!($this->maximumFileSizeCheck($file_array))){
                    return response()->json(['error'=>'The maximum capacity that can be uploaded is 200 MB.']);
                }
                $file_count=Files::where('see_in_homepage', '=', true)->count();
                $array_len=count($file_array);
                if(40<($file_count+$array_len))
                {
                    $array_len_error=array("The maximum number of files that can be inserted is 40 and ".(40-$file_count)." files more can be inserted.!");
                    return response()->json(['error'=>$array_len_error]);
                }
                for($i=0;$i<$array_len;$i++)
                {
                    $file=$file_array[$i];
                    $file_ext= strtolower($file->getClientOriginalExtension());
                    $file_size=$file->getSize();
                    $real_name=$file->getClientOriginalName();
                    $real_name=Str::substr($real_name, 0, 40);
                    $data_name=$this->generateDataName($file_ext);
                    $file->storeAs('archive/ImagesOfLandingPage',$data_name,'public');  
                    
                    $j=1;
                    $temp=$real_name;
                    while(Files::where('real_name',$real_name)->exists()) {
                        $real_name =pathinfo($temp, PATHINFO_FILENAME).'('.$j.').'.pathinfo($temp, PATHINFO_EXTENSION);
                        $j=$j+1;
                    }
    
                    $new_file = new Files;
                    $new_file->real_name=$real_name;
                    $new_file->data_name=$data_name;
                    $new_file->file_type='IMAGE';
                    $new_file->size=$file_size;
                    $new_file->path='archive/ImagesOfLandingPage';;
                    $new_file->see_in_homepage=true;
                  
                    if(Auth::guard('admin')->check()){
                        $new_file->approval=true;
                        $new_file->user_id=Auth::guard('admin')->user()->user_id;
                    }
                    $new_file->save();
                }
                return response()->json(['success'=>'File Uploaded Successfully']);
            }
    
        }
    }
    protected function maximumFileSizeCheck($file_array){
        $total_file_size=0;
        foreach($file_array as $file){
            $total_file_size+=$file->getSize();
        }
        if($total_file_size<=209715200){
            return true;
        }else{
            return false;
        }
    }
}
