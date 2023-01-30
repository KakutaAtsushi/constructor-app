<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static get()
 * @method static where(string $string, mixed $id)
 */
class Constructor extends Model
{
    use HasFactory;

    protected $table = 'constructs';
    protected $fillable = ["id","stopped_bus_flag","detour_flag","username","department","remind_flag", "location", "hashtag", "bus_station", "real_work_time", "business_name", "bus_relocation_flag", "remarks", "route", "relocation", "detail", "office", "started_at", "ended_at"];
}
