@extends('layouts.app',['activePage' => 'archiving'])
@section('content')
    <div class="p-5" id="file_submiison_create">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9"><br>
                    <div class="d-flex justify-content-center"><h3><b>Submission File Type</b></h3></div> <br>
                </div>
            </div> 
            <div class="row justify-content-center">
                <div class="col-md-9">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded">
                            <div class="d-flex justify-content-center"><h5><b> Add Submission File Extension</b></h5></div> <br>
                            <form name="frm" action ="{{ route('SubmissionFileType.Add') }}" method="POST" enctype="multipart/form-data" id="FileSubmissionForm">
                                {{csrf_field()}}
                                <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                                <div  class="form-group">
                                    <label for="SubmissionNameId">File Extension<abbr class="req" title="required">*</abbr></label>
                                    <input type="text" name="FileExtension" id="FileExtension" class="form-control @error('SubmissionName') is-invalid @enderror" placeholder="Example :- jpeg" required minlength="1" maxlength="10">
                                    @error('FileExtension')
                                    <p class="text-danger">{{$errors->first('FileExtension')}}</p>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" class="btn btn-primary ">Add</button>
                                </div>
                            </form>
                            <div class="d-flex justify-content-center"><h5><b>Submission File Extensions</b></h5></div> <br>
                            <div style="height: 580px;overflow: scroll;">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="file_extension" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>File Extension</th>  
                                                <th>Remove</th>  
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @isset($file_Type)
                                            @if(count($file_Type)>0)
                                                @foreach($file_Type->all() as $fileType)
                                                <tr>
                                                    <td>{{$fileType->extension}}</td>
                                                    <td>
                                                        <a href="{{route('SubmissionFileType.Remove',$fileType->id)}}">
                                                            <button type="button" class="btn btn-sm btn-outline-danger my-2 my-sm-0 mr-1" >
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                                </svg>
                                                            </button>
                                                        </a>
                                                    </td>                                  
                                                </tr>
                                                @endforeach
                                            @endif
                                        @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
        </div> 
    </div>

<script type="text/javascript">
//***********************************Data table****************************************
    $(document).ready( function () {
        $('#file_extension').DataTable({
            paging:  false 
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


