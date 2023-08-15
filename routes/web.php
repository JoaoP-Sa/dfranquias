<?php

use App\Http\Controllers\BovineCRUDController;
use App\Http\Controllers\BovineTableController;
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

Route::get('/', [BovineTableController::class, 'index'])->name('home');
Route::get('/todos', [BovineTableController::class, 'showAll'])->name('all-bovines');
Route::get('/abate', [BovineTableController::class, 'showShootDown'])->name('shoot-down-bovines');

Route::get('/adicionar-bovino', [BovineCRUDController::class, 'getForm'])->name('register');
Route::post('/adicionar-bovino', [BovineCRUDController::class, 'sendInfo'])->name('register');

Route::get('/{id}/editar-bovino', [BovineCRUDController::class, 'getForm'])->name('edit');
Route::put('/{id}/editar-bovino', [BovineCRUDController::class, 'sendInfo'])->name('edit');

Route::get('/{id}/excluir-bovino/{route_name}', [BovineCRUDController::class, 'deleteBovine'])->name('delete');
Route::post('/{id}/abater-bovino', [BovineCRUDController::class, 'shootDownBovine'])->name('shoot-down');
