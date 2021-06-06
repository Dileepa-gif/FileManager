@extends('layouts.app',['activePage' => 'archiving'])
@section('content')
  <div class="pt-0">
    <div class="container-fluid">
          @include('FileManager.Items.Modals.FilesUploader')
          @include('FileManager.Items.Modals.FileUploader')
            @yield('Modal')
          <div class="row justify-content-center bg-info md-auto" >
            <div class="col-11 ">
              @yield('Options')
            </div>
          </div>
      </div>
      <div class="wrapper d-flex align-items-stretch">
            @include('FileManager.Items.SideBar')
            <div id="contentOfFileManager" class="margin-top">
            <div class="container-fluid">
                    @yield('Folder Details')
                    @yield('Body')
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
        swal("Error !",notification, "error").then(function(){
            location.reload();
        });
    </script>

  @elseif(session()->has('errors'))
  <script>
        notification = @json(session()->pull("errors"));
        let array =notification ;
        let list = '';
        for (var i = 0; i < array.length; i++)
            list += array[i] + '\n';
        swal("Error !",list, "error").then(function(){
            location.reload();
        });
    </script>
@endif
      @yield('DMAA script content')
    </div>
@endsection
