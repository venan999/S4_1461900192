<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
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
    return view('index');
});

Route::get('/show/pdf', [DataController::class, 'generate']);
Route::get('/tambah', [DataController::class, 'create']);
Route::post('/store', [DataController::class, 'store']);
Route::resource('/show', DataController::class);

Route::get('/edit/{id}', 'DataController@edit');
Route::post('/update', 'DataiController@update');
Route::get('/show', [DataController::class, 'index']);
Route::post('/pasien/import_excel', [DataController::class, 'import']);
