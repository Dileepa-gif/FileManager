<?php

namespace App\DocumentHandlingAndArchive;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table ="news";
    protected $files=['news_title','news_description','news_image','user_id'];

    public function user(){

        return $this->belongsTo(User::class);
    }

}
