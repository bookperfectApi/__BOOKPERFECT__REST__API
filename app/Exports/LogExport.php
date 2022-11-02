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
        $recordDate = log::whereBetween('logTable.created_at', [$startDate.' '.$startTime, $endDate.' '.$endTime])->get();
        return $recordDate;
    }
    public function headings(): array
    {
        return [
            'id',
            'requestName',
            'IP',
            'date',
            'status',
            'responseText',
            'created_at',
            'updated_at',
        ];
    }
}
