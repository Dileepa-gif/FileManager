<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;
use App\FileManager\FileSubmission;
use App\FileManager\FileSubmissionFileTypes;
class FileTypes extends Model
{
    protected $table ="file_types";
    protected $files=['extension'];

    public function fileSubmissionFileTypes(){
        return $this->hasMany(FileSubmissionFileTypes::class);
    }

    public function fileSubmissions()
    {
        return $this->belongsToMany(FileSubmission::class);
    }
}
