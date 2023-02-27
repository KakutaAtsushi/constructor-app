<?php

namespace App\Exports;

use App\Models\Constructor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConstructsExport implements FromCollection,WithHeadings
{
    protected $page;

    public function __construct($page)
    {
        $this->page = $page;
    }
    public function headings():array
    {
        return [
            '工事場所',
            '営業所',
            '工事内容',
            '工事開始日',
            '工事終了日',
            '備考',
        ];
    }
    public function collection(): Collection
    {
        if(empty($this->page)){
            return Constructor::select("location", "office", "detail", "started_at", "ended_at", "remarks")->orderBy('id', 'DESC')->offset(0)->limit(20)->get();
        }
        return Constructor::select("location", "office", "detail", "started_at", "ended_at", "remarks")->orderBy('id', 'DESC')->offset($this->page * 20 - 20)->limit($this->page * 20)->get();
    }
}
