@extends('FileManager.layout.FileManagerMain')

@section('Uploader Modal Title')
<div style="margin-left: auto;margin-right: auto "><h5 class="modal-title"><b><i class="fa fa-upload" aria-hidden="true"></i>Upload Files</b></h5></div>
@endsection

@section('Uploader Modal Form')
            @isset($sub_Folder_Details)

            <form name="frm" action ="{{ route('MultipleFiles.Upload') }}" method="POST" enctype="multipart/form-data" id="FilesForm">
                {{csrf_field()}}
                @isset($sub_Folder_Details)
                    <h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                            <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        </svg>
                        {{$sub_Folder_Details->folder_name}}
                    </h5>
                    <input type="hidden" name="FolderId" id="FolderId" class= "form-control"  readonly="readonly" required  value="{{$sub_Folder_Details->id}}" hide>
                @endisset    

                    <div class="user-image mb-3 text-center">
                        <div class="filesPreview"  id= "filesPreviewDMAA"> </div>
                    </div> 
                    <br>

                    <div class="custom-file">
                        <input type="file" name="UploadFiles[]" class="form-control" id="Files" multiple="multiple" onclick = "clearContent('filesPreviewDMAA')" >    
                    </div>
                    <small>(Note that the maximum number of files that can be uploaded is 15.)</small><br><br>


                        <div class="progress" id="FileUploaderProgress">
                            <div class="bar"></div >
                            <div class="percent">0%</div >
                        </div>
                        <h5 class="text-central" id="completedMsg"></h5>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="uploader_close_button">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary " id="uploader_submit_button">Upload Files</button>
                    </div>
            </form>
            @endisset 

@endsection






@section('Uploader-Singal Modal Title')
<div style="margin-left: auto;margin-right: auto "><h5 class="modal-title"><b><i class="fa fa-upload" aria-hidden="true"></i>Upload File</b></h5></div>
@endsection

@section('Uploader-Singal Modal Form')
            @isset($sub_Folder_Details)

            <form name="frm" action ="{{ route('SingalFile.Upload') }}" method="POST" enctype="multipart/form-data" id="FileForm">
                {{csrf_field()}}
                @isset($sub_Folder_Details)
                    <h5>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                            <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        </svg>
                        {{$sub_Folder_Details->folder_name}}
                    </h5>
                    <input type="hidden" name="FolderId" id="FolderId" class= "form-control"  readonly="readonly" required value="{{$sub_Folder_Details->id}}" hide>
                @endisset
                    <div class="form-group">
                        <label for="FileName">Name of file <abbr class="req" title="required">*</abbr></label>
                        <input type="text" name="FileName" id="FileNameId" class= "form-control" required minlength="4" maxlength="30">
                    </div>
                    
                    <div  class="form-group">
                        <label for="FileDescriptionId">Write description about file</label>
                        <textarea class="form-control z-depth-1" name="FileDescription" id="FileDescriptionId"  rows="3" placeholder="Write something here..."  maxlength="255"></textarea>
                    </div>

                    <div class="custom-file">
                        <label for="UploadFileId">Insert File <abbr class="req" title="required">*</abbr></label>
                        <input type="file" name="UploadFile" class="form-control" id="UploadFileId" required>    
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary ">Upload Files</button>
                    </div>
            </form>
            @endisset 

@endsection


@section('Modal')
@include('FileManager.Items.Modals.DetailsViewer')
@endsection

@section('Location')
@isset($location)
<b style="color:#2F89FC">Location :- {{$location}}</b>
@endisset
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


@section('Folder Details')
<div class="row justify-content-left">
    <div class="col-12">
    @isset($sub_Folder_Details)
    <div class="d-flex justify-content-center">
        <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
            </svg>
            <b>{{$sub_Folder_Details->folder_name}}</b>
        </h1>
    </div>
    <a id="show_More" class="text-info" data-toggle="collapse" href="#collapse_folder_description" role="button" aria-expanded="false" aria-controls="collapseExample">
        Show More....
    </a>
    <div class="collapse" id="collapse_folder_description">
        <h6><b>Folder description</b></h6>
        <div class="card card-body">
        {{$sub_Folder_Details->folder_description}}
        </div>
    </div>
    @endisset
    </div>
</div>
@endsection




