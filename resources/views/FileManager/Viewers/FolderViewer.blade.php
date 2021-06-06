@extends('FileManager.layout.FileManagerMain')

@section('Uploader Modal Title')
<div style="margin-left: auto;margin-right: auto ">
    <h5 class="modal-title">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
            <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
        </svg> 
        <b> Create a new folder</b>
    </h5>
</div>
@endsection

@section('Uploader Modal Form')
<form name="frm" action ="{{ route('Folder.Create') }}" method="POST" enctype="multipart/form-data" id="FilesForm">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="FolderNameId">Name of folder <abbr class="req" title="required">*</abbr></label>
                        <input type="text" name="FolderName" id="FolderNameId" class= "form-control" required minlength="2" maxlength="60">
                    </div>
                    <div class="custom-file">
                        <label for="FolderC
                        overImageId">Insert cover image <abbr class="req" title="required">*</abbr></label>
                        <input type="file" name="FolderCoverImage" class="form-control" id="FolderCoverImageId" accept="image/*" required>    
                    </div>
                    
                    <div  class="form-group"><br>
                        <label for="FolderDescriptionId">Write description about folder <abbr class="req" title="required">*</abbr></label>
                        <textarea class="form-control z-depth-1" name="FolderDescription" id="FolderDescriptionId"  rows="3" placeholder="Write something here..." required minlength="4" maxlength="255"></textarea>
                    </div>


                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hideFromMember" id="hideFromMember" value=1>
                            <label class="form-check-label" for="hideFromMember">
                            Hide from member
                        </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hideFromVisitor" id="hideFromVisitor" value=1>
                            <label class="form-check-label" for="hideFromVisitor">
                                Hide from visitor   
                            </label>
                        </div>


                        <button type="button" id="add_files_content_show" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-upload" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                        </svg> Add files</button>

                        <br>
                        <div class="row" id="add_files_content" ng-controller="commonController">
                            <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                <div class="user-image mb-3 text-center">
                                    <div class="filesPreview"  id= "filesPreviewDMAA"> </div>
                                </div> 
                                <br>
                                <div class="custom-file">
                                    <label for="CoverImage">Insert content of folder</label>
                                    <input type="file" name="UploadFiles[]" class="form-control" id="Files" multiple="multiple" onclick = "clearContent('filesPreviewDMAA')" >    
                                </div>
                                <small>(Note that the maximum number of files that can be uploaded is 15.)</small><br><br>
                            </div>
                        </div><br>
                        <div class="progress" id="FileUploaderProgress">
                            <div class="bar"></div >
                            <div class="percent">0%</div >
                        </div>
                        <h5 class="text-central" id="completedMsg"></h5>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeAndClear" data-dismiss="modal" id="uploader_close_button">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary " id="uploader_submit_button">Create Folder</button>
                    </div>
                  
            </form>


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
@endsection

@section('Body')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="btn-group" id="ButtonOfArchive">
        @if (Route::has('login'))
                    @auth('admin')
                    <button type="button" class="btn btn-outline btn-sm mr-1" data-toggle="modal" data-target="#FilesUploader">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-folder-plus" viewBox="0 0 16 16">
                        <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                        <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                    </svg> <span id="featureName">Create New Folder</span>
                    </button>
                
                    <button type="button" class="btn btn-outline btn-sm" id="folder_delete">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg> <span id="featureName">Delete Folder</span>
                    </button>
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
                    <table class="table table-hover" id="folder_T able">
                        <thead>
                            <tr>
                                    @if (Route::has('login'))
                                    @auth('admin') 
                                    <th><span><input type="checkbox" id="check_all"></span></th>
                                    @endauth
                                    @endif
                                    <th>
                                        @if (Route::has('login'))
                                        @auth('admin') 
                                            Select All
                                        @endauth
                                        @endif
                                    </th>
                                    <th>
                                        Folder Name
                                    </th>
                                    <th>
                                        Create At
                                    </th>
                                    @if (Route::has('login'))
                                        @auth('admin') 
                                        <th>Actions</th>
                                        @endauth
                                    @endif
                            </tr>
                        </thead>
                            <tbody>
                            @foreach($separate_Folders_Table as $separateFoldersTable)
                                <tr id="{{$separateFoldersTable->id}}"> 
                                @if (Route::has('login'))
                                    @auth('admin') 
                                    <td><input type="checkbox" class="checkbox" id="{{$separateFoldersTable->id}}"></td>
                                    @endauth
                                @endif
                                    <td>
                                        <a href="{{route('FolderFiles.Show',['folder_id'=>$separateFoldersTable->id,'FileType'=>'ALLFILES','View'=>'LIST'])}}" title="Click">
                                            <img class="rounded" src="{{asset('/storage/archive/SeparateFolders/'.$separateFoldersTable->folder_name.'/'.$separateFoldersTable->cover_image_path)}}" class="rounded float-left" alt="normal"   width="100px;" height="70px;">
                                        </a>
                                    </td>
                                    <td>
                                        <div id="NormalButtonOfArchive">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                            <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                                            </svg>
                                            {{ $separateFoldersTable->folder_name}}
                                        </div>
                                    </td>
                                    <td>
                                        <div id="NormalButtonOfArchive">
                                        {{ date('j M Y, h:i a',strtotime($separateFoldersTable->created_at)) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" id="NormalButtonOfArchive">
                                            @if (Route::has('login'))
                                            @auth('admin')
                                            <a href="{{route('Folder.GetDetails',$separateFoldersTable->id)}}">
                                                <button type="button" class="btn btn-sm btn-outline-primary my-2 my-sm-0 mr-1" id="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg>
                                                </button>
                                            </a>
                                            <a href="#">
                                                <button type="button" class="btn btn-sm btn-outline-danger my-2 my-sm-0 mr-1"     onclick = "FolderDelete('{{$separateFoldersTable->id}}')">
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

    $(document).ready( function () {
        $('#folder_Table').DataTable({
            paging:false
        });

        $('#folder_Table_filter label input').on('input',function () {
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
        });
    } );

    $(document).ready(function () {

//***********************************Adding upload files***********************************

        $("#add_files_content").hide(); 
        $("#add_files_content_show").click(function(){
            $("#add_files_content").show();
            $("#add_files_content_show").hide();
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
//*************If all check box are checked than #check_all will be check****************
         $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
         });
//***********************************Multiple folder Delete***********************************

        $('#folder_delete').on('click', function(e) {
 
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('id'));
            });  

            if(idsArr.length <=0)  
            { 
                swal("An Omission!",'Please select atleast one folder to delete.', "error"); 
            }  else {  
                FoldersDelete(idsArr);                                   
            }  
        });
    });

//***********************************Singal folder Delete***********************************
    function FolderDelete(id){
        var idsArr = [];
        idsArr.push(id); 
        FoldersDelete(idsArr);          
    }
//*************************************Delete***********************************************
    function FoldersDelete(idsArr){
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary folders!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ route('Folder.Delete') }}",
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:{'Folders':idsArr},
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
                        swal("Cancelled", "Your imaginary folders is safe :)", "error");
                    }
                });               
    }
            
</script>

@endsection
