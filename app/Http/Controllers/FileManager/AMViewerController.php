<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;




use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;

class AMViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,web');
    }
    
    public function FolderMyFiles($folder_id,$my_files,$file_type,$view){
        if((Auth::guard('admin')->check())||(Auth::guard('web')->check())){
            if (!(Folders::where('id', $folder_id)->exists())) {
                return redirect()->back()->with(['error'=>"This folder does not exist"]);
            }
            $params=$this->MyFilesFetch( $folder_id,$file_type,$view);
           
            $sub_Folder_Details =Folders::where('id', '=', $folder_id)->first();    
            $folder_type= app('App\Http\Controllers\FileManager\ViewerController')->FolderType($folder_id);
    
            $params = Arr::add($params, 'my_files', $my_files);
            $params = Arr::add($params, 'sub_Folder_Details', $sub_Folder_Details);

            if($folder_type=='gallery'){
                $gallery_Folders_Table= app('App\Http\Controllers\FileManager\ViewerController')->GalleryFoldersList();
                $params = Arr::add($params, 'gallery_Folders_Table', $gallery_Folders_Table);
            }
    
            if($params=='ERROR'){
                return redirect()->back()->with(['error'=>'Wrong file type!']);
            }
            return view('FileManager\Viewers\MyFolderFilesViewer')->with($params);
    
        }
    }

    public function MyFilesFetch($folder_id,$file_type, $view){
        if((Auth::guard('admin')->check())||(Auth::guard('web')->check())){
            $params=0;
            switch($file_type)
            {
                case 'ALLFILES':
                    {
                        if(Auth::guard('admin')->check()){
                            $user_id=Auth::guard('admin')->user()->user_id;
                        }else if(Auth::guard('web')->check()){
                            $user_id=Auth::guard('web')->user()->id;
                        }
                        
                       $file_Table =Folders::find($folder_id)->files()->where('user_id','=',$user_id)->paginate(15);
                        $params = [
                            'file_Table' => $file_Table,
                            'file_type' => $file_type,
                            'view' => 'LIST',
                            ];
    
                        return $params;
                        break;
                    }
                    case 'IMAGE':
                    case 'VIDEO':
                    case 'AUDIO':
                    case 'DOCUMENT':
                    case 'ARCHIVE':
                    case 'OTHER':
                        {
                            if(Auth::guard('admin')->check()){
                                $user_id=Auth::guard('admin')->user()->user_id;
                            }else if(Auth::guard('web')->check()){
                                $user_id=Auth::guard('web')->user()->id;
                            }
                            
                           $file_Table =Folders::find($folder_id)->files()->where('file_type','=',$file_type)->where('user_id','=',$user_id)->paginate(15);
                            if(($file_type=='IMAGE')||($file_type=='VIDEO')){
                                $view=$view;
                            }else{
                                $view='LIST';
                            }
    
                            $params = [
                                'file_Table' => $file_Table,
                                'file_type' => $file_type,
                                'view' => $view,
                                ];
                                
                            return $params;
                            break;
                        }
    
                    default:
                        {
                            return $params='ERROR';
                        }    
            } 
    
        }
    }
}
