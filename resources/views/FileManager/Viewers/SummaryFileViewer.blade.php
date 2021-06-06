@extends('FileManager.layout.FileManagerMain')
@section('Modal')
@include('FileManager.Items.Modals.DetailsViewer')
@endsection

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
<span>
@endsection

@section('Folder Details')

<div class="row justify-content-center">
    <div class="col-md-9 my-3">
    <span  id="ButtonOfArchive">
        @if (Route::has('login'))
            @auth('admin') 
                @isset($file_Table)
                <a href="#"><button type="button" class="btn btn-outline btn-sm" id="file_delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg> <span id="featureName">Delete Files</span></button>
                </a>
                @endisset   
            @endauth
        @endif  
        <a href="{{route('TodayFiles.Show')}}"><button type="button" class="btn btn-outline btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg> <span id="featureName">Today Files</span></button>
        </a>

        <a href="{{route('LastWeekFiles.Show')}}"><button type="button" class="btn btn-outline btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg> <span id="featureName">Last Week Files</span></button>
        </a>
        <a id="show_More" data-toggle="collapse" href="#collapse_Archive" role="button" aria-expanded="false" aria-controls="collapseExample">
            Show More....
        </a>
    </span>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="collapse" id="collapse_Archive">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <h6 class="text"><b>Search files for a given date</b></h6>
                <form name="frm" action ="{{ route('GivenDateFiles.Show') }}" method="POST" enctype="multipart/form-data" id="GivenoDatesFiles">
                    {{csrf_field()}}
                    <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Date <abbr class="req" title="required">*</abbr></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="Date" id="example-date-input" required>
                        </div>
                    </div>

                        <button type="submit" name="submit" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        </button>

                </form>
            </div>
    
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <h6 class="text"><b>Search for files by given date range</b></h6>
                <form name="frm" action ="{{ route('GivenTwoDatesFiles.Show') }}" method="POST" enctype="multipart/form-data" id="GivenTwoDatesFiles">
                    {{csrf_field()}}
                    <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Start Date <abbr class="req" title="required">*</abbr></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="StartDate" id="example-date-input" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">End Date <abbr class="req" title="required">*</abbr></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="EndDate" id="example-date-input" required>
                        </div>
                    </div>

                        <button type="submit" name="submit" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        </button>

                </form>

            </div>
        </div>
    </div>
</div>      
@endsection





@section('Body')


<div class="container-fluid" id="summary_contain">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <div style="height: 580px;overflow: scroll;">
                    <div class="table-responsive">
                        <table class="table table-hover" id="summary_file_table">
                            <thead>
                            <tr>
                            <th><input type="checkbox" id="check_all"><br><small>Select All</small></th>
                            <th>File Number</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th></th>
                            <th>Approval</th>
                            <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($file_Table))
                                @if($file_Table->count())
                                    @foreach($file_Table as $key => $fileTable)
                                        <tr  id="tr_{{$fileTable->id}}"> 
                                            <td><input type="checkbox" class="checkbox" id="{{$fileTable->id}}"></td>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $fileTable->real_name}}</td>
                                            <td>{{ $fileTable->file_type}}</td>
                                            <td> @include('FileManager.Items.FileType')</td>

                                            @if($fileTable->approval==1)
                                            <td><span class="text-success">Approved</span></td>
                                            @elseif($fileTable->approval==0)
                                            <td><span class="text-warning">Not Approved</span></td>
                                            @endif

                                            @if($fileTable->approval==0)
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}" class="btn btn-sm btn-outline-primary my-2 my-sm-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                            @elseif($fileTable->approval==1)
                                            <td> 
                                                <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}" class="btn btn-sm btn-outline-primary my-2 my-sm-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            @endif

                            @if(isset($p_file_Table))
                                @if($p_file_Table->count())
                                    @foreach($p_file_Table as $key => $fileTable)
                                        <tr  id="tr_{{$fileTable->id}}"> 
                                            <td><input type="checkbox" class="checkbox" id="{{$fileTable->id}}"></td>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $fileTable->real_name}}</td>
                                            <td>{{ $fileTable->file_type}}</td>
                                            <td> @include('FileManager.Items.FileType')</td>

                                            @if($fileTable->approval==1)
                                            <td><span class="text-success">Approved</span></td>
                                            @elseif($fileTable->approval==0)
                                            <td><span class="text-warning">Not Approved</span></td>
                                            @endif

                                            @if($fileTable->approval==0)
                                            <td>
                                                <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}" class="btn btn-sm btn-outline-primary my-2 my-sm-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                            @elseif($fileTable->approval==1)
                                            <td> 
                                                <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}" class="btn btn-sm btn-outline-primary my-2 my-sm-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                            </tbody>
                        </table>
                        @if(isset($file_Table))
                        {{$file_Table->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('DMAA script content')

<script type="text/javascript">
//***********************************Data Table****************************************
    $(document).ready( function () {
        $('#summary_file_table').DataTable({
            "info": false,
            paging:           false
        });
        $('#summary_file_table_filter label input').on('input',function () {
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
        });
    });

    $(document).ready(function () {
        $('#collapse_Archive').on('shown.bs.collapse', function () {
            $( "#show_More" ).html('Show Less....');
            $( "#summary_contain" ).hide();
        });

        $('#collapse_Archive').on('hidden.bs.collapse', function () {
            $( "#show_More" ).html('Show More....');
            $( "#summary_contain" ).show();
        });
//***********************************Select All****************************************
        $('#check_all').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".checkbox").prop('checked', true);  
         } else {  
            $(".checkbox").prop('checked',false);  
         }  
        });
//***************If all check box are checked than #check_all will be check****************
         $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });
//***********************************Multiple Files Delete***********************************
        $('#file_delete').on('click', function(e) {
 
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('id'));
            });  
            if(idsArr.length <=0)  
            { 
                swal("An Omission!",'Please select atleast one record to delete.', "error"); 
            }  else {  
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var strIds = idsArr.join(","); 
                        $.ajax({
                            url: "{{ route('AllFiles.Delete') }}",
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+strIds,
                            success: function (data) {
                                if (data['status']==true) {
                                    $(".checkbox:checked").each(function() {  
                                        $(this).parents("tr").remove();
                                    });

                                    swal("Succeeded !",data.message , "success").then(function(){ 
                                    location.reload();
                                    });
                                
                                } else {
                                    swal("Error!",'Whoops Something went wrong!!', "error");
                                }
                            },
                            error: function (data) {
                                swal("Error!",data.responseText, "error");
                            }
                        });
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });                                  
            }  
        });
    });
</script>

@endsection 
