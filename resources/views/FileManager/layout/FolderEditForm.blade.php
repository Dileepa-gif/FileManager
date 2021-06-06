@extends('layouts.app',['activePage' => 'archiving'])
@section('content')
    <div class="p-5" id="folder_edit">
        <div class="container-fluid">
            <div class="row justify-content-center" id="titleNewpost">
                <div class="col-md-3"><br>
                    <div class="d-flex justify-content-center"><h3><b>Folder Edit Form</b></h3></div>
                </div>
            </div>
            <div class="row justify-content-center" >
                <div class="col-md-3">
                    @if($Folder_Edit->gallery)
                    <img class="rounded" src="{{asset('/storage/archive/GalleryFolders/'.$Folder_Edit->folder_name.'/'.$Folder_Edit->cover_image_path)}}" class="img-rounded" alt="normal" width="100%">
                    @elseif($Folder_Edit->separate)
                    <img class="rounded" src="{{asset('/storage/archive/SeparateFolders/'.$Folder_Edit->folder_name.'/'.$Folder_Edit->cover_image_path)}}" class="img-rounded" alt="normal" width="100%">
                    @endif
                </div>
            </div>
            <div class="row justify-content-center" >
                <div class="col-md-3">
                    <div class="d-flex justify-content-center">
                        @isset($Folder_Edit->admin->user->name)
                        <p>Last Edit By :  {{$Folder_Edit->admin->user->name}}</p>
                        @endisset
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <form action="{{route('FolderDetails.Update',$Folder_Edit->id)}}" id="FolderEditForm" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{method_field("PUT")}}
                                <div class="form-group">
                                    <label for="FolderNameId">Name of folder</label>
                                    <input type="text" name="FolderName" id="FolderNameId" value="{{$Folder_Edit->folder_name}}" class= "form-control" required minlength="4" maxlength="60">
                                </div>
                                    @error('FolderName')
                                        <p class="text-danger">{{$errors->first('FolderName')}}</p>
                                    @enderror 
                                <div class="custom-file">
                                    <label for="FolderCoverImage">Insert new cover image</label>
                                    <input type="file" name="FolderCoverImage" class="form-control" id="FolderCoverImage" accept="image/*" >  
                                    @error('FolderCoverImage')
                                        <p class="text-danger">{{$errors->first('FolderCoverImage')}}</p>
                                    @enderror  
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control @error('FolderDescription') is-invalid @enderror  z-depth-1" name="FolderDescription" id="FolderDescriptionId" rows="3"  required maxlength="255">{{$Folder_Edit->folder_description}}</textarea>
                                    @error('FolderDescription')
                                        <p class="text-danger">{{$errors->first('FolderDescription')}}</p>
                                    @enderror 
                                </div>

                                <div class="form-check">
                                @if ($Folder_Edit->hidden_for_member==1)
                                    <input class="form-check-input" type="checkbox" name="hideFromMember" id="hideFromMember" value=1 checked>
                                @else
                                    <input class="form-check-input" type="checkbox" name="hideFromMember" id="hideFromMember" value=1>
                                @endif
                                    <label class="form-check-label" for="hideFromMember">
                                        Hide from member
                                    </label>
                                    @error('hideFromMember')
                                        <p class="text-danger">{{$errors->first('hideFromMember')}}</p>
                                    @enderror  
                                </div>

                                <div class="form-check">
                                @if ($Folder_Edit->hidden_for_visitor==1)
                                    <input class="form-check-input" type="checkbox" name="hideFromVisitor" id="hideFromVisitor" value=1 checked>
                                @else
                                    <input class="form-check-input" type="checkbox" name="hideFromVisitor" id="hideFromVisitor" value=1>
                                @endif
                                    <label class="form-check-label" for="hideFromVisitor">
                                        Hide from visitor   
                                    </label>
                                    @error('hideFromVisitor')
                                        <p class="text-danger">{{$errors->first('hideFromVisitor')}}</p>
                                    @enderror  
                                </div>
                        </form>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary"  id="back" onclick="goBack()">Cancle</button>
                        <button id="FolderEditFormSubmit" name="submit" class="btn btn-success">Update</button>
                    </div>
                    </div>
                </div>
            </div>
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
        let array =notification ;
        let list = '';
        for (var i = 0; i < array.length; i++)
            list += array[i] + '\n';
        swal("Error!",list, "error").then(function(){
            location.reload();
        });
    </script>
@endif


<script>
    function goBack() {
        window.history.back();
        console.log('We are in previous page');
    }

    $(document).ready(function(){
        $("#FolderEditFormSubmit").click(function(){
            
            swal({
            title: "Are you sure?",
            text: "You intend to modify the folder details.!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $( "#FolderEditForm" ).submit();
                    } else {
                        swal("Cancelled", "Your folder's details are safe :)", "error");
                    }
            });  
        });
    });
    
</script>
</div>
@endsection