@section('Body')
<div class="row justify-content-center">
    <div class="col-12" id="ButtonOfArchive">
    <span>
        @if (Route::has('login'))
            @auth('web')

                        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'ALLFILES','View'=>'LIST'])}}" title="Click"><button type="button" class="btn btn-outline btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                            </svg><span id="featureName">Full Content</span></button>
                        </a>

                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-upload" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                </svg> <span id="featureName">Files Upload</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right ">
                                <a href="#"><button class="dropdown-item text-white" type="button" data-toggle="modal" data-target="#FilesUploader"><span id="featureName">Multiple files</span></button></a>
                                <a href="#"><button class="dropdown-item text-white" type="button" data-toggle="modal" data-target="#FileUploader"><span id="featureName">Singal File</span></button></a>
                            </div>
                        </div>

                        <a href="#"><button type="button" class="btn btn-outline btn-sm" id="my_file_delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg> <span id="featureName">Delete Files</span></button>
                        </a>
            @elseauth('admin')
                        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'ALLFILES','View'=>'LIST'])}}" title="Click"><button type="button" class="btn btn-outline btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                            </svg><span id="featureName">Full Content</span></button>
                        </a>

                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-upload" viewBox="0 0 16 16">
                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                </svg> <span id="featureName">Files Upload</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right ">
                                <a href="#"><button class="dropdown-item text-white" type="button" data-toggle="modal" data-target="#FilesUploader"><span id="featureName">Multiple files</span></button></a>
                                <a href="#"><button class="dropdown-item text-white" type="button" data-toggle="modal" data-target="#FileUploader"><span id="featureName">Singal File</span></button></a>
                            </div>
                        </div>

                        <a href="#"><button type="button" class="btn btn-outline btn-sm" id="my_file_delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg> <span id="featureName">Delete Files</span></button>
                        </a> 
            @endauth
        @endif
        @if($file_type=='IMAGE')
            @if($view=='LIST')
           <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES', 'FileType'=>'IMAGE','View'=>'THUMBNAIL'])}}"><button type="button" class="btn btn-outline btn-sm" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-aspect-ratio" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                    <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z"/>
                </svg> <span id="featureName">View As Thumbanail</span></button>
            </a>
            @elseif($view=='THUMBNAIL')
            <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES', 'FileType'=>'IMAGE','View'=>'LIST'])}}"><button type="button" class="btn btn-outline btn-sm" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg><span id="featureName">View As List</span></button>
            </a>
            @endif
        @elseif($file_type=='VIDEO')
            @if($view=='LIST')
            <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES', 'FileType'=>'VIDEO','View'=>'THUMBNAIL'])}}"><button type="button" class="btn btn-outline btn-sm" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-aspect-ratio" viewBox="0 0 16 16">
                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                    <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z"/>
                </svg> <span id="featureName">View As Thumbanail</span></button>
            </a>
            @elseif($view=='THUMBNAIL')
            <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES', 'FileType'=>'VIDEO','View'=>'LIST'])}}"><button type="button" class="btn btn-outline btn-sm" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg><span id="featureName">View As List</span></button>
            </a>
            @endif
        @endif
    
        @isset($file_Table)
        @include('FileManager.Items.FileTypeDropdownMenu')
        @endisset
    </span>

    </div>
