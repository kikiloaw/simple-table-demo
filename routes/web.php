<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\Docs\SimpleTableDocsController;
use App\Http\Controllers\Docs\FahadSelectDocsController;

Route::prefix('docs/simple-table')->middleware(['auth'])->group(function () {
    Route::get('/basic', [SimpleTableDocsController::class, 'basic'])->name('docs.simple-table.basic');
    Route::get('/fixed-columns', [SimpleTableDocsController::class, 'fixedColumns'])->name('docs.simple-table.fixed');
    Route::get('/custom-slots', [SimpleTableDocsController::class, 'customSlots'])->name('docs.simple-table.slots');
    Route::get('/server-side', [SimpleTableDocsController::class, 'serverSide'])->name('docs.simple-table.server');
    Route::get('/theming', [SimpleTableDocsController::class, 'theming'])->name('docs.simple-table.theming');
    Route::get('/group-headers', [SimpleTableDocsController::class, 'groupHeaders'])->name('docs.simple-table.group');
    Route::get('/server-side-caching', [SimpleTableDocsController::class, 'serverSideCaching'])->name('docs.simple-table.caching');
    Route::get('/group-headers-server', [SimpleTableDocsController::class, 'groupHeadersServer'])->name('docs.simple-table.group-server');
    Route::get('/group-headers-client-transform', [SimpleTableDocsController::class, 'groupHeadersClientTransform'])->name('docs.simple-table.group-client-transform');
    Route::get('/data', [SimpleTableDocsController::class, 'getData'])->name('docs.simple-table.data');
    Route::get('/data-grouped', [SimpleTableDocsController::class, 'getGroupedData'])->name('docs.simple-table.data-grouped');

    // Dynamic Columns Demo
    Route::get('/dynamic', [SimpleTableDocsController::class, 'dynamicColumns'])->name('docs.simple-table.dynamic-columns');
    Route::get('/dynamic-columns-data', [SimpleTableDocsController::class, 'getDynamicColumnsData'])->name('docs.simple-table.dynamic-data');
});

Route::prefix('docs/fahad-select')->middleware(['auth'])->group(function () {
    Route::get('/', [FahadSelectDocsController::class, 'index'])->name('docs.fahad-select.index');
    Route::get('/users', [FahadSelectDocsController::class, 'getUsers'])->name('docs.fahad-select.users');
    Route::get('/clearance-items-grouped', [FahadSelectDocsController::class, 'getClearanceItems'])->name('docs.fahad-select.items');
    Route::get('/cars', [FahadSelectDocsController::class, 'getCars'])->name('docs.fahad-select.cars');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return redirect()->route('docs.simple-table.basic');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
