<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CamConfig extends Model
{
    use HasFactory;

    protected $table = 'cam_config';

    protected $fillable = [
        'type',
        'hueMin',
        'hueMax',
        'satMin',
        'satMax',
        'valMin',
        'valMax',
    ];
}
