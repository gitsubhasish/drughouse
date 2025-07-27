<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Tablet'],
            ['name' => 'Syrup'],
            ['name' => 'Capsule'],
            ['name' => 'Injection'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }
    }
}
