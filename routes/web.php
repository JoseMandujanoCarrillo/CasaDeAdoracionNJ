<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CosasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SalmoController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PsalmOfTheWeekController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\Admin\EventAdminController;

// Página principal (Church) con Salmo de la Semana
Route::get('/', HomeController::class)->name('home');

// Contacto - Guardar mensaje
Route::post('/contacto', [ContactMessageController::class, 'store'])->name('contacto.store');

// Admin - Ver mensajes de contacto (protegido por middleware 'auth' y 'admin' si existe)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages');
});

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




// Rutas para gestión de eventos en el panel admin (AJAX)
Route::prefix('admin')->group(function() {
    Route::get('/events', [EventAdminController::class, 'index']);
    Route::post('/events', [EventAdminController::class, 'store']);
    Route::get('/events/{id}', [EventAdminController::class, 'show']);
    Route::put('/events/{id}', [EventAdminController::class, 'update']);
    Route::delete('/events/{id}', [EventAdminController::class, 'destroy']);
    // Nueva ruta para obtener inscritos a un evento
    Route::get('/events/{id}/registrations', [\App\Http\Controllers\Admin\EventRegistrationAdminController::class, 'index']);
});


// Guardar Salmo de la Semana (AJAX desde dashboard)
Route::post('/admin/psalm-of-the-week', [AdminController::class, 'savePsalmOfTheWeek'])->name('admin.savePsalmOfTheWeek');

// Dashboard admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Ruta para actualizar el perfil de un usuario (solo Admin)
Route::post('/admin/update-profile/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
Route::get('/galerias', [\App\Http\Controllers\HomeController::class, 'galeriasPorCategoria'])->name('galerias.categorias');
Route::get('/galerias/{categoria}', [\App\Http\Controllers\HomeController::class, 'galeriaCategoria'])->name('galerias.categoria');

// Página de detalle de evento
Route::get('/event/{id}', [EventRegistrationController::class, 'show'])->name('event.detail');
// Registro a evento
Route::post('/event/{id}/register', [EventRegistrationController::class, 'register'])->name('event.register');

// Página "Sobre Nosotros"
Route::get('/about', function() {
    return view('about');
});
