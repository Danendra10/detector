<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'name' => 'unit-1',
        ]);
        Unit::create([
            'name' => 'unit-2',
        ]);
        Unit::create([
            'name' => 'unit-3',
        ]);
        Unit::create([
            'name' => 'unit-4',
        ]);
        Unit::create([
            'name' => 'unit-5',
        ]);
    }
}
