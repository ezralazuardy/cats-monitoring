<?php

use App\Http\Controllers\AckController;
use App\Http\Controllers\DetectionController;
use App\Models\Ack;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $latestAck = Ack::orderBy('created_at', 'desc')->first();
    return view('pages.main', compact('latestAck'));
});

Route::get('ack/latest', [AckController::class, 'getLatestAck'])->name('ack.latest');

Route::post('detection/reset', [DetectionController::class, 'resetDetection'])->name('detection.reset');
Route::get('detection/datatable', [DetectionController::class, 'getDetectionsDataTableFormatted'])->name('detection.datatable');
