<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\CategoriasController;
use TCG\Voyager\Facades\Voyager;

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



Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/publicaciones', [PublicacionesController::class, 'index'])->name('publicaciones');
    Route::get('/publicaciones/create', [PublicacionesController::class, 'create'])->name('publicaciones.create');
    Route::post('/publicaciones', [PublicacionesController::class, 'store'])->name('publicaciones.store');
    Route::get('/publicaciones/{publicaciones}/edit', [PublicacionesController::class, 'edit'])->name('publicaciones.edit');
    Route::put('/publicaciones/{publicaciones}', [PublicacionesController::class, 'update'])->name('publicaciones.update');
    Route::delete('/publicaciones/{publicaciones}', [PublicacionesController::class, 'destroy'])->name('publicaciones.destroy');
    Route::get('/publicaciones/{id}', [PublicacionesController::class, 'show'])->name('publicaciones.show');
    Route::get('/intereses', [PublicacionesController::class, 'misIntereses'])->name('intereses');
    Route::post('/publicaciones/{id}/intereses', [PublicacionesController::class, 'meInteresa'])->name('publicaciones.intereses');
    Route::get('/productos', [ProductosController::class, 'index'])->name('productos');
    Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/{usuarios}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::get('/usuarios/{id}', [UsuariosController::class, 'show'])->name('usuarios.show');
    Route::put('/usuarios/{usuarios}', [UsuariosController::class, 'update'])->name('usuarios.update');
    
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias');

    Route::get('/publicaciones/categoria/{id}', [PublicacionesController::class, 'filterByCategory'])->name('publicaciones.categoria');


});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Desactivar la ruta de login predeterminada de Laravel
Auth::routes(['login' => false]);

// Define las rutas de login personalizadas
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');