<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<!-- Modal -->
@php $user_id=-1; @endphp
@if (Route::has('login'))
    @auth('admin')
      @php $user_id=Auth::guard('admin')->user()->user_id; @endphp
    @elseauth('web')
      @php $user_id=Auth::user()->id; @endphp
    @endauth
@endif 
<div class="modal fade" id="DetailsViewerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div id="modal_file_name"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div id ="modal_file"></div>
            </br>
            <div class="btn-group">
              <a href="" id="modal_download_button">
                <button type="button" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                  </svg>
                </button>
              </a>
              @if (Route::has('login'))
                @auth('admin')
                <a href="" id="modal_edit_button">
                  <button type="button" class="btn btn-sm btn-outline-primary my-2 my-sm-0 mr-1" >
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                      </svg>
                  </button>
                </a>
                <span id="file_delete_">
                  <button type="button" class="btn btn-sm btn-outline-danger my-2 my-sm-0"  id="modal_delete_button" data-id="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                  </button>
                <span>
                @elseauth('web')
                  <button type="button" class="btn btn-sm btn-outline-danger my-2 mr-1 my-sm-0"  id="modal_member_delete_button" data-id="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg>
                  </button>
                @endauth
              @endif
              <span id="full_Screen"></span>
            </div>

            <div id="modal_file_size"></div>
            <div id="modal_file_description"></div>
            @if (Route::has('login'))
              <div id="modal_file_uploader"></div>
              <div id="modal_file_uploaded_at"></div>
              <div id="modal_file_updated_at"></div><br>
              
              <div id="modal_folder_list"></div><br>
            @endif

          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>

$('#DetailsViewerModal').on('hidden.bs.modal', function (e) {
  $( "#modal_file" ).html('');
});

$('#DetailsViewerModal').on('show.bs.modal',function(event)
  {
    var userId='<?php echo $user_id; ?>';
    var button=$(event.relatedTarget);
    var id=button.data('id');
    $.ajax({
         url:'{{route("FileDetails.Show","id")}}'.replace("id",id),
         type: 'get',
         dataType: 'json',
         success: function(data){
          if($.isEmptyObject(data.error)){
            $( "#modal_file_name" ).html('<h5><b>'+data.details_Of_File.real_name+'</b></h5>');
            var src_link= '{{asset("")}}'+'storage/'+data.details_Of_File.path+'/'+data.details_Of_File.data_name
            switch (data.details_Of_File.file_type) {
                case 'IMAGE':
                    $( "#modal_file" ).html('<div class="container-fluid"><img src="'+src_link+'" width="100%">');
                    break;
                case 'VIDEO':
                    $( "#modal_file" ).html('<video width="400" height="200" controls><source  src="'+src_link+'"></video>');                    
                    break;
                case 'AUDIO':
                    $( "#modal_file" ).html('<audio controls><source src="'+src_link+'"></audio>');
                    break;
                case 'DOCUMENT':
                    $( "#modal_file" ).html( '<iframe class="embed-responsive-item-fluid" src="'+src_link+'"></iframe>');
                    break;
                case 'ARCHIVE':
                    $( "#modal_file" ).html('<img src="{{asset('FileManagerSrc/src/archive.jpg' )}}" class="card-img-top-fluid" alt="normal" width="100px" height="100px">');
                    break;
                case 'OTHER':
                    $( "#modal_file" ).html('<img src="{{asset('FileManagerSrc/src/OTHER.png' )}}" class="card-img-top-fluid" alt="normal" width="100px" height="100px">');
                    break;
            }

            switch (data.details_Of_File.file_type) {
                case 'IMAGE':
                case 'VIDEO':
                case 'AUDIO':
                case 'DOCUMENT':
                $( "#full_Screen" ).html('<a href="'+src_link+'" target="_blank"><button type="button" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1"> <i class="fa fa-expand" aria-hidden="true"></i></button></a>');
                break;
            }

            
            let folder_list='<h6><b><i class="fa fa-list"></i> List of folders where this file currently exists</b></h6>';
            let gallery_folder_array=data.list_Of_Gallery_Folder;
            if(gallery_folder_array.length>0){
              folder_list += '<b><i class="fa fa-folder" aria-hidden="true"></i>Gallery</b><ulclass="scrollable-menu" id="GalleryFolderList" role="menu">';
              for (var i = 0; i < gallery_folder_array.length; i++)
              folder_list +='<li><i class="fa fa-folder" aria-hidden="true"></i>'+ gallery_folder_array[i].folder_name + '</li>';
              folder_list +='</ul>';
            }
            
            let separate_folder_array=data.list_Of_Separate_Folder;
            if( separate_folder_array.length>0){
              folder_list += '<b><ul  class="scrollable-menu" id="SeparateFolderList" role="menu">';
              for (var i = 0; i < separate_folder_array.length; i++)
              folder_list +='<li><i class="fa fa-folder" aria-hidden="true"></i>'+ separate_folder_array[i].folder_name + '</li>';
              folder_list +='</ul></b>';
            }

            if(data.details_Of_File.see_in_homepage==1){
              folder_list +='<b><ul><li><i class="fa fa-folder" aria-hidden="true"></i>Landing Page Images<li></ul></b>'
            }

            $( "#modal_file_size" ).html('<b>File Size - </b>'+ (data.file_Size)+' MB');
            if(!(data.file_Description==null)){
              $( "#modal_file_description" ).html('<b>Description - </b><br>'+ data.file_Description);
            }
            $( "#modal_download_button" ).attr("href",('{{route("Files.Download","id")}}'.replace("id",id)));
            $( "#modal_file_uploader" ).html('<b>Uploaded by - </b>'+ data.user_Name);
            $( "#modal_file_uploaded_at" ).html('<b>Uploaded at - </b>'+ data.created_At);
            if( $( "#modal_edit_button" ).length ) {
              $( "#modal_file_updated_at" ).html('<b>Last edited at - </b>'+ data.updated_At);
              $( "#modal_folder_list" ).html(folder_list);

              $( "#modal_edit_button" ).attr("href",'{{route("File.GetDetails","id")}}'.replace("id",id));
              $( "#modal_delete_button" ).attr("data-id",id);
            }
            if( $( "#modal_member_delete_button" ).length){
              $( "#modal_member_delete_button" ).hide();
              if(userId==data.details_Of_File.user_id){
                $( "#modal_member_delete_button" ).show();
                $( "#modal_member_delete_button" ).attr("data-id",id);
              }
            }

          }
          else
          {
            $('#DetailsViewerModal').modal('toggle');
            swal("Error!",'Whoops Something went wrong!!', "error"); 
	        }
         },
         error:function(data)
         {
            $('#DetailsViewerModal').modal('toggle');
            swal("Error!",'Whoops Something went wrong!!!', "error");
         }
       });
    
  });

  $('#modal_delete_button').on('click', function(event) {
    var id=$(this).data('id');
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
          })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('AllFiles.Delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+id,
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
  });


  $('#modal_member_delete_button').on('click', function(event) {
    var id=$(this).data('id');
    swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
          })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('MyFiles.Delete') }}",
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+id,
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
  });

</script>
