<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Meteran extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'meterans';

    protected $fillable = [
        'type',
        'units_id',
        'month',
        'year',
        'meteran_value',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'units_id', 'id');
    }
}
