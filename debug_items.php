<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ClearanceItem;

$items = ClearanceItem::leftJoin('clearance_groups', 'clearance_items.clearance_group_id', '=', 'clearance_groups.id')
    ->select('clearance_items.*', 'clearance_groups.name as group_name')
    ->get();

$grouped = $items->groupBy('group_name');

echo "Total Items: " . $items->count() . "\n";
echo "Total Groups: " . $grouped->count() . "\n";
foreach ($grouped as $key => $val) {
    echo "Group: $key, Count: " . $val->count() . "\n";
}
