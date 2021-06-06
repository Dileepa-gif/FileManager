
<!----------------------------------------------------Upload modal and form------------------------------------------------------------------------>

<div class="modal fade" id="FileUploader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      @yield('Uploader-Singal Modal Title')
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      @yield('Uploader-Singal Modal Form')
      </div>
    </div>
  </div>
</div>

