<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
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

Route::get('/dashboard', [DashboardController::class, 'getInfoDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/clientes', [ClientController::class, 'getInfoClients'])->middleware(['auth', 'verified'])->name('clients');
Route::get('/clientes/adicionar', [ClientController::class, 'newClientSupplier'])->middleware(['auth', 'verified'])->name('clients');
Route::get('/clientes/visualizar/{id}', [ClientController::class, 'viewClientSupplier'])->middleware(['auth', 'verified'])->name('clients');
Route::get('/clientes/editar/{id}', [ClientController::class, 'editClientSupplier'])->middleware(['auth', 'verified'])->name('clients');

Route::get('/produtos', [ProductController::class, 'getInfoProducts'])->middleware(['auth', 'verified'])->name('products');
Route::get('/produtos/editar/{id}', [ProductController::class, 'editProducts'])->middleware(['auth', 'verified'])->name('products');
Route::get('/produtos/visualizar/{id}', [ProductController::class, 'viewProducts'])->middleware(['auth', 'verified'])->name('products');

Route::post('/clientes/adicionar', [ClientController::class, 'registerClientSupplier'])->middleware(['auth', 'verified'])->name('clients');


Route::put('/clientes/atualizar/{id}', [ClientController::class, 'updateClientSupplier'])->middleware(['auth', 'verified'])->name('clients');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
