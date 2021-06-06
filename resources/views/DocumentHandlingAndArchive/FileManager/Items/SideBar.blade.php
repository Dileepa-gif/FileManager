<nav id="sidebar_archive">

        <ul class="list-unstyled components mb-5 scrollable-menu">
        <li><hr style="height:2px; background-color:#fff"></li>
        @if (Route::has('login'))
            @auth('admin')
            <li class="{{ (\Request::routeIs('AllFileSubmissions.Show')) ? 'active' : '' }}">
                <a href="{{route('AllFileSubmissions.Show')}}" title="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                </svg>
                All Submissions</i></a>
            </li>
            <li class="{{ (\Request::routeIs('MyFileSubmissionsList.Show')) ? 'active' : '' }}">
                @inject('CountOfNotSubmited', 'App\Http\Controllers\FileManager\FileSubmissionController')
                <a href="{{route('MyFileSubmissionsList.Show')}}" title="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
                My Submissions
                @isset($CountOfNotSubmited)
                    <span class="badge badge-warning">{{$CountOfNotSubmited::NotSubmitedCount()}}</span>
                @endisset 
                </a>
            </li>
            <li><hr style="height:2px; background-color:#fff"></li> 
            @elseauth('web')
            <li class="{{ (\Request::routeIs('MyFileSubmissionsList.Show')) ? 'active' : '' }}">
                @inject('CountOfNotSubmited', 'App\Http\Controllers\FileManager\FileSubmissionController')
                <a href="{{route('MyFileSubmissionsList.Show')}}" title="">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z"/>
                </svg>
                My Submissions
                @isset($CountOfNotSubmited)
                    <span class="badge badge-warning">{{$CountOfNotSubmited::NotSubmitedCount()}}</span>
                @endisset 
                </a>
            </li>
            <li><hr style="height:2px; background-color:#fff"></li> 
            @endauth
        @endif

         

        @if (Route::has('login'))
            @auth('admin')
        <li  class="{{ ((\Request::routeIs('AchiveFileSummary.Show'))||(\Request::routeIs('ArchiveSummaryFile.Show'))||(\Request::routeIs('TodayFiles.Show')) ||(\Request::routeIs('LastWeekFiles.Show')) ||(\Request::routeIs('GivenDateFiles.Show'))||(\Request::routeIs('GivenTwoDatesFiles.Show'))) ? 'active' : '' }}">
            <a href="{{route('AchiveFileSummary.Show')}}" title="">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
            <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
            </svg>
             Archive Summary 
          @empty($archive_List)
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
            <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
            </svg></a>
          @endempty
          @isset($archive_List)
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down" viewBox="0 0 16 16">
            <path d="M3.204 5h9.592L8 10.481 3.204 5zm-.753.659 4.796 5.48a1 1 0 0 0 1.506 0l4.796-5.48c.566-.647.106-1.659-.753-1.659H3.204a1 1 0 0 0-.753 1.659z"/>
            </svg></a>
            <ul role="menu">
                @foreach($archive_List as $archiveList)
                    <li class="{{ (\Request::is('Summary/Files/'.$archiveList['year'].'/'.$archiveList['month'])) ? 'active' : '' }}">
                        <a href="{{route('ArchiveSummaryFile.Show',['year'=>$archiveList['year'],'month'=>$archiveList['month']])}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                        <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        {{$archiveList['year']}} -> {{$archiveList['month']}} 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
                        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                        </svg>
                        </a>
                    </li>
                @endforeach
            </ul>
          @endisset
        </li>
        <li><hr style="height:2px; background-color:#fff"></li>
          @endauth
        @endif
        
        <li  class="{{ ((\Request::routeIs('SeparateFolder.Show'))||(\Request::routeIs('GalleryFolder.Show'))||(\Request::routeIs('FolderFiles.Show'))||(\Request::routeIs('FolderMyFiles.Show'))||(\Request::routeIs('LandingPageFiles.Show'))) ? 'active' : '' }}">
            <a  href="{{route('SeparateFolder.Show')}}" title="">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
            </svg>Folders
            </a>
        </li>
        @if((\Request::routeIs('SeparateFolder.Show'))||(\Request::routeIs('GalleryFolder.Show'))||(\Request::routeIs('FolderFiles.Show'))||(\Request::routeIs('FolderMyFiles.Show'))||(\Request::routeIs('LandingPageFiles.Show')))  
          @inject('SeparateFoldersTable', 'App\Http\Controllers\FileManager\ViewerController')
            @isset($SeparateFoldersTable)
                @foreach($SeparateFoldersTable::SeparateFoldersList()  as $separateFoldersTable)                
                <li class="{{ ((\Request::is('Folder/Files/'.$separateFoldersTable->id.'*'))||(\Request::is('Folder/MyFiles/'.$separateFoldersTable->id.'*')))? 'active' : '' }} ml-3">
                        <a href="{{route('FolderFiles.Show',['folder_id'=>$separateFoldersTable->id,'FileType'=>'ALLFILES','View'=>'LIST'])}}" title="Click">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder" viewBox="0 0 16 16">
                            <path d="M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z"/>
                        </svg>
                        {{ $separateFoldersTable->folder_name}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
                        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
                        </svg>
                        </a>
                    </li>
                @endforeach
            @endisset

            @endif
            <li><hr style="height:2px; background-color:#fff"></li>
           

        </ul>

</nav>
<script>
    (function($) {

        "use strict";

        var fullHeight = function() {

            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function(){
                $('.js-fullheight').css('height', $(window).height());
            });

        };
        fullHeight();

        $('#sidebar_archiveCollapse').on('click', function () {
        $('#sidebar_archive').toggleClass('active');
        });

    })(jQuery);
</script>
      