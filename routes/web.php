<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OsController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ManufacturersController;
use App\Http\Controllers\RepresentationController;
use App\Http\Controllers\ExplodedMachineController;
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
Route::get('/produtos/adicionar', [ProductController::class, 'newProduct'])->middleware(['auth', 'verified'])->name('products');
Route::get('/produtos/editar/{id}', [ProductController::class, 'editProducts'])->middleware(['auth', 'verified'])->name('products');
Route::get('/produtos/visualizar/{id}', [ProductController::class, 'viewProducts'])->middleware(['auth', 'verified'])->name('products');

Route::get('/servicos', [ServiceController::class, 'getInfoServices'])->middleware(['auth', 'verified'])->name('services');

Route::get('/os', [OsController::class, 'getInfoOs'])->middleware(['auth', 'verified'])->name('os');

Route::get('/maquinas', [MachineController::class, 'getInfoMachines'])->middleware(['auth', 'verified'])->name('machines');

Route::get('/fabricantes', [ManufacturersController::class, 'getInfoManufacturers'])->middleware(['auth', 'verified'])->name('manufacturers');

Route::get('/representacoes', [RepresentationController::class, 'getInfoRepresentation'])->middleware(['auth', 'verified'])->name('representation');

Route::get('/cidades', [CityController::class, 'getInfoCity'])->middleware(['auth', 'verified'])->name('city');

Route::get('/maquinas-explodidas', [ExplodedMachineController::class, 'getInfoExplodedMachine'])->middleware(['auth', 'verified'])->name('exploded-machine');

Route::post('/clientes/adicionar', [ClientController::class, 'registerClientSupplier'])->middleware(['auth', 'verified'])->name('clients');

Route::post('/produtos/adicionar', [ProductController::class, 'registerProducts'])->middleware(['auth', 'verified'])->name('products');

Route::post('/nova-maquina', [MachineController::class, 'createMachine'])->middleware(['auth', 'verified'])->name('machines');

Route::put('/clientes/atualizar/{id}', [ClientController::class, 'updateClientSupplier'])->middleware(['auth', 'verified'])->name('clients');

Route::put('/produtos/atualizar/{id}', [ProductController::class, 'updateProduct'])->middleware(['auth', 'verified'])->name('products');

Route::put('produtos/atualizar/estoque/{id}', [ProductController::class, 'updateProductStock'])->middleware(['auth', 'verified'])->name('products');

Route::delete('produtos/delete/{id}', [ProductController::class, 'deleteProduct'])->middleware(['auth', 'verified'])->name('products');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
