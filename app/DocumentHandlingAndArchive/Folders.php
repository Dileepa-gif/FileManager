<?php

namespace App\DocumentHandlingAndArchive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\DocumentHandlingAndArchive\Files;
use App\DocumentHandlingAndArchive\FilesFolders;
use App\DocumentHandlingAndArchive\FileSubmission;
use App\DocumentHandlingAndArchive\FileSubmissionList;

use App\User;
class Folders extends Model
{
    protected $table ="folders";
    protected $archive_folders=['folder_name','folder_description','user_id','user_name','gallery','separate','hidden_for_member','hidden_for_visitor','cover_image_path'];

    public function files()
    {
        return $this->belongsToMany(Files::class,'files_folders');
    }



    

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function FilesFolders(){
        return $this->hasMany(FilesFolders::class);
    }


}

