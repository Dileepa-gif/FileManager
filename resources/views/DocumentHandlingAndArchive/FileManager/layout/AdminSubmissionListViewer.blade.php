@extends('layouts.app',['activePage' => 'archiving'])
@section('content')
    <div class="p-5" id="file_submssion_list">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9"><br>
                    <div class="d-flex justify-content-center"><h3><b>{{$submissions_Table->first()->file_submission->submission_name}}</b></h3></div>
                    @isset($submissions_Table->first()->file_submission->admin->user->name)
                    <div class="d-flex justify-content-center"><small>Last edit by - {{$submissions_Table->first()->file_submission->admin->user->name}}</small></div>   
                    @endisset 
                    <div class="d-flex justify-content-center"><small>Created at - {{ date('j M Y, h:i a',strtotime($submissions_Table->first()->file_submission->created_at)) }}</small></div> 
                </div>

                <div class="col-md-7"><br>
                    <h5>Description - </h5>
                   <p>{{$submissions_Table->first()->file_submission->submission_description}}</p>
                </div>
                <div class="col-md-7"><br>
                    <h5>File extension that can be submitted - </h5>
                   <p>
                   @isset($submissions_Table->first()->file_submission->fileTypes)
                        @foreach($submissions_Table->first()->file_submission->fileTypes as $extension)
                        ( .{{ $extension->extension}} ),
                        @endforeach
                    @endisset
                   </p>
                </div>
            </div> 
        </div>
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="btn-group" id="ButtonOfArchive">
                    @if (Route::has('login'))
                        @auth('admin')
                            @inject('CountOfSubmited', 'App\Http\Controllers\FileManager\FileSubmissionController')
                            @isset($CountOfSubmited)
                                @if(($CountOfSubmited::AllSubmitedCount($submissions_Table->first()->file_submission->id))>0)
                                <a href="{{ route('SubmissionZipFile.Create',$submissions_Table->first()->file_submission->id) }}"><button type="button" class="btn btn-outline btn-sm mr-1" data-toggle="collapse" id="download_zip_file" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-download" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg><span id="featureName">Download Zip </span></button>
                                </a> 
                                @endif
                            @endisset 
                            <a href="#"><button type="button" class="btn btn-outline btn-sm mr-1" id="submission_delete_button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg><span id="featureName">Remove Submission Record</span></button>
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="shadow-lg p-3 mb-5 bg-white rounded">
                    <div style="height: 580px;overflow: scroll;">
                        <div class="table-responsive">
                        <table class="table table-hover" id="submission_records">
                            <thead>
                                <tr>
                                    <th><span><input type="checkbox" id="check_all_submision">Select All</span></th>
                                    <th>Member Name</th>
                                    <th>Submission Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>

                                <tbody>
                                @isset($submissions_Table)
                                    @foreach($submissions_Table as $submissionsTable)
                                        <tr id="{{$submissionsTable->id}}"> 
                                            <td><input type="checkbox" class="checkbox_submission" id="{{$submissionsTable->id}}"></td>
                                            <td>
                                                {{ $submissionsTable->user->name}}
                                            </td>
                                            
                                            @if( $submissionsTable->status==1)
                                                <td>Submitted</td>
                                            @else
                                                <td>Not Submitted</td>
                                            @endif
                                            
                                            <td>
                                                <div class="btn-group">
                                                    @if (Route::has('login'))
                                                    @auth('admin')
                                                
                                                        <a href="#">
                                                        <button type="button" class="btn btn-sm btn-outline-danger my-2 my-sm-0 mr-1"   onclick = "SubmissionRecordsRemove('{{$submissionsTable->id}}')" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                            </svg>
                                                        </button>
                                                        </a>

                                                        @if( $submissionsTable->status==1)
                                                        <a href="{{route('SubmissionFile.Download',$submissionsTable->id)}}">
                                                        <button type="button" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1" id="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                            </svg>
                                                        </button>
                                                        </a>
                                                        @endif    
                                                    @endauth
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>                 
    </div>

    @php
        $total_Records=0;
    @endphp 
    @isset($submissions_Table)
    @php
        $total_Records=$submissions_Table->count();
    @endphp                        
    @endisset




    <script type="text/javascript">

     $(document).ready( function () {
        $('#submission_records').DataTable({
            paging:           false
        });
        $('#submission_records_filter label input').on('input',function () {
            if($('.checkbox_submission:checked').length == $('.checkbox_submission').length){
                $('#check_all_submision').prop('checked',true);
            }else{
                $('#check_all_submision').prop('checked',false);
            }
        });
    });

    $(document).ready(function () {

        $('#check_all_submision').on('click', function(e) {
        if($(this).is(':checked',true))  
        {
            $(".checkbox_submission").prop('checked', true);  
        } else {  
            $(".checkbox_submission").prop('checked',false);  
        }  
        });

        $('.checkbox_submission').on('click',function(){
            if($('.checkbox_submission:checked').length == $('.checkbox_submission').length){
                $('#check_all_submision').prop('checked',true);
            }else{
                $('#check_all_submision').prop('checked',false);
            }
        });

           
        $('#submission_delete_button').on('click', function(e) {

            var idsArr = [];  
            $(".checkbox_submission:checked").each(function() {  
                idsArr.push($(this).attr('id'));
            });  
            if(idsArr.length<=0)  
            { 
                swal("An Omission!",'Please select atleast one record to delete.', "error"); 
            }  else {
                if(idsArr.length>='<?php echo $total_Records; ?>') {
                    swal("An Omission!",'Not Allowed to remove all records from a submission.', "error");
                }else{
                    SubmissionsDelete(idsArr); 
                }                                     
            }  
        });
    });
    function SubmissionRecordsRemove(id){
        var idsArr = [];
        idsArr.push(id); 
        if(idsArr.length>='<?php echo $total_Records; ?>') {
            swal("An Omission!",'Not Allowed to remove all records from a submission.', "error");
        }else{
            SubmissionsDelete(idsArr); 
        }              
    }

    function SubmissionsDelete(idsArr){
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary submission records",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{route('SubmissionRecords.Remove') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:{'SubmissionRecords':idsArr},
                        success: function (data) {
                            if (data['status']==true) {
                                swal("Succeeded !",data.message , "success").then(function(){ 
                                location.reload();
                                });
                        
                            } else {
                                swal("Error!",data.message, "error");
                            }
                        },
                        error: function (data) {
                            swal("Error!","Something went wrong.", "error");
                        }
                    });
                } else {
                    swal("Cancelled", "Your imaginary records are safe :)", "error");
                }
            });               
    }
</script>
  
@endsection


