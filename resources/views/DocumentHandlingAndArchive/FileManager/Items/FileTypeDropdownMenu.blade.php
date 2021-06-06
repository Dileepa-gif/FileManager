
<div class="btn-group">
  <button type="button" class="btn btn-secondary btn-sm dropdown-toggle mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="FileTypeDropdownMenuButton">
    File Types
  </button>
  @isset($sub_Folder_Details)
    @empty($my_files)
    <div class="dropdown-menu dropdown-menu-right ">
        @if($view=='LIST')
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'ALLFILES','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">All files</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'IMAGE','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Image</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'VIDEO','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Video</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'AUDIO','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Audio</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'DOCUMENT','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Document</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'ARCHIVE','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Archive</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'OTHER','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Other</span></button></a>
        @elseif($view=='THUMBNAIL')
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'ALLFILES','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">All files</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'IMAGE','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Image</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'VIDEO','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Video</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'AUDIO','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Audio</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'DOCUMENT','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Document</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'ARCHIVE','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Archive</span></button></a>
        <a href="{{route('FolderFiles.Show',['folder_id'=>$sub_Folder_Details->id,'FileType'=>'OTHER','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Other</span></button></a>
        @endif
    </div>
    @endempty
    @isset($my_files)
    <div class="dropdown-menu dropdown-menu-right ">
        @if($view=='LIST')
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'ALLFILES','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">All files</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'IMAGE','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Image</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'VIDEO','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Video</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'AUDIO','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Audio</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'DOCUMENT','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Document</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'ARCHIVE','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Archive</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'OTHER','View'=>'LIST'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Other</span></button></a>
        @elseif($view=='THUMBNAIL')
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'ALLFILES','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">All files</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'IMAGE','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Image</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'VIDEO','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Video</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'AUDIO','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Audio</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'DOCUMENT','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Document</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'ARCHIVE','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Archive</span></button></a>
        <a href="{{route('FolderMyFiles.Show',['folder_id'=>$sub_Folder_Details->id,'my_files'=>'MYFILES','FileType'=>'OTHER','View'=>'THUMBNAIL'])}}"><button class="dropdown-item text-white" type="button"><span id="featureName">Other</span></button></a>
        @endif
    </div>
    @endisset
  @endisset
</div>

<script type="text/javascript">
    var file_type = {!! json_encode($file_type) !!};
    switch (file_type) {
        case 'ALLFILES':
            $( "#FileTypeDropdownMenuButton" ).text( "All files" );
            break;  
        case 'IMAGE':
            $( "#FileTypeDropdownMenuButton" ).text( "Image" );
            break; 
        case 'VIDEO':
            $( "#FileTypeDropdownMenuButton" ).text( "Video" );
            break;
        case 'AUDIO':
            $( "#FileTypeDropdownMenuButton" ).text( "Audio" );
            break;    
        case 'DOCUMENT':
            $( "#FileTypeDropdownMenuButton" ).text( "Document" );
            break;
        case 'ARCHIVE':
            $( "#FileTypeDropdownMenuButton" ).text( "Archive" );
            break;
        case 'OTHER':
            $( "#FileTypeDropdownMenuButton" ).text( "Other" );
            break;                  
        }
</script>
