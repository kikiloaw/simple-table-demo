<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SimpleTableDocsController extends Controller
{
    // 1. Basic Example
    public function basic()
    {
        return Inertia::render('docs/simple-table/Basic', [
            'users' => $this->getFakeData(10)
        ]);
    }

    // 2. Fixed Columns & Scrolling
    public function fixedColumns()
    {
        return Inertia::render('docs/simple-table/FixedColumns', [
            'users' => $this->getFakeData(50) // More data to scroll
        ]);
    }

    // 3. Custom Slots & Actions
    public function customSlots()
    {
        return Inertia::render('docs/simple-table/CustomSlots', [
            'users' => $this->getFakeData(10)
        ]);
    }

    // 4. Server-Side Data
    public function serverSide()
    {
        return Inertia::render('docs/simple-table/ServerSide');
    }

    // 5. Theming & Colors
    public function theming()
    {
        return Inertia::render('docs/simple-table/Theming', [
            'users' => $this->getFakeData(5)
        ]);
    }

    // 6. Group Headers
    public function groupHeaders()
    {
        $data = [
            ['_isGroupHeader' => true, '_groupTitle' => 'Engineering Department'],
            ['id' => 1, 'name' => 'Alice Engineer', 'role' => 'Senior Dev', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Bob Builder', 'role' => 'Junior Dev', 'status' => 'Active'],

            ['_isGroupHeader' => true, '_groupTitle' => 'HR Department'],
            ['id' => 3, 'name' => 'Charlie Human', 'role' => 'Manager', 'status' => 'Active'],
            ['id' => 4, 'name' => 'Diana Resource', 'role' => 'Recruiter', 'status' => 'Inactive'],

            ['_isGroupHeader' => true, '_groupTitle' => 'Marketing Department'],
            ['id' => 5, 'name' => 'Eve Promote', 'role' => 'Director', 'status' => 'Active'],
        ];

        return Inertia::render('docs/simple-table/GroupHeaders', [
            'users' => $data
        ]);
    }

    // 7. Server-Side Caching
    public function serverSideCaching()
    {
        return Inertia::render('docs/simple-table/ServerSideCaching');
    }

    // 8. Server-Side Group Headers
    public function groupHeadersServer()
    {
        return Inertia::render('docs/simple-table/GroupHeadersServer');
    }

    public function groupHeadersClientTransform()
    {
        return Inertia::render('docs/simple-table/GroupHeadersClientTransform');
    }

    // API: Grouped Data
    public function getGroupedData(Request $request)
    {
        // 1. Get Data
        $totalRecords = 500;
        $data = $this->getFakeData($totalRecords);
        $query = collect($data);

        // 2. Search
        if ($search = $request->input('search')) {
            $query = $query->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), strtolower($search)) ||
                    str_contains(strtolower($item['role']), strtolower($search));
            });
        }

        // 3. Sort - CRITICAL: Sort by Group (Department) first, then by User Request
        $requestedSort = $request->input('sort', 'id');
        $requestedOrder = $request->input('order', 'asc');

        $query = $query->sort(function ($a, $b) use ($requestedSort, $requestedOrder) {
            // Primary Sort: Group Key (Department)
            $groupCmp = strcmp($a['department'], $b['department']);
            if ($groupCmp !== 0) {
                return $groupCmp;
            }

            // Secondary Sort: User Request
            $valA = $a[$requestedSort];
            $valB = $b[$requestedSort];

            if ($valA == $valB)
                return 0;

            // Handle direction
            if ($requestedOrder === 'asc') {
                return $valA < $valB ? -1 : 1;
            } else {
                return $valA > $valB ? -1 : 1;
            }
        });

        // 4. Pagination
        $perPage = (int) $request->input('per_page', 10);
        $page = (int) $request->input('page', 1);

        $totalFiltered = $query->count();
        $chunk = $query->forPage($page, $perPage)->values();

        // 5. Inject Headers
        $resultWithHeaders = [];
        $lastGroup = null;

        foreach ($chunk as $item) {
            $currentGroup = $item['department'];

            // If group changes, insert header
            if ($currentGroup !== $lastGroup) {
                $resultWithHeaders[] = [
                    '_isGroupHeader' => true,
                    '_groupTitle' => $currentGroup, // e.g. "Engineering"
                    '_groupTitleClass' => 'text-blue-600 bg-blue-50'
                ];
                $lastGroup = $currentGroup;
            }

            $resultWithHeaders[] = $item;
        }

        return response()->json([
            'data' => $resultWithHeaders, // Array with mixed rows and headers
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $totalFiltered,
            'last_page' => ceil($totalFiltered / $perPage),
            'from' => ($page - 1) * $perPage + 1,
            'to' => min($page * $perPage, $totalFiltered),
        ]);
    }

    // API for Server-Side Demo
    public function getData(Request $request)
    {
        $totalRecords = 2500; // More data!
        $query = collect($this->getFakeData($totalRecords));

        // Search
        if ($search = $request->input('search')) {
            $query = $query->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['name']), strtolower($search)) ||
                    str_contains(strtolower($item['email']), strtolower($search));
            });
        }

        // Sort
        if ($sort = $request->input('sort')) {
            $order = $request->input('order', 'asc');
            $query = $order === 'asc' ? $query->sortBy($sort) : $query->sortByDesc($sort);
        }

        // Pagination
        $perPage = (int) $request->input('per_page', 10);
        $page = (int) $request->input('page', 1);

        $totalFiltered = $query->count();
        $items = $query->forPage($page, $perPage)->values();

        // Return standard Laravel Paginator structure
        return response()->json([
            'data' => $items,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $totalFiltered,
            'last_page' => ceil($totalFiltered / $perPage),
            'from' => ($page - 1) * $perPage + 1,
            'to' => min($page * $perPage, $totalFiltered),
        ]);
    }

    private function getFakeData($count)
    {
        $data = [];
        $roles = ['Admin', 'Editor', 'User', 'Viewer', 'Manager'];
        $statuses = ['Active', 'Inactive', 'Pending', 'Banned'];
        $departments = ['Engineering', 'Human Resources', 'Sales', 'Marketing', 'Finance', 'Operations'];

        for ($i = 1; $i <= $count; $i++) {
            $data[] = [
                'id' => $i,
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'role' => $roles[$i % 5],
                'status' => $statuses[$i % 4],
                'department' => $departments[$i % 6], // Assign department
                'created_at' => now()->subDays($i)->format('Y-m-d'),
            ];
        }
        return $data;
    }
}
