<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LogExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\DateTime;
use App\Models\log;

class ExcelCSVController extends Controller
{
    public function export(Request $request)
    {

        $start = $request->input('param1');
        $end = $request->input('param2');
        $startTime = $request->input('time1');
        $endTime = $request->input('time2');

        return Excel::download(new LogExport($start, $end, $startTime, $endTime), 'Log-collection.xlsx');
    }
}
