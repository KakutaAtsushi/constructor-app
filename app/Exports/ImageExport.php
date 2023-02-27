<?php

namespace App\Exports;

use App\Models\Constructor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImageExport implements FromCollection,WithHeadings
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
            '影響発生場所',
            "座標",
            '部署',
            '氏名',
            '工事担当者',
            '路線',
            '最寄りバス停',
            "営業所",
            "障害内容",
            "お知らせ",
            "工事開始日",
            "実質作業期間",
            "工事終了日",
            "工事開始時間",
            "工事終了時間",
            "リマインド期間",
            "備考",
            "グーグルマップURL"
        ];
    }
    public function collection()
    {
        return Constructor::where("id", $this->construct_id)->select("location","coordinate", "department", "username",
            "business_name","route", "bus_station", "office", "detail", "news",
            "started_at", "real_work_time","ended_at", "inworking_start_time", "inworking_end_time", "notify_time", "remarks", "google_map_url"
        )->get();
    }
}
