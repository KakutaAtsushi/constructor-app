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
    protected $fillable = ["id","location","hashtag", "detail", "office", "started_at", "ended_at"];
}
