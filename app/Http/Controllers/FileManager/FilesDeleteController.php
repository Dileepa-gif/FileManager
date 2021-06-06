<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;
use App\User;
use App\Admin;
class FilesDeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,web');
    }
    public function DeleteAllFiles(Request $request){
        
        if(Auth::guard('admin')->check()){
            $ids = $request->ids;
            foreach (explode(",",$ids) as $id) {
                if (Files::where('id', $id)->exists()) {
                    $file_Delete=Files::find($id);
                    $path=$file_Delete->path;
                    if(\File::exists(storage_path('app/public/'.$path.'/'.$file_Delete->data_name))){
                        \File::delete(storage_path('app/public/'.$path.'/'.$file_Delete->data_name));
                    }
                    FilesFolders::where('files_id', $file_Delete->id)->delete();
                    $file_Delete->delete();
                }
            }
            return response()->json(['status'=>true,'message'=>"Files deleted successfully."]);
        }
        
    }


    public function DeleteMyFiles(Request $request){

        $ids = $request->ids;
        foreach (explode(",",$ids) as $id) {
            if (Files::where('id', $id)->exists()) {
                if(Auth::guard('admin')->check()){
                    $user_id=Auth::guard('admin')->user()->user_id;
                }else if(Auth::guard('web')->check()){
                    $user_id=Auth::guard('web')->user()->id;
                }
    
                $file_Delete=Files::find($id);
                if($user_id==$file_Delete->user_id){
                    $path=$file_Delete->path;
                    if(\File::exists(storage_path('app/public/'.$path.'/'.$file_Delete->data_name))){
                        \File::delete(storage_path('app/public/'.$path.'/'.$file_Delete->data_name));
                    }
                    
                    FilesFolders::where('files_id', $file_Delete->id)->delete();
                    $file_Delete->delete();
                }else{
                    $error=array("Some of these files are not yours");
                    return response()->json(['status'=>false,'message'=>$error]);
                }
            }
        }
        return response()->json(['status'=>true,'message'=>"Files deleted successfully."]);
    }

    public function deleteFilesOfUser($user_id){
        if (!(User::where('id', $user_id)->exists())) {
            return;
        }
        $delete_files=Files::where('user_id',$user_id)->get();
        foreach($delete_files as $delete_file){
                $path=$delete_file->path;
                if(\File::exists(storage_path('app/public/'.$path.'/'.$delete_file->data_name))){
                    \File::delete(storage_path('app/public/'.$path.'/'.$delete_file->data_name));
                }
            $delete_file->save();
        }
        return;
    }

}
