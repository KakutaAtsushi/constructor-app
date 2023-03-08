<?php

namespace App\Exports;

use App\Models\Constructor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllEditExport implements FromCollection,WithHeadings
{

    use Exportable;

    protected $construct_id;

    public function __construct($construct_id)
    {
        $this->construct_id = $construct_id;
    }
    public function headings():array
    {
        return [
            '最寄りバス停',
            "障害内容",
            "工事開始日",
            "実質作業期間",
            "工事終了日",
            "工事開始時間",
            "工事終了時間",
            "グーグルマップURL"
        ];
    }
    public function collection()
    {
        return Constructor::where("id", $this->construct_id)->select("bus_station","detail",
            "started_at", "real_work_time","ended_at", "inworking_start_time", "inworking_end_time", "google_map_url"
        )->get();
    }
}
