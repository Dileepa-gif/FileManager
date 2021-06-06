<?php

namespace App\Http\Controllers\FileManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Validation\Rule;
use App\FileManager\Folders;
use App\FileManager\FilesFolders;
use App\FileManager\Files;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function ArchiveSummary()
    {
        $archive_List = $this->ArchiveSummaryList();
        $params = [
            'archive_List' => $archive_List,
            ];
        return view('FileManager\Viewers\SummaryViewer')->with($params);
    }

    public function ArchiveSummaryFiles($year,$month){
        $request = [
            'year' => $year,
            'month' => $month,
            ];
        $validator = Validator::make($request, [
            'month' => [
                'required',
                Rule::in('January','February','March','April','May','June','July','August','September','October','November','December'),
            ],
            'year' => 'required|digits:4|integer|min:2020|max:'.(date('Y')+1),
        ]);
        if (!($validator->passes())) {
            return redirect()->back()->with(['errors'=>$validator->errors()->all()]);
        }
        $archive_List = $this->ArchiveSummaryList();
        $file_Table =Files::whereYear('created_at', $year)->whereMonth('created_at',date("m", strtotime($month)))->paginate(15);
        $params = [
            'archive_List' => $archive_List,
            'file_Table' => $file_Table,
            ];
            return view('FileManager\Viewers\SummaryFileViewer')->with($params);
    }

    public function TodayFiles()
    {
        $archive_List = $this->ArchiveSummaryList();
        $file_Table =Files::whereDate('created_at', Carbon::today())->paginate(15);
        $params = [
            'archive_List' => $archive_List,
            'file_Table' => $file_Table,
            ];
            return view('FileManager\Viewers\SummaryFileViewer')->with($params);
    }


    public function LastWeekFiles()
    {
        $archive_List = $this->ArchiveSummaryList();
        $date = \Carbon\Carbon::today()->subDays(7);
        $file_Table =Files::whereDate('created_at','>=',$date)->paginate(15);
        $params = [
            'archive_List' => $archive_List,
            'file_Table' => $file_Table,
            ];
            return view('FileManager\Viewers\SummaryFileViewer')->with($params);
    }

    public function GivenDateFiles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Date'=>'required|date|date_format:Y-m-d|before_or_equal:today',
        ]);
        if (!($validator->passes())) {
            return redirect()->route('AchiveFileSummary.Show')->with(['errors'=>$validator->errors()->all()]);
        }

        $archive_List = $this->ArchiveSummaryList();
        $date=$request->input('Date');
        $p_file_Table =Files::whereDate('created_at', date($date))->get();
        $params = [
            'archive_List' => $archive_List,
            'p_file_Table' => $p_file_Table,
            ];
            return view('FileManager\Viewers\SummaryFileViewer')->with($params);
    }



    public function GivenTwoDatesFiles(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'StartDate'=>'required|date|date_format:Y-m-d|before_or_equal:today',
            'EndDate'=>'required|date|date_format:Y-m-d|after_or_equal:StartDate|before_or_equal:today',
        ]);
        if (!($validator->passes())) {
			return redirect()->route('AchiveFileSummary.Show')->with(['errors'=>$validator->errors()->all()]);
        }

        $archive_List = $this->ArchiveSummaryList();
        $start_date=$request->input('StartDate');
        $end_date=$request->input('EndDate');
        $p_file_Table =Files::whereDate('created_at', '>=',date($start_date))->whereDate('created_at', '<=',date($end_date))->get();
        $params = [
            'archive_List' => $archive_List,
            'p_file_Table' => $p_file_Table,
            ];
            return view('FileManager\Viewers\SummaryFileViewer')->with($params);
    }

   
    protected function ArchiveSummaryList()
    {
        $archive_List=Files::selectRaw('year(created_at) year, monthname(created_at) month')
                            ->groupBy('year','month')
                            ->orderByRaw('min(created_at) desc')
                            ->get()
                            ->toArray();
        return $archive_List;
    }
}