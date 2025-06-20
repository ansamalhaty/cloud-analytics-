<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [DocumentController::class, 'index']);
Route::post('/check-file', [DocumentController::class, 'checkFile'])->name('check.file');
Route::post('/upload', [DocumentController::class, 'upload'])->name('upload');
Route::get('/filter-files', [DocumentController::class, 'filterFiles'])->name('filter.files');