</div>
@if($view=='LIST')
<div class="row justify-content-center">
    <div class="col-12">
        <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <div style="height: 580px;overflow: scroll;">
                <div class="table-responsive">
                <table class="table table-hover" id="file_table_id">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="check_all"><br>Select All</th>
                            <th>File Name</th>
                            <th>File Type</th>
                            <th></th>
                            <th>Approval</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($file_Table->count())
                        @foreach($file_Table as $key => $fileTable)
                            <tr  id="tr_{{$fileTable->id}}"> 
                                <td><input type="checkbox" class="checkbox" id="{{$fileTable->id}}"></td>
                                <td>{{ $fileTable->real_name}}</td>
                                <td>{{ $fileTable->file_type}}</td>
                                <td> @include('FileManager.Items.FileType')</td>

                                @if($fileTable->approval==1)
                                <td><span class="text-success">Approved</span></td>
                                @elseif($fileTable->approval==0)
                                <td><span class="text-warning">Not Approved</span></td>
                                @endif

                                @if($fileTable->approval==0)
                                <td> <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}" class="btn btn-sm btn-outline-primary my-2 my-sm-0"><i class="fa fa-eye-slash fa-x" aria-hidden="true"></i></button></td>
                                @elseif($fileTable->approval==1)
                                <td> <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}" class="btn btn-sm btn-outline-primary my-2 my-sm-0"><i class="fa fa-eye fa-x" aria-hidden="true"></i></button></td>
                                @endif

                            
                            </tr>
                        @endforeach
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
@elseif($view=='THUMBNAIL')
<div class="row justify-content-center">
    <div class="col-12">
        <div style="height: 580px;overflow: scroll;">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <div class="gallery" id="gallery"> 
                @foreach($file_Table as $key => $fileTable)
                    @if($fileTable->file_type=='IMAGE')
                    <div  class="mb-3 pics all 2 animation" style="">
                        <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}">
                        <img class="rounded" src="{{asset('/storage/'.$fileTable->path.'/'.$fileTable->data_name)}}" class="img-rounded" alt="normal" width="100%">
                        </button>
                        <input type="checkbox" class="checkbox" id="{{$fileTable->id}}">
                        @if($fileTable->approval==1)
                        <span class="text-success">Approved</span>
                        @elseif($fileTable->approval==0)
                        <span class="text-warning">Not Approved</span>
                        @endif
                    </div>
                    @endif
                @endforeach
                </div> 
                <div class="gallery" id="gallery">  
                @foreach($file_Table as $key => $fileTable)
                    @if($fileTable->file_type=='VIDEO')
                    <div  class="mb-3 pics all 2 animation" style="">
                        <button type="button" data-toggle="modal" data-target="#DetailsViewerModal" data-id="{{ $fileTable->id}}">
                        <video muted width="100%" >
                            <source src="{{asset('/storage/'.$fileTable->path.'/'.$fileTable->data_name)}}">
                        </video>
                        </button>
                        <input type="checkbox" class="checkbox" id="{{$fileTable->id}}">
                        @if($fileTable->approval==1)
                        <span class="text-success">Approved</span>
                        @elseif($fileTable->approval==0)
                        <span class="text-warning">Not Approved</span>
                        @endif
                        <br>
                    </div>
                    @endif
                @endforeach
                </div>
                @if(isset($file_Table))
                {{$file_Table->links()}}
                @endif
            </div>
        <div>
    </div>
</div>
@endif
@endsection

@section('DMAA script content')


 
 
<script type="text/javascript">
//***********************************Data table****************************************
    $(document).ready( function () {
        $('#file_table_id').DataTable({
            "info": false,
            paging:false
        });

        $('#file_table_id_filter label input').on('input',function () {
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
        });
    } );

    $(document).ready(function () {
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
//***********************************Multiple Files Delete***********************************
        $('#my_file_delete').on('click', function(e) {
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('id'));
            });  
            if(idsArr.length <=0)  
            { 
                swal("An Omission!",'Please select atleast one file to delete.', "error"); 
            }  else {  
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary files",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var strIds = idsArr.join(","); 
                            $.ajax({
                                url: "{{ route('MyFiles.Delete') }}",
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
                                    swal("Error!","Something went wrong.", "error");
                                }
                            });
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });                                  
            }  
        });
//***********************************Multiple file approve***********************************
        $('#file_approve').on('click', function(e) {
        
            var idsArr = [];  
            $(".checkbox:checked").each(function() {  
                idsArr.push($(this).attr('id'));
            });  


            if(idsArr.length <=0)  
            { 
                swal("An Omission!",'Please select atleast one record to approve.', "error"); 
            }  else {  
                swal({
                    title: "Are you want to approve?",
                    text: "",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willApprove) => {
                    if (willApprove) {
                        var strIds = idsArr.join(","); 
                        $.ajax({
                            url: "{{ route('Files.Approve') }}",
                            type: 'POST',
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
                        swal("Cancelled", "Not approved any file:)", "error");
                    }
                });                             
            }  
        });

        $('#collapse_folder_description').on('shown.bs.collapse', function () {
            $( "#show_More" ).html('Show Less....');
        });

        $('#collapse_folder_description').on('hidden.bs.collapse', function () {
            $( "#show_More" ).html('Show More....');
        });
    
    });
</script>



@endsection
