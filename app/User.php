<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\FileManager\Files;
use App\FileManager\FilesFolders;
use App\FileManager\FileSubmission;
use App\FileManager\FileSubmissionList;
use App\FileManager\Folders;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /******** DHAA ********/
    public function files(){
        return $this->hasMany(Files::class,'file_id','id');
    }

    public function submissionsList(){
        return $this->hasMany(FileSubmissionList::class);
    }
    /****************************/
}
