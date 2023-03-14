<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryData extends Model
{
    use HasFactory;

    protected $table = 'summary_data';

    protected $fillable = [
        'type',
        'units_id',
        'jan',
        'feb',
        'mar',
        'apr',
        'may',
        'jun',
        'jul',
        'aug',
        'sep',
        'oct',
        'nov',
        'dec',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'units_id', 'id');
    }
}
