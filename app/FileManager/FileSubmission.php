<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;

use App\FileManager\Files;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\FileSubmissionList;
use App\FileManager\FileTypes;
use App\FileManager\FileSubmissionFileTypes;

use App\User;
use App\Admin;
class FileSubmission extends Model
{
    protected $table ="file_submissions";
    protected $files=['submission_name','submission_description','admin_id'];



    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    
    public function submissionLists(){
        return $this->hasMany(FileSubmissionList::class);
    }

    public function fileTypes()
    {
        return $this->belongsToMany(FileTypes::class,'file_submission_file_types');
    }
    public function fileSubmissionFileTypes(){
        return $this->hasMany(FileSubmissionFileTypes::class);
    }

}


