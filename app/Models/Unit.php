<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    public function meterans()
    {
        return $this->hasMany(Meteran::class, 'id', 'units_id');
    }

    public function summaryData()
    {
        return $this->hasMany(SummaryData::class, 'id', 'units_id');
    }
}
