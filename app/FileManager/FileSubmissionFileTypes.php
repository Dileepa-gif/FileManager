<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;
use App\FileManager\FileSubmission;
use App\FileManager\FileTypes;
class FileSubmissionFileTypes extends Model
{
    protected $table ="file_submission_file_types";
    protected $files=['file_submission_id','file_type_id'];

    public function fileSubmission(){

        return $this->belongsTo(FileSubmission::class);
    }

    public function fileType(){

        return $this->belongsTo(FileTypes::class);
    }
}