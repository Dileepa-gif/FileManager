@extends('FileManager.layout.FileManagerMain')



@section('Options')
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
<br>
<div class="row justify-content-center">
    <div class="col-11">
        <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <div style="height: 580px;overflow: scroll;">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="2">Submission Name</th>
                            <th colspan="3">Submission Description</th>
                            <th>Submission Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                        <tbody>
                        @foreach($submissions_Table as $submissionsTable)
                            <tr> 
                                <td colspan="2">
                                    {{ $submissionsTable->file_submission->submission_name}}
                                </td>
                                <td colspan="3">
                                    {{ $submissionsTable->file_submission->submission_description}}
                                    <br> 
                                    <small>
                                    File Types :-                                   
                                    @isset($submissionsTable->file_submission->fileTypes)
                                        @foreach($submissionsTable->file_submission->fileTypes as $extension)
                                        ( .{{ $extension->extension}} ),
                                        @endforeach
                                    @endisset
                                    </small>
                                </td>
                                
                                @if( $submissionsTable->status==1)
                                    <td>Submitted</td>
                                @else
                                    <td>Not Submitted</td>
                                @endif
                                
                                <td>
                                    <div class="btn-group">

                                            @if( $submissionsTable->status==1)
                                            <a href="{{route('SubmissionFile.Download',$submissionsTable->id)}}">
                                            <button type="button" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1" id="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                                </svg>
                                            </button>
                                            </a>
                                            <a href="#">
                                            <button type="button" class="btn btn-sm btn-outline-primary my-2 my-sm-0 mr-1" data-toggle="collapse" href="#collapse_Submission_Uploader{{$submissionsTable->id}}" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                            </svg>
                                            </button>
                                            </a>

                                            <a href="#">
                                            <button type="button" class="btn btn-sm btn-outline-danger my-2 my-sm-0 mr-1" onclick = "MySubmissionDelete('{{$submissionsTable->id}}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                            </a>
                                            
                                            @else
                                            <a href="#"><button type="button" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1" data-toggle="collapse" href="#collapse_Submission_Uploader{{$submissionsTable->id}}" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                </svg>
                                            </button>
                                            </a>
                                            @endif    
                                        </div>
                                </td>
                            </tr>
                            
                            
                                <tr  class="collapse bg-warning" id="collapse_Submission_Uploader{{$submissionsTable->id}}">
                                @if( $submissionsTable->status==0)
                                    <td colspan="2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
                                        </svg>
                                        Upload your submission <abbr class="req" title="required">*</abbr>
                                    </td>
                                    <td colspan="3">
                                    <form name="frm" action ="{{ route('SubmissionFile.Upload',$submissionsTable->id) }}" method="POST" enctype="multipart/form-data" id="SubmissionFileUploadForm{{$submissionsTable->id}}">
                                        {{csrf_field()}}
                                        <div class="custom-file">
                                            <input type="file" name="SubmissionFile" class="form-control" id="File{{$submissionsTable->id}}" required>    
                                        </div>
                                    </form>
                                    </td>
                                    <td colspan="2">
                                        <button type="submit" class="btn btn-primary  btn-sm" form="SubmissionFileUploadForm{{$submissionsTable->id}}">Submit</button>
                                    </td>
                                @else
                                    <td colspan="2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.854 1.146a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L4 2.707V12.5A2.5 2.5 0 0 0 6.5 15h8a.5.5 0 0 0 0-1h-8A1.5 1.5 0 0 1 5 12.5V2.707l3.146 3.147a.5.5 0 1 0 .708-.708l-4-4z"/>
                                        </svg>
                                        Replace your previous submission <abbr class="req" title="required">*</abbr>
                                    </td>
                                    <td colspan="3">
                                    <form name="frm" action ="{{ route('SubmissionFile.Edit',$submissionsTable->id) }}" method="POST" enctype="multipart/form-data" id="SubmissionFileEditForm{{$submissionsTable->id}}">
                                    {{csrf_field()}}
                                    {{method_field("PUT")}}
                                        <div class="custom-file">
                                            <input type="file" name="SubmissionFile" class="form-control" id="File{{$submissionsTable->id}}" required>    
                                        </div>
                                    </form>
                                    </td>
                                    <td colspan="2">
                                        <button type="submit" class="btn btn-success  btn-sm" form="SubmissionFileEditForm{{$submissionsTable->id}}">Update</button>
                                    </td>
                                @endif 
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
  function MySubmissionDelete(id){
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary submission file.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
          })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('SubmissionFile.Delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:{'SubmissionFile':id},
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
                            swal("Error!",'Something went wrong.', "error");
                        }
                    });
                } else {
                    swal("Cancelled", "Your submission file is safe :)", "error");
                }
            });                  
  }

</script>
@endsection
