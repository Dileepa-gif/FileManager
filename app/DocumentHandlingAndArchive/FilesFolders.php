<?php

namespace App\DocumentHandlingAndArchive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\DocumentHandlingAndArchive\Files;
use App\DocumentHandlingAndArchive\Folders;
use App\DocumentHandlingAndArchive\FileSubmission;
use App\DocumentHandlingAndArchive\FileSubmissionList;
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
