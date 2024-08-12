<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\VisitorController;
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

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authlogin'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'handle']);


// Visitas
Route::get('/visits', [VisitanteController::class, 'index'])->name('visits.index');
Route::get('/visits-out', [VisitanteController::class, 'indexOut'])->name('visits.indexOut');
Route::get('/visits/create', [VisitanteController::class, 'create'])->name('visits.create');
Route::post('/visits', [VisitanteController::class, 'store'])->name('visits.store');
Route::patch('/visits/{visit}/exit', [VisitanteController::class, 'updateExitTime'])->name('visits.updateExitTime');

// Departamento
Route::get('/departaments', [DepartamentoController::class, 'handleCreate'])->name('departament.create');
Route::post('/departaments', [DepartamentoController::class, 'handleStore'])->name('departament.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'admin'], function () {

   // Route::get('/dashboard', [DashboardController::class, 'handle']);

// // Visitas
// Route::get('/visits', [VisitanteController::class, 'index'])->name('visits.index');
// Route::get('/visits-out', [VisitanteController::class, 'indexOut'])->name('visits.indexOut');
// Route::get('/visits/create', [VisitanteController::class, 'create'])->name('visits.create');
// Route::post('/visits', [VisitanteController::class, 'store'])->name('visits.store');
// Route::patch('/visits/{visit}/exit', [VisitanteController::class, 'updateExitTime'])->name('visits.updateExitTime');

// // Departamento
// Route::get('/departaments', [DepartamentoController::class, 'handleCreate'])->name('departament.create');
// Route::post('/departaments', [DepartamentoController::class, 'handleStore'])->name('departament.store');

});


// Route::get('/login', function () {
//    return view('auth.login');
// })->name('login');