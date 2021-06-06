<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\FileManager\Files;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\FileSubmission;
class FileSubmissionList extends Model
{
    protected $table ="file_submission_lists";
    protected $files=['file_submission_id','user_id','status','data_name'];

    public function file_submission(){
        return $this->belongsTo(FileSubmission::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
