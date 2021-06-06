@extends('layouts.app',['activePage' => 'archiving'])
@section('content')
    <div class="p-5" id="file_submiison_create">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="btn-group" id="ButtonOfArchive">
                    @if (Route::has('login'))
                        @auth('admin')
                            
                            <a href="{{route('SubmissionFileType.Show')}}"><button type="button" class="btn btn-outline btn-sm mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-card-list" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
                            </svg> <span id="featureName">Submission File Type</span></button>
                            </a> 

                        @endauth
                    @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9"><br>
                    <div class="d-flex justify-content-center"><h3><b>Create New Submission</b></h3></div> <br>
                </div>
            </div> 
            <div class="row justify-content-center">
                <div class="col-md-9">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <form name="frm" action ="{{ route('FileSubmission.Create') }}" method="POST" enctype="multipart/form-data" id="FileSubmissionForm">
                                {{csrf_field()}}
                                <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                                <div  class="form-group">
                                    <label for="SubmissionNameId">Name of the submission <abbr class="req" title="required">*</abbr></label>
                                    <input type="text" name="SubmissionName" id="SubmissionNameId" class="form-control @error('SubmissionName') is-invalid @enderror" required minlength="2" maxlength="80">
                                    @error('SubmissionName')
                                    <p class="text-danger">{{$errors->first('SubmissionName')}}</p>
                                    @enderror
                                </div>

                                <div  class="form-group"><br>
                                    <label for="SubmissionDescriptionId">Description about the submission <abbr class="req" title="required">*</abbr></label>
                                    <textarea class="form-control @error('SubmissionDescription') is-invalid @enderror  z-depth-1" name="SubmissionDescription" id="SubmissionDescriptionId"  rows="3" placeholder="Write something here..." required minlength="4" maxlength="255"></textarea>
                                    @error('SubmissionDescription')
                                    <p class="text-danger">{{$errors->first('SubmissionDescription')}}</p>
                                    @enderror
                                </div>


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
                                                    <th><span><input type="checkbox" id="check_all_file_extension">Select All</span></th>
                                                    <th>File Extension</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @isset($file_Type)
                                                @if(count($file_Type)>0)
                                                    @foreach($file_Type->all() as $fileType)
                                                    <tr>
                                                        <td><input type="checkbox" name="FileExtensions[]" class="checkbox_file_extension" value="{{$fileType->id}}"/> </td>
                                                        <td><i class="bi bi-person-fill"></i>  {{$fileType->extension}}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>


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
                                        <table class="table table-hover" id="users" style="width:100%">
                                            <thead>
                                                <tr>
                                                        <th><span><input type="checkbox" id="check_all_user">Select All</span></th>
                                                        <th>User Name</th>  
                                                        <th>Year-Left</th>  
                                                        <th>School Admission No</th>                                         
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @isset($users)
                                                @if(count($users)>0)
                                                    @foreach($users->all() as $user)
                                                    <tr>
                                                        <td><input type="checkbox" name="AssignedUsers[]" class="checkbox_user" value="{{$user->id}}"/> </td>
                                                        <td><i class="bi bi-person-fill"></i>  {{$user->name}}</td>
                                                        <td><i class="bi bi-person-fill"></i>  {{$user->year_left}}</td>
                                                        <td><i class="bi bi-person-fill"></i>  {{$user->admission_no}}</td>                                        
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            @endisset
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{route('AllFileSubmissions.Show')}}"><button type="button" class="btn btn-secondary">Close</button></a>
                                    <button type="submit" name="submit" class="btn btn-primary ">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>      
        </div> 
    </div>

<script type="text/javascript">
//***********************************Data table****************************************
    $(document).ready( function () {
        $('#users').DataTable({
            paging:  false 
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


