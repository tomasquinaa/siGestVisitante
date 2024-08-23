<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;





Route::get('/', [AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 'authlogin'])->name('auth.login');

// Route::group(['middleware' => ['role:Super|Admin']], function () { - Essa parte colocamos na middleware AdminMiddleware
Route::group(['middleware' => ['isAdmin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'handle'])->name('home');

    // User
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [UserController::class, 'destroy']);

    // Permission
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

    // Role
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
    //Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->middleware('permission:delete role');
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

    // Visitas
    Route::get('/visits', [VisitanteController::class, 'index'])->name('visits.index');
    Route::get('/visits-out', [VisitanteController::class, 'indexOut'])->name('visits.indexOut');
    Route::get('/visits/create', [VisitanteController::class, 'create'])->name('visits.create');
    Route::post('/visits', [VisitanteController::class, 'store'])->name('visits.store');
    Route::patch('/visits/{visit}/exit', [VisitanteController::class, 'updateExitTime'])->name('visits.updateExitTime');

    // Gerar PDF
    Route::get('/gerar-pdf-visits-out', [VisitanteController::class, 'gerarPdf'])->name('visits.gerarpdf');

    // Departamento
    Route::get('/departaments', [DepartamentoController::class, 'handleCreate'])->name('departament.create');
    Route::post('/departaments', [DepartamentoController::class, 'handleStore'])->name('departament.store');
});

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');


// Route::middleware('admin')->group(function () {

//     Route::get('/dashboard', [DashboardController::class, 'handle'])->name('home');

//     // Visitas
//     Route::get('/visits', [VisitanteController::class, 'index'])->name('visits.index');
//     Route::get('/visits-out', [VisitanteController::class, 'indexOut'])->name('visits.indexOut');
//     Route::get('/visits/create', [VisitanteController::class, 'create'])->name('visits.create');
//     Route::post('/visits', [VisitanteController::class, 'store'])->name('visits.store');
//     Route::patch('/visits/{visit}/exit', [VisitanteController::class, 'updateExitTime'])->name('visits.updateExitTime');

//     // Gerar PDF
//     Route::get('/gerar-pdf-visits-out', [VisitanteController::class, 'gerarPdf'])->name('visits.gerarpdf');

//     // Departamento
//     Route::get('/departaments', [DepartamentoController::class, 'handleCreate'])->name('departament.create');
//     Route::post('/departaments', [DepartamentoController::class, 'handleStore'])->name('departament.store');
// });

//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




// Route::get('/login', function () {
//    return view('auth.login');
// })->name('login');