

      @if($fileTable->file_type=='IMAGE')
      <img class="rounded" src="{{ asset('FileManagerSrc/src/IMAGE.png' ) }}" width="50px;">
      @elseif($fileTable->file_type=='VIDEO')
      <img class="rounded" src="{{ asset('FileManagerSrc/src/VIDEO.png' ) }}" width="50px;">
      @elseif($fileTable->file_type=='AUDIO')
      <img class="rounded" src="{{ asset('FileManagerSrc/src/AUDIO.png' ) }}" width="50px;">
      @elseif($fileTable->file_type=='DOCUMENT')
      <img class="rounded" src="{{ asset('FileManagerSrc/src/DOCUMENT.png' ) }}" width="50px;">
      @elseif($fileTable->file_type=='ARCHIVE')
      <img class="rounded" src="{{ asset('FileManagerSrc/src/ARCHIVE.png' ) }}" width="50px;">
      @elseif($fileTable->file_type=='OTHER')
      <img class="rounded" src="{{ asset('FileManagerSrc/src/OTHER.png' ) }}" width="50px;">
      @endif
