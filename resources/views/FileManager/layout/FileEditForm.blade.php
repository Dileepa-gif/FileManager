@extends('layouts.app',['activePage' => 'archiving'])
@section('content')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="p-5" id="file_edit">
   
<div class="container-fluid">
    <div class="row justify-content-center" id="titleNewpost">
        <div class="col-md-3"><br>
            <div class="d-flex justify-content-center"><h3><b>File Edit Form</b></h3></div>
        </div>
    </div>
    <div class="row justify-content-center" >
        <div class="col-md-3">
            <div class="d-flex justify-content-center">
                @include('FileManager.Items.FileTypeView')
            </div>
        </div>
    </div>
    <div class="row justify-content-center" >
        <div class="col-md-3">
            @isset($Original_Folder)
            <div class="d-flex justify-content-center">
                <h3>
                    <b>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                        <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        </svg>
                        {{$Original_Folder->folder_name}}
                    </b>
                </h3>
            </div> 
            <div class="d-flex justify-content-center"><small>(The folder to which this file belongs)</small></div>
            
            @endisset
            <div class="d-flex justify-content-center">
                @isset($file_Edit->user->name)
                    <p>Upload by :  {{$file_Edit->user->name}}</p>
                @endisset
            </div>
        </div>
    </div>

    <div class="row justify-content-center" id="newpostForm">
        <div class="col-md-11">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <form action="{{route('File.Update',$file_Edit->id)}}" id="FileEditForm" method="POST" enctype="multipart/form-data">
            
                {{csrf_field()}}
                {{method_field("PUT")}}
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="Name" class="form-control @error('Name') is-invalid @enderror" value="{{$file_Edit->real_name}}" placeholder="Enter Name" required minlength="5" maxlength="30">
                    @error('Name')
                    <p class="text-danger">{{$errors->first('Name')}}</p>
                    @enderror
                </div>
                    
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control @error('Description') is-invalid @enderror  z-depth-1" name="Description" id="DescriptionId" rows="3" required maxlength="255">{{$file_Edit->file_description}}</textarea>
                    @error('Description')
                    <p class="text-danger">{{$errors->first('Description')}}</p>
                    @enderror
                </div>

                @if($file_Edit->approval==1)
                <input type="checkbox" id="ApproveFile" name="ApproveFile" value=1 checked>
                <label for="ApproveFile">Approve File </label><br>
                    @error('ApproveFile')
                        <p class="text-danger">{{$errors->first('ApproveFile')}}</p>
                    @enderror
                @elseif($file_Edit->approval==0)
                <input type="checkbox" id="ApproveFile" name="ApproveFile" value=1>
                <label for="ApproveFile">Approve File</label><br>
                    @error('ApproveFile')
                        <p class="text-danger">{{$errors->first('ApproveFile')}}</p>
                    @enderror
                @endif

                @if(($file_Edit->file_type=='IMAGE')||($file_Edit->file_type=='VIDEO'))
                    @if($file_Edit->see_in_gallery==1)
                    <input type="checkbox" id="SeeInGallery" name="SeeInGallery" value=1 checked>
                    <label for="SeeInGallery">Show from gallery</label><br>
                        @error('SeeInGallery')
                            <p class="text-danger">{{$errors->first('SeeInGallery')}}</p>
                        @enderror
                    @elseif($file_Edit->see_in_gallery==0)
                    <input type="checkbox" id="SeeInGallery" name="SeeInGallery" value=1>
                    <label for="SeeInGallery">Show from gallery</label><br>
                        @error('SeeInGallery')
                            <p class="text-danger">{{$errors->first('SeeInGallery')}}</p>
                        @enderror
                    @endif
                @endif
                @if($file_Edit->file_type=='IMAGE')
                    @if($file_Edit->path=='archive/ImagesOfLandingPage')
                            <input type="checkbox" id="SeeInHomePage" name="SeeInHomePage" value=1 checked disabled>
                            <label for="SeeInHomePage">Show from home page</label><br>
                            <small>(This file belongs to 'Images Of LandingPage' folder)</small>
                    @else
                            @if($file_Edit->see_in_homepage==1)
                            <input type="checkbox" id="SeeInHomePage" name="SeeInHomePage" value=1 checked>
                            <label for="SeeInHomePage">Show from home page</label><br>
                                @error('SeeInHomePage')
                                    <p class="text-danger">{{$errors->first('SeeInHomePage')}}</p>
                                @enderror
                            @elseif($file_Edit->see_in_homepage==0)
                            <input type="checkbox" id="SeeInHomePage" name="SeeInHomePage" value=1>
                            <label for="SeeInHomePage">Show from landing page</label><br>
                                @error('SeeInHomePage')
                                    <p class="text-danger">{{$errors->first('SeeInHomePage')}}</p>
                                @enderror
                            @endif
                    @endif
                @endif
                <br>
                <label for="foldersListId">Share with folders</label>
                @error('FoldersId')
                    <p class="text-danger">{{$errors->first('FoldersId')}}</p>
                @enderror

                @error('FoldersId.*')
                    <p class="text-danger">{{$errors->first('FoldersId.*')}}</p>
                @enderror
                <div style="height: 580px;overflow: scroll;">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="foldersListId">
                            <thead>
                                <tr>
                                    <th><span><input type="checkbox" id="check_all_folders">Select All</span></th>
                                    <th>Folder Name</th>
                                    <th>Folder Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_Folders)>0)
                                    @foreach($all_Folders as $allFolder)
                                    @isset($Original_Folder)
                                        @if($Original_Folder->id!=$allFolder->id)
                                            <tr>
                                            @php
                                                $status=0;
                                            @endphp
                                            @if(count($shared_Folders)>0)
                                                @foreach($shared_Folders as $sharedFolders)
                                                    @if($sharedFolders->id==$allFolder->id)
                                                        <td><input type="checkbox" name="FoldersId[]" class="checkbox_folder" value="{{$allFolder->id}}" checked/> </td>
                                                        @php
                                                            $status=1;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($status!=1)
                                                <td><input type="checkbox" name="FoldersId[]" class="checkbox_folder" value="{{$allFolder->id}}"/> </td>
                                            @endif
                                                <td>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                                                    <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                                                    </svg>
                                                    {{$allFolder->folder_name}}
                                                </td>

                                                @if($allFolder->gallery==1)
                                                <td>Gallery Album</td> 
                                                @elseif($allFolder->separate==1)
                                                <td>Separate Folder</td>                                      
                                                @endif
                                            </tr>
                                        @endif
                                    @endisset
                                    @empty($Original_Folder)
                                        <tr>
                                        @php
                                            $status=0;
                                        @endphp
                                        @if(count($shared_Folders)>0)
                                            @foreach($shared_Folders as $sharedFolders)
                                                @if($sharedFolders->id==$allFolder->id)
                                                    <td><input type="checkbox" name="FoldersId[]" class="checkbox_folder" value="{{$allFolder->id}}" checked/> </td>
                                                    @php
                                                        $status=1;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                        @if($status!=1)
                                            <td><input type="checkbox" name="FoldersId[]" class="checkbox_folder" value="{{$allFolder->id}}"/> </td>
                                        @endif
                                            <td><i class="bi bi-person-fill"></i>  {{$allFolder->folder_name}}</td>
                                            @if($allFolder->gallery==1)
                                            <td>Gallery Album</td> 
                                            @elseif($allFolder->separate==1)
                                            <td>Separate Folder</td>                                      
                                            @endif
                                        </tr>
                                    @endempty
                                    @endforeach
                                @endif
                            </tbody>
                        
                        </table>
                    </div>
                </div>
            </form>
            
            <div class="modal-footer">
                <button type="button"  class="btn btn-secondary"  id="back" onclick="goBack()">Cancle</button>
                <button id="FileEditFormSubmit" name="submit" class="btn btn-success">Update</button>
            </div>
            </div>
        </div>
    </div>
