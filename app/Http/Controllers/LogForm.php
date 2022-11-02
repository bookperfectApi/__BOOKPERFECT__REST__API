<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\checkuser as checkuser;
use App\Models\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\LinesOfCode\Counter;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Response;

class LogForm extends Controller
{
  public function LoginForm($id = null)
  {
    // log::truncate();
    // dd('PROGRESS STOPPED');
    // DB::statement(`SET  @num := 0;

    // UPDATE logTable SET id = @num := (@num+1);

    // ALTER TABLE logTable AUTO_INCREMENT =1;`);

    return view('LoginForm', compact('id'));
  }
  public function checkLog(Request $request)
  {
    // dd($request->userid.'     '.$request->userpass);
    $check = checkuser::where('username', '=', $request->userid)->where('userpass', '=', $request->userpass)->get();
    if (strlen($check) != 2) {
      return redirect()->route('logList');
    } else {
      return back();
    }
  }
  public function LogList()
  {
    $currentTime = Carbon::now();
    $newDate = $currentTime->format('m-d-Y');
    $prevmonth = $currentTime->subMonth()->format('m-d-Y');
    $id = null;
    $days_box = array();
    $counter = 0;
    $records = log::orderBy('id', 'DESC')->paginate(20);
    $days = log::all();
    foreach ($days as $day) {
      $date = $day->created_at;
      $days_box[$counter] = $date->setTimezone('Turkey')->format('m-d-Y');
      $counter = $counter + 1;
    }
    $collectiveId = log::all();
    $total_id = 0;
    foreach ($collectiveId as $item) {
      $id = $item->id + 1;
      $total_id = $total_id + 1;
    }


    $filter_days_box = array_unique($days_box);
    $dateList = log::orderBy('id', 'DESC')->get();
    return view('logList', compact(
      'records',
      'id',
      'filter_days_box',
      'dateList',
      'newDate',
      'prevmonth',
      'total_id',
    ));
  }



  public function filterbyday(Request $__REQUEST)
  {

    // log::truncate();

    if ($__REQUEST->day == 'First Page') {
      return redirect()->route('logList');
    }
    $__FORMAT__DATE = Carbon::parse($__REQUEST->day)->format('Y-d-m');
    $__DATA__FILTER = log::where('created_at', 'LIKE', '%' . $__FORMAT__DATE . '%')->paginate(20);
    $__RECORDS = log::all();
    $__COUNTER = 0;
    $__ID__COUNTER = 0;
    $__DAYS__CATE = array();
    $__CURRENT__DATE = substr($__FORMAT__DATE, 0, 10);
    foreach ($__RECORDS as $__ITEM) {
      $__ID__COUNTER = $__ID__COUNTER + 1;
      if (!array_search(substr($__ITEM->date, 0, 10), $__DAYS__CATE)) {
        $__DAYS__CATE[$__COUNTER] = substr($__ITEM->date, 0, 10);
        $__COUNTER = $__COUNTER + 1;
      }
    }

    return view('filterday', compact('__DATA__FILTER', '__DAYS__CATE', '__ID__COUNTER', '__CURRENT__DATE'));
  }



  public function downloadResponse($id)
  {
    $row = log::find($id);
    $content = ['TYPE OF REQUEST :' . $row->requestName . '<br><br>' . 'RESPONSE :' . $row->response];
    $fileName = '__response__' . $row->id . '.txt';
    $headers = [
      'Content-type' => 'text/plain',
      'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
      'Content-Length' => sizeof($content)
    ];
    return Response::make($content, 200, $headers);
  }
}
