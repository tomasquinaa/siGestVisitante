<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\LogAcessoController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitanteController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//    // return redirect('admin/login');
//    return view('welcome');
// });

/** Front End */
Route::get('/', [HomeController::class, 'index'])->name('home-site');

Route::get('admin/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('admin/login', [AuthenticationController::class, 'authlogin'])->name('auth.login');


// Route::group(['middleware' => ['role:Super|Admin']], function () { - Essa parte colocamos na middleware AdminMiddleware
Route::group(['middleware' => ['isAdmin']], function () {

    Route::get('dashboard', [DashboardController::class, 'handle'])->name('home');

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
    Route::get('visits', [VisitanteController::class, 'index'])->name('visits.index');
    Route::get('visits-out', [VisitanteController::class, 'indexOut'])->name('visits.indexOut');
    Route::get('visits/create', [VisitanteController::class, 'create'])->name('visits.create');
    Route::post('visits', [VisitanteController::class, 'store'])->name('visits.store');
    Route::patch('visits/{visit}/exit', [VisitanteController::class, 'updateExitTime'])->name('visits.updateExitTime');

    // Companies
    Route::get('empresas', [CompaniesController::class, 'handleIndex'])->name('companies.index');
    Route::get('empresas/create', [CompaniesController::class, 'handleCreate'])->name('companies.create');
    Route::get('empresas/{id}', [CompaniesController::class, 'handleShow'])->name('companies.show');
    Route::put('companies/{id}', [CompaniesController::class, 'handleUpdate'])->name('companies.update');
    Route::get('empresas/{id}/edit', [CompaniesController::class, 'handleEdit'])->name('companies.edit');
    Route::delete('empresas/{id}', [CompaniesController::class, 'handleDestroy'])->name('companies.destroy');
    Route::post('empresas/registar-empresas', [CompaniesController::class, 'handleStore'])->name('companies.store');

    // Gerar PDF
    Route::get('gerar-pdf-visits-out', [VisitanteController::class, 'gerarPdf'])->name('visits.gerarpdf');

    // Departamento
    Route::get('departaments-listagem', [DepartamentoController::class, 'handleIndex'])->name('departament.index');
    Route::get('departaments-criar', [DepartamentoController::class, 'handleCreate'])->name('departament.create');
    Route::post('departaments', [DepartamentoController::class, 'handleStore'])->name('departament.store');

    // Logs
    Route::get('logs', [LogAcessoController::class, 'handleLogAcesso'])->name('log.acesso');
});

Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');


