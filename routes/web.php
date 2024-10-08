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
use App\Http\Controllers\GuaranteesController;
use App\Http\Controllers\UsersController;
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
Route::get('/minhaConta', [DashboardController::class, 'myAccount'])->middleware(['auth', 'verified'])->name('myAccount');
Route::get('/relatorios/os', [DashboardController::class, 'osReport'])->middleware(['auth', 'verified'])->name('osReport');

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
Route::get('/os/adicionar', [OsController::class, 'createOs'])->middleware(['auth', 'verified'])->name('os');
Route::get('/os/editar/{id}', [OsController::class, 'editOs'])->middleware(['auth', 'verified'])->name('os');
Route::get('os/visualizar/{id}', [OsController::class, 'viewOs'])->middleware(['auth', 'verified'])->name('os');
Route::get('/historico/{id}', [OSController::class, 'historyMachines'])->middleware(['auth', 'verified'])->name('os');

Route::get('/maquinas', [MachineController::class, 'getInfoMachines'])->middleware(['auth', 'verified'])->name('machines');
Route::get('/maquinas-adicionar', [MachineController::class, 'createMachines'])->middleware(['auth', 'verified'])->name('machines');

Route::get('/fabricantes', [ManufacturersController::class, 'getInfoManufacturers'])->middleware(['auth', 'verified'])->name('manufacturers');

Route::get('/representacoes', [RepresentationController::class, 'getInfoRepresentation'])->middleware(['auth', 'verified'])->name('representation');

Route::get('/cidades', [CityController::class, 'getInfoCity'])->middleware(['auth', 'verified'])->name('city');

Route::get('/maquinas-explodidas', [ExplodedMachineController::class, 'getInfoExplodedMachine'])->middleware(['auth', 'verified'])->name('exploded-machine');

Route::get('explodida/abrir-pdf/{id}', [ExplodedMachineController::class, 'openExplodedMachine'])->middleware(['auth', 'verified'])->name('explodedMachine');

Route::get('/os/imprimirEntrega/{id}', [OsController::class, 'entregaPDF']);

Route::get('/os/imprimirOs/{id}', [OsController::class, 'osPDF']);

Route::get('/os/entregaOs/{id}', [OsController::class, 'deliveryOs']);

Route::get('/garantias', [GuaranteesController::class, 'guarantees']);

Route::get('usuarios', [UsersController::class, 'getUsers'])->middleware(['auth', 'verified'])->name('users');

Route::post('/clientes/adicionar', [ClientController::class, 'registerClientSupplier'])->middleware(['auth', 'verified'])->name('clients');

Route::post('/produtos/adicionar', [ProductController::class, 'registerProducts'])->middleware(['auth', 'verified'])->name('products');

Route::post('/maquinas/adicionar', [MachineController::class, 'createMachine'])->middleware(['auth', 'verified'])->name('machines');

Route::post('/fabricantes/adicionar', [ManufacturersController::class, 'createManufacturer'])->middleware(['auth', 'verified'])->name('manufacturers');

Route::post('/representacoes/adicionar', [RepresentationController::class, 'createRepresentation'])->middleware(['auth', 'verified'])->name('representation');

Route::post('/cidades/adicionar', [CityController::class, 'createCity'])->middleware(['auth', 'verified'])->name('city');

Route::post('/explodida/adicionar', [ExplodedMachineController::class, 'createExplodedMachine'])->middleware(['auth', 'verified'])->name('explodedMachine');

Route::post('/os/encontrar/{id}', [OsController::class, 'getClient'])->name('osClient');

Route::get('/os/cadastrar/', [OsController::class, 'registerOs'])->middleware(['auth', 'verified'])->name('os');

Route::get('/os/produtos', [OsController::class, 'productsOs'])->name('os');

Route::post('/os/entrega/{id}', [OsController::class, 'guaranteeOs']);

Route::post('/usuarios/adicionar', [UsersController::class, 'createUser'])->middleware(['auth', 'verified'])->name('createUser');

Route::post('/explodida/atualizar/{id}', [ExplodedMachineController::class, 'updateExplodedMachine'])->middleware(['auth', 'verified'])->name('explodedMachine');

Route::put('/conta/atualizar/{id}', [DashboardController::class, 'newPassword'])->middleware(['auth', 'verified'])->name('newPassword');

Route::put('/clientes/atualizar/{id}', [ClientController::class, 'updateClientSupplier'])->middleware(['auth', 'verified'])->name('clients');

Route::put('/produtos/atualizar/{id}', [ProductController::class, 'updateProduct'])->middleware(['auth', 'verified'])->name('products');

Route::put('produtos/atualizar/estoque/{id}', [ProductController::class, 'updateProductStock'])->middleware(['auth', 'verified'])->name('products');

Route::put('maquinas/atualizar/{id}', [MachineController::class, 'updateMachine'])->middleware(['auth', 'verified'])->name('machines');

Route::put('/fabricantes/atualizar/{id}', [ManufacturersController::class, 'updateManufacturer'])->middleware(['auth', 'verified'])->name('manufacturers');

Route::put('/representacoes/atualizar/{id}', [RepresentationController::class, 'updateRepresentation'])->middleware(['auth', 'verified'])->name('representation');

Route::put('/cidades/atualizar/{id}', [CityController::class, 'updateCity'])->middleware(['auth', 'verified'])->name('city');

Route::put('/os/atualizar/{id}', [OsController::class, 'updateOs'])->middleware(['auth', 'verified'])->name('os');

Route::put('/usuarios/atualizar/{id}', [UsersController::class, 'updateUsers'])->middleware(['auth', 'verified'])->name('updateUsers');

Route::delete('produtos/delete/{id}', [ProductController::class, 'deleteProduct'])->middleware(['auth', 'verified'])->name('products');

Route::delete('/maquinas/delete/{id}', [MachineController::class, 'deleteMachine'])->middleware(['auth', 'verified'])->name('machines');

Route::delete('/fabricantes/delete/{id}', [ManufacturersController::class, 'deleteManufacturer'])->middleware(['auth', 'verified'])->name('manufacturers');

Route::delete('/representacoes/delete/{id}', [RepresentationController::class, 'deleteRepresentation'])->middleware(['auth', 'verified'])->name('representation');

Route::delete('/cidades/delete/{id}', [CityController::class, 'deleteCity'])->middleware(['auth', 'verified'])->name('city');

Route::delete('/usuarios/delete/{id}', [UsersController::class, 'deleteUsers'])->middleware(['auth', 'verified'])->name('deleteUsers');



Route::post('/search/clientes', [ClientController::class, 'clientSearch'])->name('clientSearch');
Route::post('/search/produtos', [ProductController::class, 'productSearch'])->name('productSearch');
Route::post('/search/maquinas', [MachineController::class, 'machineSearch'])->name('machineSearch');
Route::post('/search/os', [OsController::class, 'osSearch'])->name('osSearch');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
