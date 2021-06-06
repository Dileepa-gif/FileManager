<?php

namespace App\FileManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\FileManager\Files;
use App\FileManager\Folders;
use App\FileManager\FileSubmission;
use App\FileManager\FileSubmissionList;
use App\User;
class FilesFolders extends Model
{
    protected $table ="files_folders";
    protected $archive_folders_files=['files_id','folders_id','is_belong'];

    public function File(){

        return $this->belongsTo(Files::class);
    }

    public function Folder(){

        return $this->belongsTo(Folders::class);
    }
}
