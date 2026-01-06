<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ClearanceGroup;
use App\Models\ClearanceItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FahadSelectDocsController extends Controller
{
    public function index()
    {
        return Inertia::render('docs/fahad-select/Index');
    }

    public function getUsers(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('query_')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->limit(20)->get()->map(function ($user, $index) {
            $roles = ['Admin', 'Editor', 'User', 'Guest'];
            return [
                'id' => $user->id,
                'name' => $user->name,
                'department' => $roles[$index % 4] . ' Department', // simulate department
            ];
        });

        return response()->json(['results' => $users]);
    }

    public function getClearanceItems(Request $request)
    {
        // "Left Joining the Group" approach as requested
        $query = ClearanceItem::query()
            ->leftJoin('clearance_groups', 'clearance_items.clearance_group_id', '=', 'clearance_groups.id')
            ->select('clearance_items.*', 'clearance_groups.name as group_name');

        if ($search = $request->input('query_')) {
            $query->where('clearance_items.name', 'like', "%{$search}%");
        }

        $items = $query->get();

        // Transform into the structure: [{ group: 'Name', data: [...] }]
        $results = $items->groupBy('group_name')->map(function ($groupItems, $groupName) {
            return [
                'group' => $groupName ?? 'Uncategorized',
                'data' => $groupItems->map(function ($item) use ($groupName) {
                    return [
                        'id' => $item->id,
                        'label' => $item->name,
                        'group' => $groupName,
                    ];
                })->values()->all()
            ];
        })->values()->all();

        return ['results' => $results];
    }

    public function getCars(Request $request)
    {
        // Mock data with pre-defined structure
        $sedans = [
            ['id' => rand(1000, 9999), 'label' => 'Toyota Camry', 'model' => 'Camry', 'make' => 'Toyota', 'year' => 2023, 'color' => 'Silver'],
            ['id' => rand(1000, 9999), 'label' => 'Honda Civic', 'model' => 'Civic', 'make' => 'Honda', 'year' => 2024, 'color' => 'Blue'],
            ['id' => rand(1000, 9999), 'label' => 'Nissan Sentra', 'model' => 'Sentra', 'make' => 'Nissan', 'year' => 2023, 'color' => 'White'],
        ];

        $suvs = [
            ['id' => rand(1000, 9999), 'label' => 'Ford Explorer', 'model' => 'Explorer', 'make' => 'Ford', 'year' => 2022, 'color' => 'Black'],
            ['id' => rand(1000, 9999), 'label' => 'Toyota RAV4', 'model' => 'RAV4', 'make' => 'Toyota', 'year' => 2023, 'color' => 'Red'],
            ['id' => rand(1000, 9999), 'label' => 'Honda CR-V', 'model' => 'CR-V', 'make' => 'Honda', 'year' => 2024, 'color' => 'Gray'],
        ];

        // Simple search filtering
        if ($search = $request->input('query_')) {
            $filter = function ($item) use ($search) {
                return stripos($item['label'], $search) !== false;
            };
            $sedans = array_filter($sedans, $filter);
            $suvs = array_filter($suvs, $filter);
        }

        $results = [];
        if (!empty($sedans)) {
            $results[] = ['group' => 'Sedans', 'data' => array_values($sedans)];
        }
        if (!empty($suvs)) {
            $results[] = ['group' => 'SUVs', 'data' => array_values($suvs)];
        }

        return response()->json(['results' => $results]);
    }
}
