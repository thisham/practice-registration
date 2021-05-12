<?php

use App\Http\Controllers\LaboratoryCtrl;
use App\Http\Controllers\NewFormCtrl;
use App\Http\Controllers\PracticeCheckCtrl;
use App\Http\Controllers\PracticeHistoryCtrl;
use App\Http\Controllers\PracticePlansCtrl;
use App\Http\Controllers\PracticeRegistrationCtrl;
use App\Http\Controllers\SessionCtrl;
use App\Http\Controllers\ToolsClassificationCtrl;
use App\Http\Controllers\UserCtrl;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'pages.landing.home')->name('landing-page');
Route::view('tutorial', 'pages.landing.tutorial')->name('landing-tutorial');

Route::middleware('guest')->group(function () {
    Route::view('login', 'pages.login')->name('login');
    Route::post('login', [SessionCtrl::class, 'create'])->name('login');
    Route::view('register', 'pages.register')->name('register');
    Route::post('register', [SessionCtrl::class, 'store'])->name('register');
});

Route::prefix('praktikum')->group(function () {
    // Route::view('/');

    Route::prefix('registrasi')->group(function () {
        Route::get('/', [PracticeRegistrationCtrl::class, 'index'])->name('register-new-practice');
        Route::get('isi-data', [PracticeRegistrationCtrl::class, 'timeAndPlace'])->name('register-set-time-and-place');
        Route::post('isi-data', [PracticeRegistrationCtrl::class, 'timeAndPlaceResponse'])->name('register-set-time-and-place');
        Route::get('isi-data/kti', [PracticeRegistrationCtrl::class, 'fillKTIFormData'])->name('register-fill-kti-practice-data');
        Route::get('isi-data/ext', [PracticeRegistrationCtrl::class, 'fillEXTFormData'])->name('register-fill-ext-practice-data');
        Route::get('isi-data/reg', [PracticeRegistrationCtrl::class, 'fillREGFormData'])->name('register-fill-reg-practice-data');
        Route::post('isi-data/kti', [PracticeRegistrationCtrl::class, 'storeKTIForm'])->name('register-fill-kti-practice-data');
        Route::post('isi-data/ext', [PracticeRegistrationCtrl::class, 'storeEXTForm'])->name('register-fill-ext-practice-data');
        Route::post('isi-data/reg', [PracticeRegistrationCtrl::class, 'storeREGForm'])->name('register-fill-reg-practice-data');
        Route::get('tiket-praktikum', [PracticeRegistrationCtrl::class, 'practiceTicket'])->name('register-get-practice-ticket');
    });

    Route::prefix('cek')->group(function () {
        Route::get('/', [PracticeCheckCtrl::class, 'index'])->name('check-registration');
        Route::get('form/{id}', [PracticeCheckCtrl::class, 'show'])->name('check-registration-number');
        Route::get('form/{id}/print', [PracticeCheckCtrl::class], 'print')->name('check-registration-number-print');
    });
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [UserCtrl::class, 'index'])->name('home');

    Route::get('logout', [SessionCtrl::class, 'destroy'])->name('logout');

    Route::get('form-baru', [NewFormCtrl::class, 'index'])->name('admin-new-practices');
    Route::get('form-baru/{id}', [NewFormCtrl::class, 'show'])->name('admin-new-practice');
    Route::get('form-baru/{id}/print', [NewFormCtrl::class, 'print'])->name('admin-new-practice-print');
    Route::get('form-baru/{id}/setujui', [NewFormCtrl::class, 'acc'])->name('admin-new-practice-acc');
    Route::get('form-baru/{id}/tolak', [NewFormCtrl::class, 'reject'])->name('admin-new-practice-reject');

    Route::get('rencana-praktikum', [PracticePlansCtrl::class, 'index'])->name('admin-practice-plans');
    Route::get('rencana-praktikum/{id}', [PracticePlansCtrl::class, 'show'])->name('admin-practice-plan');
    Route::get('rencana-praktikum/{id}/print', [PracticePlansCtrl::class, 'print'])->name('admin-practice-plan-print');
    Route::get('rencana-praktikum/{id}/edit', [PracticePlansCtrl::class, 'edit'])->name('admin-practice-plan-edit');
    Route::get('rencana-praktikum/{id}/selesai', [PracticePlansCtrl::class, 'end'])->name('admin-practice-plan-set-expired');
    
    Route::get('riwayat-praktikum', [PracticeHistoryCtrl::class, 'index'])->name('admin-practice-histories');
    Route::get('riwayat-praktikum/{id}', [PracticeHistoryCtrl::class, 'show'])->name('admin-practice-history');
    Route::get('riwayat-praktikum/{id}/print', [PracticeHistoryCtrl::class, 'print'])->name('admin-practice-history-print');

    Route::get('laboratorium', [LaboratoryCtrl::class, 'index'])->name('admin-manage-laboratories');
    Route::get('laboratorium/tambah', [LaboratoryCtrl::class, 'create'])->name('admin-add-laboratory');
    Route::post('laboratorium/tambah', [LaboratoryCtrl::class, 'store'])->name('admin-add-laboratory');
    Route::get('laboratorium/{id}', [LaboratoryCtrl::class, 'show'])->name('admin-show-laboratory');
    Route::get('laboratorium/{id}/edit', [LaboratoryCtrl::class, 'edit'])->name('admin-edit-laboratory');
    Route::post('laboratorium/{id}/edit', [LaboratoryCtrl::class, 'update'])->name('admin-edit-laboratory');
    Route::get('laboratorium/{id}/hapus', [LaboratoryCtrl::class, 'destroy'])->name('admin-delete-laboratory');

    Route::get('alat', [ToolsClassificationCtrl::class, 'index'])->name('admin-manage-tools');
    Route::get('alat/tambah', [ToolsClassificationCtrl::class, 'create'])->name('admin-add-tool');
    Route::post('alat/tambah', [ToolsClassificationCtrl::class, 'store'])->name('admin-add-tool');
    Route::get('alat/{id}', [ToolsClassificationCtrl::class, 'show'])->name('admin-show-tool');
    Route::get('alat/{id}/edit', [ToolsClassificationCtrl::class, 'edit'])->name('admin-edit-tool');
    Route::post('alat/{id}/edit', [ToolsClassificationCtrl::class, 'update'])->name('admin-edit-tool');
    Route::get('alat/{id}/hapus', [ToolsClassificationCtrl::class, 'destroy'])->name('admin-delete-tool');
    
    Route::prefix('akun')->group(function () {
        Route::get('/', [UserCtrl::class, 'index'])->name('admin-account-info');
        Route::get('pw-change', [UserCtrl::class, 'passwordEdit'])->name('admin-change-account-password');
        Route::get('info-change', [UserCtrl::class, 'infoEdit'])->name('admin-change-account-info');
    });
});
