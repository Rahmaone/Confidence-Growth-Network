<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\guestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\StreamChatController;

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
    return redirect('/home');
});

// Route untuk halaman '/home'
Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('register', [RegisterController::class, 'register'])->name('register');

// Auth::routes();
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        // Auth::routes();

        // Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
        // ->middleware('auth');
        // ['middleware' => 'auth'],
        // Route::prefix('pages')->as('pages.')->group(function () {
        //     Route::get('icons', [AdminController::class, 'icons'])->name('icons');
        //     Route::get('maps', [AdminController::class, 'maps'])->name('maps');
        //     Route::get('notifications', [AdminController::class, 'notifications'])->name('notifications');
        //     Route::get('rtl', [AdminController::class, 'rtl'])->name('rtl');
        //     Route::get('tables', [AdminController::class, 'tables'])->name('tables');
        //     Route::get('typography', [AdminController::class, 'typography'])->name('typography');
        //     Route::get('upgrade', [AdminController::class, 'upgrade'])->name('upgrade');
        // });

        Route::group([], function () {
            Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
            Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
            Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
            Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
        });

        Route::get('userManagement', [AdminController::class, 'userManagement'])->name('userManagement'); // Halaman user management
        Route::get('userManagement/create', [AdminController::class, 'buatUser'])->name('buatUser'); // Halaman buat user
        Route::post('userManagement/store', [AdminController::class, 'simpanUser'])->name('simpanUser'); // Proses simpan user baru
        Route::get('userManagement/{id}/edit', [AdminController::class, 'editUser'])->name('editUser'); // Halaman edit user
        Route::put('userManagement/{id}/update', [AdminController::class, 'updateUser'])->name('updateUser'); // Proses update user baru
        Route::delete('userManagement/{id}/delete', [AdminController::class, 'deleteUser'])->name('deleteUser'); // Proses delete user


        Route::get('eventAnnouncement', [AdminController::class, 'eventAnnouncement'])->name('eventAnnouncement'); // Halaman daftar event (index)
        Route::get('eventAnnouncement/create', [AdminController::class, 'buatEvent'])->name('buatEvent'); // Halaman buat event
        Route::post('eventAnnouncement/store', [AdminController::class, 'simpanEvent'])->name('simpanEvent'); // Proses simpan event baru
        Route::get('eventAnnouncement/{id}/edit', [AdminController::class, 'editEvent'])->name('editEvent'); // Halaman edit event
        Route::put('eventAnnouncement/{id}/update', [AdminController::class, 'updateEvent'])->name('updateEvent'); // Proses update event baru
        Route::delete('eventAnnouncement/{id}/delete', [AdminController::class, 'deleteEvent'])->name('deleteEvent'); // Proses delete event

        Route::get('modulPembelajaran', [AdminController::class, 'modulPembelajaran'])->name('modulPembelajaran'); // Halaman daftar modul
        Route::get('modulPembelajaran/create', [AdminController::class, 'buatModul'])->name('buatModul'); // Halaman buat modul
        Route::post('modulPembelajaran/store', [AdminController::class, 'createModul'])->name('createModul'); // Proses simpan modul baru
        Route::get('modulPembelajaran/{id}/editModul', [AdminController::class, 'editModul'])->name('editModul'); // Halaman edit modul

        Route::put('modulPembelajaran/{id}/update', [AdminController::class, 'updateModul'])->name('updateModul');// Proses update modul baru
        Route::delete('modulPembelajaran/{id}/delete', [AdminController::class, 'deleteModul'])->name('deleteModul');// Proses delete modul baru

    });
});

Route::middleware(['auth', 'role:user,mentor,admin'])->group(function () {
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/bukamodulPembelajaran', [userController::class, 'bukamodulPembelajaran'])->name('bukamodulPembelajaran');
        Route::get('/pelaksanaankuiz', [UserController::class, 'pelaksanaankuiz'])->name('pelaksanaankuiz');
        Route::get('/hasilkuiz', [UserController::class, 'hasilkuiz'])->name('hasilkuiz');
        Route::get('/eventAnnouncement', [UserController::class, 'eventAnnouncement'])->name('eventAnnouncement');
        Route::get('/eventAnnouncement/{slug}', [UserController::class, 'bukaEvent'])->name('bukaEvent');
    });
});

Route::middleware(['auth', 'role:user,mentor'])->group(function () {
    Route::prefix('chat')->as('chat.')->group(function () {
        Route::get('/chatmentor', [UserController::class, 'chatmentor'])->name('chatmentor');

        Route::get('/initializeChat/{otherId}', [UserController::class, 'initializeChat'])->name('initializeChat');

    });
});

Route::get('/home', [guestController::class, 'index'])->name('home');
Route::get('/service', [guestController::class, 'service'])->name('service');
Route::get('/service2', [guestController::class, 'chatmentor'])->name('chatmentor');
Route::get('/service3', [guestController::class, 'kuiz'])->name('kuiz');
Route::get('/service4', [guestController::class, 'event'])->name('event');
Route::get('/about', [guestController::class, 'about'])->name('about');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // route ke halaman yang cuman bisa diakses admin dan mentor
});



Route::group(['middleware' => 'authuser'], function () {});