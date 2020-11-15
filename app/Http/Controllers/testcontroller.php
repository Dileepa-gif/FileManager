<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tab1;

class testcontroller extends Controller
{
    function upload (Request $request)
    {
        if($request->hasFile('img'))
        {
            $image_array=$request->file('img');
            $array_len=count($image_array);
            echo $array_len; 
            for($i=0;$i<$array_len;$i++)
            {
                $image_size=$image_array[$i]->getSize();
                $image_ext=$image_array[$i]->getClientOriginalExtension();
                $new_image_name=rand(123456,999999).".".$image_ext;
                $destination_path=public_path('/images');
                $image_array[$i]->move($destination_path,$new_image_name);
                $tab1=new tab1;
                $tab1->image_name=$new_image_name;
                $tab1->image_size=$image_size;
            }
            return redirect()->back()->with('msg','All images uploade sucdessfully');
           
        }
        else
        {
            return back()-> with('msg','Please choose any image');
        }
    }
}
