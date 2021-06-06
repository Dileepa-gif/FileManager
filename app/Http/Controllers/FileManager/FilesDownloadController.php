<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


use App\Post;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;

class FilesDownloadController extends Controller
{
    public function DownloadFiles($id){
        if (!(Files::where('id',$id)->exists())) {
            return redirect()->back()->with(['error'=>"This file does not exist"]);
        }
        $file_Donwload=Files::find($id);
        $path=$file_Donwload->path;
        if(\File::exists(storage_path('app/public/'.$path.'/'.$file_Donwload->data_name))){
            return response()->download((storage_path('app/public/'.$path.'/'.$file_Donwload->data_name)),$file_Donwload->data_name);
        }	
        return redirect()->back()->with(['error'=>"This file does not exist"]);
    }

    public function DownloadBlogImage($id){
        if (!(Post::where('id',$id)->exists())) {
            return redirect()->back()->with(['error'=>'This blog image does not exist']);
        }
        $image_Donwload=Post::find($id);
        if(\File::exists(storage_path('app/public/blogDonationImages/post_images/'.$image_Donwload->image))){
            return response()->download((storage_path('app/public/blogDonationImages/post_images/'.$image_Donwload->image)));
        }
        return redirect()->back()->with(['error'=>'This blog image does not exist']);
    }


    
}
