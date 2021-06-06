@extends('layouts.app',['activePage' => 'archiving'])
@section('content')
    <div class="p-5" id="file_submission_edit">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9"><br>
                    <div class="d-flex justify-content-center"><h3><b>Edit Submission</b></h3></div> 
                    @isset($submissionTable->admin->user->name)
                    <div class="d-flex justify-content-center"><small>Last Edit By {{ $submissionTable->admin->user->name}}</small></div> 
                    @endisset
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <form name="frm" action ="{{ route('FileSubmission.Update',$submission->id) }}" method="POST" enctype="multipart/form-data" id="FileSubmissionEditForm">
                            {{csrf_field()}}
                            {{method_field("PUT")}}
                            <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                            <div  class="form-group"><br>
                                <label  for="SubmissionNameId">Name of the submission <abbr class="req" title="required">*</abbr></label>
                                <input type="text" name="SubmissionName" id="SubmissionNameId" value="{{$submission->submission_name}}" class="form-control @error('SubmissionName') is-invalid @enderror" required minlength="2" maxlength="80">
                                @error('SubmissionName')
                                    <p class="text-danger">{{$errors->first('SubmissionName')}}</p>
                                @enderror
                            </div>
                            <div  class="form-group"><br>
                                <label for="SubmissionDescriptionId">Description about the submission <abbr class="req" title="required">*</abbr></label>
                                <textarea  class="form-control @error('SubmissionDescription') is-invalid @enderror  z-depth-1" name="SubmissionDescription" id="SubmissionDescriptionId" rows="3" required minlength="4" maxlength="255">{{$submission->submission_description}}</textarea>
                                @error('SubmissionDescription')
                                    <p class="text-danger">{{$errors->first('SubmissionDescription')}}</p>
                                @enderror
                            </div>
                            @isset($submission->admin->user->name)
                            <label>Last editer of the submission</label>
                            <h6>{{$submission->admin->user->name}}</h6>
                            @endisset
                            <br>






                            @isset($file_Type)
                            <label for="SubmissionDescriptionId">Select file extensions <abbr class="req" title="required">*</abbr></label><br>
                            <small>( select the checkboxes to select file types )</small>
                            @error('FileExtensions')
                                <p class="text-danger">{{$errors->first('FileExtensions')}}</p>
                            @enderror

                            @error('FileExtensions.*')
                                <p class="text-danger">{{$errors->first('FileExtensions.*')}}</p>
                            @enderror
                            <div style="height: 150px;overflow: scroll;">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="file_extension" style="width:100%">
                                        <thead>
                                            <tr>
                                                @if(($file_Type->count())==($submission->fileTypes->count()))
                                                <th><span><input type="checkbox" id="check_all_file_extension" checked>Select All</span></th>
                                                @else
                                                <th><span><input type="checkbox" id="check_all_file_extension">Select All</span></th>
                                                @endif
                                                <th>File Extension</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($file_Type)>0)
                                                @foreach($file_Type->all() as $fileType)
                                                    <tr>
                                                    @php
                                                        $status1=0;
                                                    @endphp
                                                    @if(count((array)$submission)>0)
                                                        @foreach($submission->fileSubmissionFileTypes as $fileSubmissionFileType)
                                                            @if($fileSubmissionFileType->file_types_id==$fileType->id)
                                                                <td><input type="checkbox" name="FileExtensions[]" class="checkbox_file_extension" value="{{$fileType->id}}" checked/> </td>
                                                                @php
                                                                    $status1=1;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if($status1!=1)
                                                        <td><input type="checkbox" name="FileExtensions[]" class="checkbox_file_extension" value="{{$fileType->id}}"/> </td>
                                                    @endif
                                                        <td><i class="bi bi-person-fill"></i>  {{$fileType->extension}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            @endisset


                            @isset($users)
                           <label for="SubmissionDescriptionId">Assign users <abbr class="req" title="required">*</abbr></label><br>
                           <small>( select the checkboxes to assign submission for members )</small>
                            @error('AssignedUsers')
                                <p class="text-danger">{{$errors->first('AssignedUsers')}}</p>
                            @enderror

                            @error('AssignedUsers.*')
                                <p class="text-danger">{{$errors->first('AssignedUsers.*')}}</p>
                            @enderror
                            <div style="height: 580px;overflow: scroll;">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="users">
                                        <thead>
                                            <tr>
                                                @if(($users->count())==($submission->submissionLists()->count()))
                                                <th><span><input type="checkbox" id="check_all_user" checked>Select All</span></th>
                                                @else
                                                <th><span><input type="checkbox" id="check_all_user">Select All</span></th>
                                                @endif
                                                
                                                <th>User Name</th>  
                                                <th>Year-Left</th>  
                                                <th>School Admission No</th>                                         
                                            </tr>
                                    
                                        </thead>
                                        <tbody>
                                            @if(count($users)>0)
                                                @foreach($users->all() as $user)
                                                            <tr>
                                                            @php
                                                                $status=0;
                                                            @endphp
                                                            @if(count((array)$submission)>0)
                                                                @foreach($submission->submissionLists as $submissionLists)
                                                                    @if($submissionLists->user_id==$user->id)
                                                                        <td><input type="checkbox" name="AssignedUsers[]" class="checkbox_user" value="{{$user->id}}" checked/> </td>
                                                                        @php
                                                                            $status=1;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if($status!=1)
                                                                <td><input type="checkbox" name="AssignedUsers[]" class="checkbox_user" value="{{$user->id}}"/> </td>
                                                            @endif
                                                                <td><i class="bi bi-person-fill"></i>  {{$user->name}}</td>
                                                                <td><i class="bi bi-person-fill"></i>  {{$user->year_left}}</td>
                                                                <td><i class="bi bi-person-fill"></i>  {{$user->admission_no}}</td>                                         
                                                            </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                            @endisset
                            <div class="modal-footer">
                                <a href="{{route('AllFileSubmissions.Show')}}"><button type="button" class="btn btn-secondary">Close</button></a>
                                <button type="submit" name="submit" class="btn btn-success ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>                  
        </div>
    </div>
    <script type="text/javascript">

        $(document).ready( function () {
            $('#users').DataTable({
                paging:           false
            });
            $('#users_filter label input').on('input',function () {
                if($('.checkbox_user:checked').length == $('.checkbox_user').length){
                    $('#check_all_user').prop('checked',true);
                }else{
                    $('#check_all_user').prop('checked',false);
                }
            });


            $('#file_extension').DataTable({
                paging:  false 
            });

            $('#file_extension_filter label input').on('input',function () {
                if($('.checkbox_file_extension:checked').length == $('.checkbox_file_extension').length){
                    $('#check_all_file_extension').prop('checked',true);
                }else{
                    $('#check_all_file_extension').prop('checked',false);
                }
            });
        });
        $(document).ready(function () {




            $('#check_all_file_extension').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".checkbox_file_extension").prop('checked', true);  
        } else {  
            $(".checkbox_file_extension").prop('checked',false);  
        }  
        });

        $('.checkbox_file_extension').on('click',function(){
            if($('.checkbox_file_extension:checked').length == $('.checkbox_file_extension').length){
                $('#check_all_file_extension').prop('checked',true);
            }else{
                $('#check_all_file_extension').prop('checked',false);
            }
        });



            $('#check_all_user').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".checkbox_user").prop('checked', true);  
            } else {  
                $(".checkbox_user").prop('checked',false);  
            }  
            });

            $('.checkbox_user').on('click',function(){
                if($('.checkbox_user:checked').length == $('.checkbox_user').length){
                    $('#check_all_user').prop('checked',true);
                }else{
                    $('#check_all_user').prop('checked',false);
                }
            });
        });

    </script>
    @if (session()->has('success'))
    <script>
        notification = @json(session()->pull("success"));
        swal("Succeeded !",notification, "success").then(function(){
            location.reload();
        });
    </script>
  @elseif(session()->has('error'))
    <script>
        notification = @json(session()->pull("error"));
        swal("Error !",notification, "error").then(function(){
            location.reload();
        });
    </script>
    @endif
@endsection