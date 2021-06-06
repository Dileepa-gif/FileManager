<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Validation\Rule;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;
use App\FileManager\FileSubmission;
use App\FileManager\FileSubmissionList;
use App\FileManager\FileTypes;
use App\FileManager\FileSubmissionFileTypes;
use App\User;
use App\Admin;
use ZipArchive;
class FileSubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin,web');
    }
    public function AllFileSubmissions(){
        if(Auth::guard('admin')->check()){
            
            $submission_Table=FileSubmission::all();
            $users= User::all();
            $params = [
                'submission_Table' => $submission_Table,
                ];
            return view('FileManager\Viewers\AdminSubmissionViewer')->with($params);
        }
    }

    public function CreateForm(){
        $users= User::all();
        $file_Type= FileTypes::all();
        $params = [
            'users' => $users,
            'file_Type' => $file_Type,
            ];
        return view('FileManager\layout\FileSubmissionCreater')->with($params);
    }

    public function Creater(Request $request){
        if(Auth::guard('admin')->check()){
            $request->validate([
                'SubmissionName' => [
                    'required','min:2','max:80','regex:/^[a-zA-Z0-9\s\(\)\_\-]+$/',
                    Rule::unique('file_submissions','submission_name')
                ],
                'SubmissionDescription'=>'required|min:4|max:255',

                "AssignedUsers"    => "required|array|min:1",
                'AssignedUsers.*' => [
                    'required','integer',
                    Rule::exists('users','id'),
                ],

                "FileExtensions"    => "required|array|min:1",
                'FileExtensions.*' => [
                    'required','integer',
                    Rule::exists('file_types','id'),
                ],
                
              ]);
              
            if(count((array)($request->input('AssignedUsers')))>0){
                $user_id_array=$request->input('AssignedUsers');
                $file_extention_id_array=$request->input('FileExtensions');
                $submission_name=$request->input('SubmissionName');
                $submission_description = $request->input('SubmissionDescription');
                $new_submission=new FileSubmission;
                $new_submission->submission_name=$submission_name;
                $new_submission->submission_description=$submission_description;        
                

                if(Auth::guard('admin')->check()){
                    $new_submission->admin_id=Auth::guard('admin')->user()->id;
                }
                $new_submission->save();
        
                $user_array_len=count($user_id_array); 
                for($i=0;$i<$user_array_len;$i++){
                    if(User::where('id',$user_id_array[$i])->exists()){
                        $new_submission_item=new FileSubmissionList;
                        $new_submission_item->file_submission_id=$new_submission->id;
                        $new_submission_item->user_id= $user_id_array[$i];
                        $new_submission_item->save();
                    }
                }

                $extension_array_len=count($file_extention_id_array); 
                for($i=0;$i<$extension_array_len;$i++){
                    if(FileTypes::where('id',$file_extention_id_array[$i])->exists()){ 
                        $new_extension_item=new FileSubmissionFileTypes;
                        $new_extension_item->file_submission_id=$new_submission->id;
                        $new_extension_item->file_types_id= $file_extention_id_array[$i];
                        $new_extension_item->save();
                    }
                }

                return redirect()->route('AllFileSubmissions.Show')->with(['success'=>"Submission created successfuly"]);
            }
            return redirect()->back()->with(['error'=>"The user list is a must!"]);
        }
    }

    public function Delete(Request $request){
        if(Auth::guard('admin')->check()){

            $validator = Validator::make($request->all(), [
                'Submissions'=>"required|array|min:1",
                'Submissions.*' => [
                    'required','integer',
                    Rule::exists('file_submissions','id'),
                ]
                
            ]);
            if (!($validator->passes())) {
                $message='';
                foreach($validator->errors()->all() as $error){
                    $message=$message.' '.$error;
                }
                return response()->json(['status'=>false,'message'=>$message]);
            }

            if(count((array)($request->input('Submissions')))>0){
                $ids=$request->input('Submissions');
                foreach ($ids as $id){
                   $this->Delete_Submission($id);
                }
                return response()->json(['status'=>true,'message'=>"Submission deleted successfully."]);
            }
            return response()->json(['status'=>false,'message'=>"There is no submission in request for delete"]);
        }
    }
    protected function Delete_Submission($id){
        $submission_delete=FileSubmission::find($id);
        $zipName = $id.'.zip';
        if(\File::exists(storage_path('app\\FileSubmissionZips\\'.$zipName))){
            \File::delete(storage_path('app\\FileSubmissionZips\\'.$zipName));
        }

        $submission_list=FileSubmissionList::where('file_submission_id', $id)->get();
        foreach($submission_list as $submission){  
            if(\File::exists(storage_path('app\\FileSubmission\\'.$submission->data_name))){
                \File::delete(storage_path('app\\FileSubmission\\'.$submission->data_name));
            }
        }
        $submission_delete->delete();
        return;
    }

    public function GetDetails($id){
        if(Auth::guard('admin')->check()){
            if (!(FileSubmission::where('id', $id)->exists())) {
                return redirect()->back()->with(['error'=>"This submission not exists!!"]);
            }
            $submission=FileSubmission::find($id); 
            $users= User::all();
            $file_Type= FileTypes::all();
            $params = [
                'submission' => $submission,
                'users' => $users,
                'file_Type' => $file_Type,
                ];       
            return view('FileManager\layout\FileSubmissionEdit')->with($params);
        }
    }

    public function UpdateDetails(Request $request,$id)
    {
        if(Auth::guard('admin')->check()){
            if (!(FileSubmission::where('id', $id)->exists())) {
                return redirect()->back()->with(['error'=>"This submission not exists"]);
            }

            $request->validate([
            'SubmissionName' => [
                'required','min:2','max:80','regex:/^[a-zA-Z0-9\s\(\)\_\-]+$/',
                Rule::unique('file_submissions','submission_name')->ignore($id,'id')
            ],
            'SubmissionDescription'=>'required|min:4|max:255',
            
            "AssignedUsers"    => "required|array|min:1",
            'AssignedUsers.*' => [
                'required','integer',
                Rule::exists('users','id'),
            ],

            "FileExtensions"    => "required|array|min:1",
            'FileExtensions.*' => [
                'required','integer',
                Rule::exists('file_types','id'),
            ],
            
            ]);
            if(count((array)($request->input('AssignedUsers')))>0){
                $user_id_array=$request->input('AssignedUsers');
                $file_extention_id_array=$request->input('FileExtensions');

                $submission_name=$request->input('SubmissionName');
                $submission_description = $request->input('SubmissionDescription');
                
                $submission_update=FileSubmission::find($id);
                $submission_update->submission_name=$submission_name;
                $submission_update->submission_description=$submission_description;        
                
                if(Auth::guard('admin')->check()){
                    $submission_update->admin_id=Auth::guard('admin')->user()->id;
                }
                $submission_update->save();
    
                $old_submission_list=FileSubmissionList::where('file_submission_id',$submission_update->id)->get();    

                foreach($old_submission_list as $old_submission_list_item){
                    $status=0;
                    foreach($user_id_array as $user_id){
                        if($user_id==$old_submission_list_item->user_id){
                            $status=1;
                            break;
                        }
                    }
                    if($status==0){
                        if($old_submission_list_item->status){
                            if(\File::exists(storage_path('app\\FileSubmission\\'.$old_submission_list_item->data_name))){
                                \File::delete(storage_path('app\\FileSubmission\\'.$old_submission_list_item->data_name));
                            }
                        }
                        $old_submission_list_item->delete();
                    }
                }

                foreach($user_id_array as $user_id){
                    if(!(FileSubmissionList::where('file_submission_id',$submission_update->id)->where('user_id',$user_id)->exists())){
                        $update_submission_list= new FileSubmissionList;
                        $update_submission_list->file_submission_id=$submission_update->id;
                        $update_submission_list->user_id=$user_id;
                        $update_submission_list->save();
                    }
                }



                $old_file_extension_list=FileSubmissionFileTypes::where('file_submission_id',$submission_update->id)->get();    

                foreach($old_file_extension_list as $old_file_extension_list_item){
                    $status1=0;
                    foreach($file_extention_id_array as $file_extention_id){
                        if($file_extention_id==$old_submission_list_item->file_types_id){
                            $status1=1;
                            break;
                        }
                    }
                    if($status1==0){
                        $old_file_extension_list_item->delete();
                    }
                }

                foreach($file_extention_id_array as $file_extention_id){
                    if(!(FileSubmissionFileTypes::where('file_submission_id',$submission_update->id)->where('file_types_id',$file_extention_id)->exists())){
                        $update_extension_item= new FileSubmissionFileTypes;
                        $update_extension_item->file_submission_id=$submission_update->id;
                        $update_extension_item->file_types_id=$file_extention_id;
                        $update_extension_item->save();
                    }
                }

                return redirect()->back()->with(['success'=>"Submission updated successfuly!"]);
            }
            return redirect()->back()->with(['error'=>"User list must want!"]);
        }
    }


    public function SubmissionFilesList($id){
        if (!(FileSubmission::where('id', $id)->exists())) {
            return redirect()->back()->with(['error'=>"This submission not exists!"]);
        }
        $submissions_Table=FileSubmissionList::where('file_submission_id', $id)->get();
        $params = [
            'submissions_Table' => $submissions_Table,
            ];       
        return view('FileManager\layout\AdminSubmissionListViewer')->with($params);
    }
  
    public function SubmissionRecordsRemove(Request $request){
        if(Auth::guard('admin')->check()){
            $validator = Validator::make($request->all(), [
                'SubmissionRecords'=>"required|array|min:1",
                'SubmissionRecords.*' => [
                    'required','integer',
                    Rule::exists('file_submission_lists','id'),
                ]
                
            ]);
            if (!($validator->passes())) {
                $message='';
                foreach($validator->errors()->all() as $error){
                    $message=$message.' '.$error;
                }
                return response()->json(['status'=>false,'message'=>$message]);
            }

            $ids=$request->input('SubmissionRecords');
            $temp_submission_id=FileSubmissionList::where('id', $ids[0])->first();
            if((FileSubmissionList::where('file_submission_id', $temp_submission_id->file_submission_id)->count())<=(count($ids))){
                return response()->json(['status'=>false,'message'=>'Not Allowed to remove all records from a submission.']);
            } 
            foreach ($ids as $id){
                $submission_records_delete=FileSubmissionList::find($id);
                if(\File::exists(storage_path('app\\FileSubmission\\'.$submission_records_delete->data_name))){
                    \File::delete(storage_path('app\\FileSubmission\\'.$submission_records_delete->data_name));
                }
                $submission_records_delete->delete();
            }
            return response()->json(['status'=>true,'message'=>"Submission records deleted successfully."]);
        }
    }

    public function MyFileSubmissionsList(){

        if(Auth::guard('admin')->check()){
            $user_id=Auth::guard('admin')->user()->user_id;
        }else if(Auth::guard('web')->check()){
            $user_id=Auth::guard('web')->user()->id;
        }
        $submissions_Table=User::find($user_id)->submissionsList;
        $params = [
            'submissions_Table' => $submissions_Table,
            ];       
        return view('FileManager\Viewers\MySubmissionListViewer')->with($params);
    }

    public function SubmissionFileUpload(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'SubmissionFile'=>'required|file|max:204800|mimes:jpeg,jpg,png,gif,mpeg,mpga,mp3,wav,mp4,pdf,txt,zip,7z,rar,docx,pptx,jfif',
        ]);
        if (!($validator->passes())) {
			return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
        }
        if (!(FileSubmissionList::where('id', $id)->exists())) {
            return redirect()->back()->with(['error'=>"This submission not exists!"]);
        }
        if($request->hasFile('SubmissionFile')){
            $file=$request->file('SubmissionFile');
            $file_ext= strtolower($file->getClientOriginalExtension());
            $file_submission=FileSubmissionList::find($id)->file_submission()->first();
            $file_Types=FileSubmission::find($file_submission->id)->fileTypes;
            $file_type_Status=false;
            foreach($file_Types as  $fileType){
                if($fileType->extension==$file_ext){
                    $file_type_Status=true;
                }
            }
            if (!($file_type_Status)) {
                return redirect()->back()->with(['error'=>"Can not upload this file type"]);
            }
            $new_submission=FileSubmissionList::find($id);
            
            $data_name =Str::random(5).rand(1000,9999).time().'.'.$file_ext;
            while(Files::where('data_name', $data_name)->exists()) {
                $data_name =Str::random(5).rand(1000,9999).time().'.'.$file_ext;
            }

            $new_submission->status=true;
            $new_submission->data_name= $data_name;

            $file->storeAs('FileSubmission',$data_name);
            $new_submission->save();

            return redirect()->back()->with(['success'=>"File submit successfuly!"]);

        }
        return redirect()->back()->with(['error'=>"File must want!"]);
    }

    public function SubmissionFileEdit(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'SubmissionFile'=>'required|file|max:204800|mimes:jpeg,jpg,png,gif,mpeg,mpga,mp3,wav,mp4,pdf,txt,zip,7z,rar,docx,pptx,jfif',
        ]);
        if (!($validator->passes())) {
			return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
        }
        if (!(FileSubmissionList::where('id', $id)->exists())) {
            return redirect()->back()->with(['error'=>"This submission not exists!"]);
        }
        if($request->hasFile('SubmissionFile')){

            $file=$request->file('SubmissionFile');
            $file_ext= strtolower($file->getClientOriginalExtension());
            $file_submission=FileSubmissionList::find($id)->file_submission()->first();
            $file_Types=FileSubmission::find($file_submission->id)->fileTypes;
            $file_type_Status=false;
            foreach($file_Types as  $fileType){
                if($fileType->extension==$file_ext){
                    $file_type_Status=true;
                }
            }
            if (!($file_type_Status)) {
                return redirect()->back()->with(['error'=>"Can not upload this file type"]);
            }
            $new_submission=FileSubmissionList::find($id);

            $data_name =Str::random(5).rand(1000,9999).time().'.'.$file_ext;
            while(Files::where('data_name', $data_name)->exists()) {
                $data_name =Str::random(5).rand(1000,9999).time().'.'.$file_ext;
            }

            $new_submission->status=true;
            if(\File::exists(storage_path('app\\FileSubmission\\'.$new_submission->data_name))){
                \File::delete(storage_path('app\\FileSubmission\\'.$new_submission->data_name));
            }
            $new_submission->data_name= $data_name;
            $file->storeAs('FileSubmission',$data_name);
            $new_submission->save();
            return redirect()->back()->with(['success'=>"File submit successfuly!"]);

        }
        return redirect()->back()->with(['error'=>"File must want!"]);
    }


    public function SubmissionFileDelete(Request $request){
        $validator = Validator::make($request->all(), [
            'SubmissionFile' => [
                'required','integer',
                Rule::exists('file_submission_lists','id')->where(function ($query) {
                    return $query->where('status',true);
                }),
            ],
        ]);
        if (!($validator->passes())) {
            $message='';
            foreach($validator->errors()->all() as $error){
                $message=$message.' '.$error;
            }
            return response()->json(['status'=>false,'message'=>$message]);
        }
        
        $id=$request->input('SubmissionFile');
        $delete_submited_file=FileSubmissionList::find($id);
        
        if(\File::exists(storage_path('app\\FileSubmission\\'.$delete_submited_file->data_name))){
            \File::delete(storage_path('app\\FileSubmission\\'.$delete_submited_file->data_name));
        }

        $delete_submited_file->status=false;
        $delete_submited_file->save();
        return response()->json(['status'=>true,'message'=>"Submited file deleted successfully."]);
    }

    public function SubmissionFileDownload($id){
        if (!(FileSubmissionList::where('id',$id)->exists())) {
            return redirect()->back()->with(['error'=>"This file does not exist"]);
        }
        $file_Donwload=FileSubmissionList::find($id);
        return response()->download((storage_path('app\\FileSubmission\\'. $file_Donwload->data_name)),$file_Donwload->data_name);
    }

    
    public function CreateZipFile($id){
        if(Auth::guard('admin')->check()){
            $zip = new ZipArchive;
            $zipName = $id.'.zip';

            if(!File::isDirectory(storage_path('app\\FileSubmissionZips'))){
                File::makeDirectory(storage_path('app\\FileSubmissionZips'), 0777, true, true);
            }

            if(\File::exists(storage_path('app\\FileSubmissionZips\\'.$zipName))){
                \File::delete(storage_path('app\\FileSubmissionZips\\'.$zipName));
            }

            if ($zip->open(storage_path('app\\FileSubmissionZips\\'.$zipName), ZipArchive::CREATE)==true)
            {
                $files=File::files(storage_path('app\\FileSubmission'));
                foreach ($files as $key=>$value) {
                    if(FileSubmissionList::where('file_submission_id',$id)->where('data_name',basename($value))->exists()){
                        $zip->addFile($value,basename($value));
                    } 
                }
                $zip->close();
            }
            if(\File::exists(storage_path('app\\FileSubmissionZips\\'.$zipName))){
                return response()->download(storage_path('app\\FileSubmissionZips\\'.$zipName), $zipName);
            }
            return redirect()->back()->with(['error'=>"Not any submited file!"]);
        }
        return redirect()->back()->with(['error'=>" "]);
    }

    

    public static function NotSubmitedCount(){
        if(Auth::guard('admin')->check()){
            $user_id=Auth::guard('admin')->user()->user_id;
        }else if(Auth::guard('web')->check()){
            $user_id=Auth::guard('web')->user()->id;
        }
       return FileSubmissionList::where('user_id',$user_id)->where('status',false)->count();
    }

    public static function AllSubmitedCount($id){
       return FileSubmissionList::where('file_submission_id',$id)->where('status',true)->count();
    }



    public function deleteSubmitedFilesOfUser($user_id){
        if (!(User::where('id', $user_id)->exists())) {
            return;
        }
        if ((FileSubmissionList::where('user_id',$user_id)->exists())) {
            $delete_submited_files=FileSubmissionList::where('user_id',$user_id)->get();
            foreach($delete_submited_files as $delete_submited_file){
                if((FileSubmissionList::where('file_submission_id',$delete_submited_file->file_submission_id)->count())<2){
                    $this->Delete_Submission($delete_submited_file->file_submission_id);
                }else{
                    if(\File::exists(storage_path('app\\FileSubmission\\'.$delete_submited_file->data_name))){
                        \File::delete(storage_path('app\\FileSubmission\\'.$delete_submited_file->data_name));
                    }
                    $delete_submited_file->status=false;
                    $delete_submited_file->save();
                }
            }
        }
        return;
    }
 
}


