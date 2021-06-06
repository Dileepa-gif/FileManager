<!----------------------------------------------------Upload modal and form------------------------------------------------------------------------>

<div class="modal fade" id="FilesUploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      @yield('Uploader Modal Title')
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @yield('Uploader Modal Form')
      </div>
    </div>
  </div>
</div>
<script>
/*------------------------------------------------------------------------Files loader--------------------------------------------------------------*/
    $(function() {
        // Multiple images preview with JavaScript
        var multiFilesPreview= function(input, filesPreviewPlaceholder) 
        {

            if (input.files) 
            {
                var filesAmount = input.files.length;
                var total_file_size=0;
                for (i = 0; i < filesAmount; i++) {
                    total_file_size+=input.files[i].size;
                }
                if(filesAmount>15){
                    swal("Cancelled", "The maximum number of files that can be uploaded at a time is 15", "warning");
                    $( "#filesPreviewDMAA" ).html('');
                    $("#FilesForm").trigger("reset");
                    return;
                }else if(total_file_size>209715200){
                    swal("Cancelled", "The maximum capacity that can be uploaded at a time is 200 MB.", "warning");
                    $( "#filesPreviewDMAA" ).html('');
                    $("#FilesForm").trigger("reset");
                    return;
                }

                for (i = 0; i < filesAmount; i++) 
                {
                    var reader = new FileReader();
                    var fileName =(input.files[i].name).toLowerCase();

                   //Images------------------------------------------------------------------------
                    if (/\.(jpe?g|jpe|jif|jfif|jfi|png|gif|webp|tiff|tif|svg|svgz|psd|raw|bmp)$/i.test(fileName)) {
                        reader.onload = function(event) {   
                            $($.parseHTML('<img class="rounded">')).attr('src', event.target.result).appendTo(filesPreviewPlaceholder);
                        }
                    }

                    //Videoes----------------------------------------------------------------------
                    else if (/\.(mp4|m4a|m4v|f4v|m4b|m4r|f4b|mov|3gp|3gp2|3gpp|3gpp2|wmv|wma|asf|webm)$/i.test(fileName)) {
                        reader.onload = function(event) {
                            $($.parseHTML('<video width="200" height="150" muted><source></video>')).attr('src', event.target.result).appendTo(filesPreviewPlaceholder);
                        }
                    }

                    //PDF/TXT----------------------------------------------------------------------
                    else if (/\.(pdf|txt)$/i.test(fileName)) {
                        reader.onload = function(event) {
                            $($.parseHTML('<iframe class="embed-responsive-item-fluid"></iframe>')).attr('src', event.target.result).appendTo(filesPreviewPlaceholder);
                        }
                    }

                    //Audio----------------------------------------------------------------------
                    else if (/\.(mp3)$/i.test(fileName)) {
                        reader.onload = function(event) {
                            $($.parseHTML('<img class="rounded" src="{{ asset('FileManagerSrc/src/AUDIO.png' ) }}">')).appendTo(filesPreviewPlaceholder);
                        }
                    }
                   
                   //Zip|7z|Rar----------------------------------------------------------------------
                    else if (/\.(zip|7z|rar)$/i.test(fileName)) {
                        reader.onload = function(event) { 
                            $($.parseHTML('<img class="rounded" src="{{ asset('FileManagerSrc/src/archive.jpg' ) }}">')).appendTo(filesPreviewPlaceholder);
                        }
                    }
                    else
                    {
                        reader.onload = function(event) { 
                            $($.parseHTML('<img class="rounded" src="{{ asset('FileManagerSrc/src/OTHER.png' ) }}">')).appendTo(filesPreviewPlaceholder);
                        }

                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#Files').on('change', function() {
          multiFilesPreview(this, '#filesPreviewDMAA');
        });
    });  
    /*------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    
    /*------------------------------------------------------------------------Images loading clear----------------------------------------------------------------*/
    $('#FilesUploader').on('hidden.bs.modal', function (e) {
        $( "#filesPreviewDMAA" ).html('');
        $("#FilesForm").trigger("reset");
    });


    function clearContent(elementID) { 
        document.getElementById(elementID).innerHTML = ""; 
    } 
    /*-----------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    function resetForm(formId,Id) {
          document.getElementById(formId).reset();
          clearContent(Id);
    }


    $(function() {
        $(document).ready(function(){
            var bar = $('.bar');
            var percent = $('.percent');
            $('#FilesForm').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                    $( "#uploader_submit_button" ).prop( "disabled", true );
                    $( "#uploader_close_button" ).prop( "disabled", true );
                },
                complete: function(xhr) {
                
                },
                success: function(data) {

                    if($.isEmptyObject(data.error)){
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        resetForm('FilesForm','filesPreviewDMAA');
                        swal("Succeeded !",data.success , "success").then(function(){ 
                        location.reload();
                        });
                    }
                    else
                    {
                        let array =data.error ;
                        let list = '';
                        for (var i = 0; i < array.length; i++)
                            list += array[i] + '\n';
                        swal("Error!",list, "error");
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                        resetForm('FilesForm','filesPreviewDMAA');
                        $( "#uploader_submit_button" ).prop( "disabled", false );
                        $( "#uploader_close_button" ).prop( "disabled", false );
                    }
                    
                },
            });
        }); 
    });

</script>

