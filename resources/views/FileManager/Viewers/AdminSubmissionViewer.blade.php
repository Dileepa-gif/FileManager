@extends('FileManager.layout.FileManagerMain')



@section('Options')

<style>
div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
</style>
    <div class="btn-group" id="ButtonOfArchive">
        <a href="#"><button type="button" class="btn btn-outline btn-sm mr-1" id="sidebar_archiveCollapse">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-layout-sidebar" viewBox="0 0 16 16">
            <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H5zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2V2z"/>
        </svg><span id="featureName"></span></button>
        </a>

        <a href="{{route('home')}}"><button type="button" class="btn btn-outline btn-sm mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-house-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
        </svg></button>
        </a>
    </div>
@endsection


@section('Folder Details')
    
@endsection


@section('Body')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="btn-group" id="ButtonOfArchive">
        @if (Route::has('login'))
                    @auth('admin')
                    <a href="{{route('FileSubmissionCreateForm.Show')}}"><button type="button" class="btn btn-outline btn-sm mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-folder-plus" viewBox="0 0 16 16">
                        <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                        <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                    </svg> <span id="featureName">Create New Submission</span></button>
                    </a> 
                    <a href="#"><button type="button" class="btn btn-outline btn-sm mr-1" id="submission_delete_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg> <span id="featureName">Delete Submission</span></button>
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th><span><input type="checkbox" id="check_all_submision">Select All</span></th>
                            <th>Submission Name</th>
                            <th>Creater</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                        <tbody>
                        @foreach($submission_Table as $submissionTable)
                            <tr id="{{$submissionTable->id}}"> 
                                <td><input type="checkbox" class="checkbox_submission" id="{{$submissionTable->id}}"></td>
                                <td>
                                    {{ $submissionTable->submission_name}}
                                </td>
                                <td>
                                @isset($submissionTable->admin->user->name)
                                    {{ $submissionTable->admin->user->name}}
                                @endisset
                                @empty($submissionTable->admin->user->name)
                                --
                                @endempty
                                </td>
                                <td>
                                    <div class="btn-group">
                                        @if (Route::has('login'))
                                        @auth('admin')
                                            <a href="{{route('SubmissionFilesList.Show',$submissionTable->id)}}">
                                            <button type="button" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1" id="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
                                                </svg>
                                            </button>
                                            </a>
                                            <a href="{{route('FileSubmission.GetDetails',$submissionTable->id)}}">
                                            <button type="button" class="btn btn-sm btn-outline-primary my-2 my-sm-0 mr-1" id="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg>
                                            </button>
                                            </a>
                                            <a href="#">
                                            <button type="button" class="btn btn-sm btn-outline-danger my-2 my-sm-0 mr-1"   onclick = "SubmissionDelete('{{$submissionTable->id}}')" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                            </a>
                                        @endauth
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('DMAA script content')


<script type="text/javascript">
    
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
                SubmissionsDelete(idsArr);                                   
            }  
        });
    });
    function SubmissionDelete(id){
        var idsArr = [];
        idsArr.push(id); 
        SubmissionsDelete(idsArr);          
    }

    function SubmissionsDelete(idsArr)
    {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary submission!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('FileSubmission.Delete') }}",
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:{'Submissions':idsArr},
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
