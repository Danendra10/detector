<?php

namespace Database\Seeders;

use App\Models\CamConfig;
use Illuminate\Database\Seeder;

class CamConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CamConfig::create([
            'type' => 'listrik',
            'hueMin' => '0',
            'hueMax' => '90',
            'satMin' => '0',
            'satMax' => '255',
            'valMin' => '0',
            'valMax' => '255',
        ]);
        CamConfig::create([
            'type' => 'air',
            'hueMin' => '0',
            'hueMax' => '90',
            'satMin' => '0',
            'satMax' => '255',
            'valMin' => '0',
            'valMax' => '255',
        ]);
    }
}
