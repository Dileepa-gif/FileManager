      @if($file_Edit->file_type=='IMAGE')
      <img class="rounded" src="{{asset('storage/'.$file_Edit->path.'/'.$file_Edit->data_name)}}" class="img-rounded" alt="normal" width="100%">
      @elseif($file_Edit->file_type=='VIDEO')
      <video width="200" height="150" controls>
        <source src="{{asset('storage/'.$file_Edit->path.'/'.$file_Edit->data_name)}}">
      </video>
      @elseif($file_Edit->file_type=='AUDIO')
      <audio controls>
        <source src="{{asset('storage/'.$file_Edit->path.'/'.$file_Edit->data_name)}}">
      </audio>
      @elseif($file_Edit->file_type=='DOCUMENT')
      <iframe class="embed-responsive-item-fluid" src="{{asset('/storage/'.$file_Edit->path.'/'.$file_Edit->data_name)}}"></iframe>
      @elseif($file_Edit->file_type=='ARCHIVE')
      <img class="rounded" src="{{asset('FileManagerSrc/src/archive.jpg' )}}" class="card-img-top-fluid" alt="normal" width="100px" height="100px">
      @elseif($file_Edit->file_type=='OTHER')
      <img class="rounded" src="{{asset('FileManagerSrc/src/OTHER.png' )}}" class="card-img-top-fluid" alt="normal" width="100px" height="100px">
      @endif