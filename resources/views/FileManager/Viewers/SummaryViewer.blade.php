@extends('FileManager.layout.FileManagerMain')
@section('Modal')
@include('FileManager.Items.Modals.DetailsViewer')
@endsection

@section('Options')
    <div class="btn-group" id="ButtonOfArchive">
        <a href="#"><button type="button" class="btn btn-outline btn-sm mr-1" id="sidebar_archiveCollapse">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-layout-sidebar" viewBox="0 0 16 16">
            <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H5zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2V2z"/>
        </svg><span id="featureName"></span></button>
        </a>

        <a href="{{route('home')}}"><button type="button" class="btn btn-outline btn-sm mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-house-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
        </svg></button>
        </a>
    </div>
@endsection

@section('Folder Details')
<div class="row justify-content-center">
    <div class="col-md-9 my-3">
    <span  id="ButtonOfArchive">  
        <a href="{{route('TodayFiles.Show')}}"><button type="button" class="btn btn-outline btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg> <span id="featureName">Today Files</span></button>
        </a>

        <a href="{{route('LastWeekFiles.Show')}}"><button type="button" class="btn btn-outline btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg> <span id="featureName">Last Week Files</span></button>
        </a>
        <a id="show_More" data-toggle="collapse" href="#collapse_Archive" role="button" aria-expanded="false" aria-controls="collapseExample">
            Show More....
        </a>
    </span>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="collapse" id="collapse_Archive">
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <h6 class="text"><b>Search files for a given date</b></h6>
                <form name="frm" action ="{{ route('GivenDateFiles.Show') }}" method="POST" enctype="multipart/form-data" id="GivenoDatesFiles">
                    {{csrf_field()}}
                    <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Date <abbr class="req" title="required">*</abbr></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="Date" id="example-date-input" required>
                        </div>
                    </div>

                        <button type="submit" name="submit" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        </button>

                </form>
            </div>
            
            <div class="shadow-lg p-3 mb-5 bg-white rounded">
                <h6 class="text"><b>Search for files by given date range</b></h6>
                <form name="frm" action ="{{ route('GivenTwoDatesFiles.Show') }}" method="POST" enctype="multipart/form-data" id="GivenTwoDatesFiles">
                    {{csrf_field()}}
                    <div class="d-flex justify-content-end"><small>( <abbr class="req" title="required">*</abbr> :- required input fields )</small></div>
                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">Start Date <abbr class="req" title="required">*</abbr></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="StartDate" id="example-date-input" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="example-date-input" class="col-2 col-form-label">End Date <abbr class="req" title="required">*</abbr></label>
                        <div class="col-10">
                            <input class="form-control" type="date" name="EndDate" id="example-date-input" required>
                        </div>
                    </div>

                        <button type="submit" name="submit" class="btn btn-sm btn-outline-success my-2 my-sm-0 mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                        </button>

                </form>

            </div>
        </div>
    </div>
</div>      
@endsection



@section('Body')   
@if(!(isset($file_Table)))
<div class="row justify-content-center" id="summary_contain">
    <div class="col-md-9">
        <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <div style="height: 580px;overflow: scroll;">
                <ul id="EventsList" role="menu">
                @isset($archive_List)
                    @foreach($archive_List as $archiveList)
                        <li>
                            <a href="{{route('ArchiveSummaryFile.Show',['year'=>$archiveList['year'],'month'=>$archiveList['month']])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
                            <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1V2zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5H2zm13-3H1v2h14V2zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            {{$archiveList['year']}} -> {{$archiveList['month']}} 
                            </a>
                        </li>
                    @endforeach
                @endisset
                </ul>
            </div>
        </div>
    </div>
</div>

@endif
@endsection


@section('DMAA script content')
<script>
        $(document).ready(function () {
            $('#collapse_Archive').on('shown.bs.collapse', function () {
                $( "#show_More" ).html('Show Less....');
                $( "#summary_contain" ).hide();
            });

            $('#collapse_Archive').on('hidden.bs.collapse', function () {
                $( "#show_More" ).html('Show More....');
                $( "#summary_contain" ).show();
            });
        });
</script>
@endsection