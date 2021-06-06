<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\FileManager\Files;
use App\FileManager\FilesFolders;
use App\FileManager\FileSubmission;
use App\FileManager\FileSubmissionList;



use App\User;
use App\Admin;

class Folders extends Model
{
    protected $table ="folders";
    protected $archive_folders=['folder_name','folder_description','admin_id','gallery','separate','hidden_for_member','hidden_for_visitor','cover_image_path'];

    public function files()
    {
        return $this->belongsToMany(Files::class,'files_folders');
    }


    public function admin(){

        return $this->belongsTo(Admin::class);
    }

    public function FilesFolders(){
        return $this->hasMany(FilesFolders::class);
    }


}

