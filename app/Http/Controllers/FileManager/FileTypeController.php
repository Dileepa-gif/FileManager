<?php

namespace App\Http\Controllers\FileManager;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\FileManager\FileTypes;

class FileTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function FileType(){
        $file_Type= FileTypes::all();
        $params = [
            'file_Type' => $file_Type,
            ];
        return view('FileManager\layout\SubmissionFileType')->with($params);
    }
    public function Add(Request $request){
        $request['FileExtension'] = Str::lower($request['FileExtension']);
        $request->validate([
            'FileExtension' => [
                'required','alpha_num',
                Rule::in('jpeg','jpg','png','gif','mpeg','mpga','mp3','mp4','pdf','txt','zip','7z','rar','docx','pptx','jfif'),
                Rule::unique('file_types','extension'),
            ], 
        ]);
        $new_file_type = new FileTypes;
        $new_file_type->extension=Str::lower( $request->input('FileExtension'));
        $new_file_type->save();
        return redirect()->back()->with(['success'=>"Submission file extension added successfuly"]);
    }

    public function Remove($id){
        if (!(FileTypes::where('id', $id)->exists())) {
            return redirect()->back()->with(['error'=>"This extension not exists"]);
        }
        FileTypes::find($id)->delete();
        return redirect()->back()->with(['success'=>"Submission file extension deleted successfuly"]);
    }

    
}
