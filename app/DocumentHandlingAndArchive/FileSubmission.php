<?php

namespace App\DocumentHandlingAndArchive;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\DocumentHandlingAndArchive\Files;
use App\DocumentHandlingAndArchive\Folders;
use App\DocumentHandlingAndArchive\FilesFolders;
use App\DocumentHandlingAndArchive\FileSubmissionList;
class FileSubmission extends Model
{
    protected $table ="file_submissions";
    protected $files=['submission_name','submission_description','creater_id'];



    public function creater(){
        return $this->belongsTo(User::class);
    }
    
    public function submissionLists(){
        return $this->hasMany(FileSubmissionList::class);
    }

}


