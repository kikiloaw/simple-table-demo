<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClearanceGroup;
use App\Models\ClearanceItem;

class ClearanceSeeder extends Seeder
{
    public function run(): void
    {
        ClearanceItem::truncate();
        ClearanceGroup::truncate();

        $groups = [
            'PPE' => ['Safety Boots', 'Hard Hat', 'Reflective Vest', 'Gloves'],
            'Electronics' => ['Laptop', 'Mouse', 'Keyboard', 'Monitor'],
            'Office Supplies' => ['Desk Chair', 'Desk Lamp', 'Stapler', 'Notebook'],
            'Tools' => ['Hammer', 'Screwdriver Set', 'Tape Measure'],
        ];

        foreach ($groups as $groupName => $items) {
            $group = ClearanceGroup::create(['name' => $groupName]);

            foreach ($items as $itemName) {
                ClearanceItem::create([
                    'name' => $itemName,
                    'clearance_group_id' => $group->id,
                ]);
            }
        }
    }
}
