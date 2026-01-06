<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClearanceGroup;

class ClearanceGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\ClearanceItem::truncate();
        ClearanceGroup::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $groups = [
            'Library',
            'Laboratory',
            'Sports Office',
            'Registrar',
            'Finance Office',
            'Clinic',
            'Student Affairs',
        ];

        foreach ($groups as $name) {
            ClearanceGroup::firstOrCreate(['name' => $name]);
        }
    }
}
