<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\Docs\SimpleTableDocsController;

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
