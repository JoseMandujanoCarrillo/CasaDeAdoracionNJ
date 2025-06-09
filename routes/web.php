<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CosasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SalmoController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PsalmOfTheWeekController;
use App\Http\Controllers\Admin\EventController;

// Página principal (Church) con Salmo de la Semana
Route::get('/', HomeController::class)->name('home');

// Otras rutas de ejemplo
Route::get('Cosa', [CosasController::class, 'show'])->name('cosas.show');
Route::get('Cosas/{pagina}/{pagina2?}', [CosasController::class, 'index'])->name('cosas.index');
Route::get('Admin/{pagina}', [AdminController::class, 'create'])->name('Admin.create');

// Salmos
Route::get('/salmos', [SalmoController::class, 'index'])->name('salmos.index');
Route::post('/salmos', [SalmoController::class, 'show'])->name('salmos.show');

// Galería
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.edit');
Route::post('/gallery/upload', [GalleryController::class, 'upload'])->name('gallery.upload');
Route::delete('/gallery/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
Route::get('/church', [GalleryController::class, 'showGallery'])->name('church');

// Registro y login
Route::get('/register', [accountController::class, 'showRegister'])->name('register.form');
Route::post('/register', [accountController::class, 'register'])->name('register');
Route::get('/login', [accountController::class, 'showLogin'])->name('login.form');
Route::post('/login', [accountController::class, 'login'])->name('login');
Route::post('/logout', [accountController::class, 'logout'])->name('logout');




Route::get('/admin/events', [EventController::class, 'index']);
Route::post('/admin/events', [EventController::class, 'store']);
Route::put('/admin/events/{id}', [EventController::class, 'update']);
Route::delete('/admin/events/{id}', [EventController::class, 'destroy']);



// Guardar Salmo de la Semana (AJAX desde dashboard)
Route::post('/admin/psalm-of-the-week', [AdminController::class, 'savePsalmOfTheWeek'])->name('admin.savePsalmOfTheWeek');

// Dashboard admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
