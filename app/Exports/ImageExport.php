<?php

namespace App\Exports;

use App\Models\Constructor;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ImageExport implements FromCollection
{
    use Exportable;

    protected $construct_id;

    public function __construct($construct_id)
    {
        $this->construct_id = $construct_id;
    }

    public function collection()
    {
        return Constructor::where("id", $this->construct_id)->get();
    }
}
