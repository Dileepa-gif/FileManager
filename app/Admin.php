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

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','email','title','mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'password',
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    
    public function getPasswordAttribute(){
        return $this->user->getAttribute('password');
    }
    
    public function getAuthPassword(){
        return $this->user->getAttribute('password');
    }


    
   /******** DHAA ********/

   public function folders(){
        return $this->hasMany(Folders::class,'folder_id','id');
    }

    public function news(){
        return $this->hasMany(News::class);
    }
    public function file_submissions(){
        return $this->hasMany(FileSubmission::class);
    }
    /****************************/

}