</div>

    <script>
    $(document).ready( function () {
        $('#foldersListId').DataTable({
            paging:           false
        });
        $('#foldersListId_filter label input').on('input',function () {
            if($('.checkbox_folder:checked').length == $('.checkbox_folder').length){
                $('#check_all_folders').prop('checked',true);
            }else{
                $('#check_all_folders').prop('checked',false);
            }
        });
    });
    $(document).ready(function () {
        $('#check_all_folders').on('click', function(e) {
            if($(this).is(':checked',true))  
            {
                $(".checkbox_folder").prop('checked', true);  
            } else {  
                $(".checkbox_folder").prop('checked',false);  
            }  
        });

        $('.checkbox_folder').on('click',function(){
            if($('.checkbox_folder:checked').length == $('.checkbox_folder').length){
                $('#check_all_folders').prop('checked',true);
            }else{
                $('#check_all_folders').prop('checked',false);
            }
        });
    });
    function goBack() {
        window.history.back();
        console.log('We are in previous page');
    }

    $(document).ready(function(){
        $("#FileEditFormSubmit").click(function(){
            
            swal({
            title: "Are you sure?",
            text: "You intend to modify the file details.!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $( "#FileEditForm" ).submit();
                    } else {
                        swal("Cancelled", "Your file's details are safe :)", "error");
                    }
            });  
        });
    });
    
</script>
</div>

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



             