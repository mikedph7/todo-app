<?php

use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'/todos'], function (){
   Route::get('/', [TodosController::class, 'index'])->name('index');
   Route::post('/store', [TodosController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TodosController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TodosController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TodosController::class, 'destroy'])->name('delete');
});
