<?php

namespace App\Exports;

use App\Models\log;
use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class LogExport implements FromCollection,WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public $start = null;
    public $end = null;
    public $startTime = null;
    public $endTime = null;
    public  function __construct($start, $end, $startTime, $endTime)
    {
        $this->start = $start;
        $this->end = $end;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
    public function collection()
    {

        // log::truncate();
        // DB::statement('ALTER TABLE logTable AUTO_INCREMENT = 1');
        // dd('progress stopped');
        $startDate = $this->start;
        $endDate = $this->end;
        $startTime = $this->startTime;
        $endTime = $this->endTime;
        if (intval($startTime) >= 3) {
            $startTime_H = intval(substr($startTime, 0, 2)) - 3;
        } else {
            $startTime_H = intval(substr($startTime, 0, 2));
        }
        if (intval($endTime) >= 3) {
            $endTime_H = intval(substr($endDate, 0, 2)) - 3;
        } else {
            $endTime_H = intval(substr($endDate, 0, 2));
        }
        $startTime_m = intval(substr($startTime, 3, 2));
        $startTime_s = intval(substr($startTime, 6, 2));


        $endTime_m = intval(substr($endDate, 3, 2));
        $endTime_s = intval(substr($endDate, 6, 2));

        $startTime = $startTime_H . ':' . $startTime_m . ':' . $startTime_s;
        $endTime = $endTime_H . ':' . $endTime_m . ':' . $endTime_s;

        $startDate = Carbon::parse($startDate . ' ' . $startTime);
        $endDate = Carbon::parse($endDate . ' ' . $endTime);

        $recordDate = log::whereBetween('logTable.created_at', [$startDate, $endDate])->get();
        return $recordDate;
    }
    public function headings(): array
    {
        return [
            'id',
            'requestName',
            'ip',
            'status',
            'response',
            'date',
            ' ',
            'created_at',
            'updated_at',
        ];
    }
}
