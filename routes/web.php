<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;

Route::get('/', fn() => redirect()->route('facilities.index'));
Route::get('/facilities/export', [FacilityController::class, 'export'])->name('facilities.export');
Route::resource('facilities', FacilityController::class);
