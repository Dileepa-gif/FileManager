<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Post;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;
use App\FileManager\News;
class ViewerController extends Controller
{

    
    public function FolderFiles($folder_id,$file_type,$view){
        if (!(Folders::where('id', $folder_id)->exists())) {
            $folder_error=array("This folder does not exist");
            return redirect()->back()->with(['error'=>$folder_error]);
        }
        $location='FILE MANAGER ';
        $params=$this->FilesFetch( $folder_id,$file_type,$view);
        $folder_type= $this->FolderType($folder_id);
        $sub_Folder_Details=Folders::where('id', '=', $folder_id)->first();                            
        $location = $location.$sub_Folder_Details->folder_name;

        $params = Arr::add($params, 'sub_Folder_Details', $sub_Folder_Details);
        $params = Arr::add($params, 'folder_type', $folder_type);

        if($folder_type=='gallery'){
            $gallery_Folders_Table=$this->GalleryFoldersList();
            $params = Arr::add($params, 'gallery_Folders_Table', $gallery_Folders_Table);
        }
        
        if($params=='ERROR')
        {
            $file_type_error=array("Wrong file type!");
            return redirect()->back()->with(['error'=>$file_type_error]);
        }
        return view('FileManager\Viewers\SubFolderFileViewer')->with($params);
    }
    
    public function FilesFetch($folder_id,$file_type, $view){
        $params=0;
        switch($file_type)
        {
            case 'ALLFILES':
                {
                    if(Auth::guard('admin')->check()){
                        $file_Table =Folders::find($folder_id)->files()->paginate(15);
                    }else{
                        $file_Table =Folders::find($folder_id)->files()->where('approval','=', 1)->paginate(15);
                    }

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

                            $file_Table =Folders::find($folder_id)->files()->where('file_type','=',$file_type)->paginate(15);
                        }else{
                            $file_Table =Folders::find($folder_id)->files()->where('file_type','=',$file_type)->where('approval','=', 1)->paginate(15);
                        }

    
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

    public function FolderType($folder_id){
        
        if((Folders::where('id',$folder_id)->where('separate',true)->exists())) {
            return 'separate';
        }

    }
    
    public function FileDetails(Request $request )
    {
        if($request->ajax()){
            if (!(Files::where('id',$request->id)->exists())) {
               return response()->json(['error'=>' ']);
            }
            $details_Of_File = Files::Find($request->id);
            if($details_Of_File->user!=null){
                $user_Name=$details_Of_File->user->name;
            }else{
                $user_Name=' ';
            }
            $list_Of_Gallery_Folder =Files::find($request->id)->folders()->where('gallery',true)->get();
            $list_Of_Separate_Folder =Files::find($request->id)->folders()->where('separate',true)->get();
            $params = [
                 'details_Of_File' => $details_Of_File,
                 'user_Name' => $user_Name,
                 'file_Description' => $details_Of_File->file_description,
                 'created_At' => date('j M Y, h:i a',strtotime($details_Of_File->created_at)), 
                 'updated_At' => date('j M Y, h:i a',strtotime($details_Of_File->updated_at)),
                 'file_Size' => round($details_Of_File->size/1048576, 3),
                 'list_Of_Gallery_Folder' => $list_Of_Gallery_Folder,
                 'list_Of_Separate_Folder' => $list_Of_Separate_Folder,
                 ];
           return response()->json($params);
        }
        else
        {
            return response()->json(['error'=>' ']);
        }
        
     }

//----------------------------------------------------------------------------------------------------------------------------------------------------------------



    public static function NotApprovedCount($folder_id,$file_type){
        if(Auth::guard('admin')->check()){
            switch($file_type)
            {
                case 'ALLFILES':
                    {
                        return Folders::find($folder_id)->files()->where('approval','=', 0)->count();
                        break;
    
                    }
    
                case 'IMAGE':
                case 'VIDEO':
                case 'AUDIO':
                case 'DOCUMENT':
                case 'ARCHIVE':
                case 'OTHER':
                    {
                        return Folders::find($folder_id)->files()->where('approval','=', 0)->count();
                        break;
                    }
    
                default:
                    {
                        return 0;
                    }    
            }
        }
 
    }


    public  function SeparateFolders(){
        $separate_Folders_Table= $this->SeparateFoldersList();
        return view('FileManager\Viewers\FolderViewer')->with('separate_Folders_Table',$separate_Folders_Table);
    }


    public static function SeparateFoldersList(){
        if(Auth::guard('admin')->check()){
            return Folders::where('separate',true)->get();
        }else if(Auth::guard('web')->check()){
            return Folders::where('separate',true)->where('hidden_for_member', '!=',true )->get();
        }else{
            return Folders::where('separate',true)->where('hidden_for_visitor', '!=',true )->get();
        }
    } 


}       

