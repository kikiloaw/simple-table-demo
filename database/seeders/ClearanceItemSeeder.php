<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClearanceGroup;
use App\Models\ClearanceItem;

class ClearanceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupItems = [
            'Library' => ['Unreturned Book: Calculus I', 'Overdue Fine: History 101', 'Damaged Book Charge'],
            'Laboratory' => ['Broken Beaker', 'Unreturned Microscope Slide', 'Lab Coat Fee'],
            'Sports Office' => ['Unreturned Basketball', 'Jersey Damage Fee', 'Locker Key'],
            'Registrar' => ['Missing Form 137', 'Transcript Request Fee', 'Diploma Fee'],
            'Finance Office' => ['Unpaid Tuition Balance', 'Miscellaneous Fee', 'Graduation Fee'],
            'Clinic' => ['Medical Certificate Fee', 'Unreturned Crutches'],
            'Student Affairs' => ['Lost ID Fee', 'Handbook Fee', 'Violation Penalty'],
        ];

        foreach ($groupItems as $groupName => $items) {
            $group = ClearanceGroup::where('name', $groupName)->first();

            if ($group) {
                foreach ($items as $itemName) {
                    ClearanceItem::firstOrCreate([
                        'name' => $itemName,
                        'clearance_group_id' => $group->id,
                    ]);
                }
            }
        }
    }
}
