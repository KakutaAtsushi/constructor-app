<?php

namespace App\Exports;

use App\Models\Constructor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConstructsExport implements FromCollection
{
    protected $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function collection(): Collection
    {
        if(empty($this->page)){
            return Constructor::orderBy('id', 'DESC')->offset(0)->limit(20)->get();
        }
        return Constructor::orderBy('id', 'DESC')->offset($this->page * 20 - 20)->limit($this->page * 20)->get();
    }
}
