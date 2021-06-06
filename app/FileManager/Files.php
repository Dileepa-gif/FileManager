<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\FileSubmission;
use App\FileManager\FileSubmissionList;
class Files extends Model
{
    protected $table ="files";
    protected $files=['data_name','real_name','file_type','size','file_description','path','user_id','see_in_gallery','see_in_homepage','approval'];

    public function FilesFolders(){
        return $this->hasMany(FilesFolders::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function folders()
    {
        return $this->belongsToMany(Folders::class);
    }








    /////////////////////////////////////////////////////////////////
   /*  public static function ApprovedAllFiles($folders_id)
    {
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.approval', '=',1 )
                                ->select('files.*')
                                ->get();
  
        return $FilesList;
    }
    public static function ApprovedTypeFiles($folders_id,$file_type)
    {
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.file_type', '=',$file_type )
                                ->where('files.approval', '=',1 )
                                ->select('files.*')
                                ->get(); 
        return $FilesList;
    }

    public static function NotApprovedAllFiles($folders_id)
    {
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.approval', '=',0 )
                                ->select('files.*')
                                ->get();
  
        return $FilesList;
    }
    public static function NotApprovedTypeFiles($folders_id,$file_type)
    {
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.file_type', '=',$file_type )
                                ->where('files.approval', '=',0 )
                                ->select('files.*')
                                ->get(); 
        return $FilesList;
    }

    public static function AllFiles($folders_id)
    {
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->select('files.*')
                                ->get();
  
        return $FilesList;
    }
    public static function TypeFiles($folders_id,$file_type)
    {
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.file_type', '=',$file_type )
                                ->select('files.*')
                                ->get(); 
        return $FilesList;
    }

   
    public static function OwnAllFiles($folders_id,$user_id){
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.user_id', '=',$user_id )
                                ->select('files.*')
                                ->get(); 
    return $FilesList;
    }
    public static function OwnTypeFiles($folders_id,$file_type, $user_id){
        $FilesList =DB::table('folders')
                                ->join('files_folders', 'folders.id', '=', 'files_folders.folders_id')
                                ->join('files', 'files.id', '=', 'files_folders.files_id')
                                ->where('folders.id', '=',$folders_id)
                                ->where('files.user_id', '=',$user_id )
                                ->where('files.file_type', '=',$file_type )
                                ->select('files.*')
                                ->get(); 
    return $FilesList;
    }
    */

}