<?php

use App\Http\Controllers\BovineFormController;
use App\Http\Controllers\BovineTableController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/todos', [BovineTableController::class, 'showAll'])->name('all-bovines');
Route::get('/abate', [BovineTableController::class, 'showShootDown'])->name('shoot-down-bovines');
Route::get('/adicionar-bovino', [BovineFormController::class, 'register'])->name('register');
Route::get('/{animal}/editar-bovino', [BovineFormController::class, 'edit'])->name('edit');


