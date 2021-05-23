<?php

use App\Http\Controllers\CourseCtrl;
use App\Http\Controllers\FormActionCtrl;
use App\Http\Controllers\LaboratoryCtrl;
use App\Http\Controllers\NewFormCtrl;
use App\Http\Controllers\PracticeCancelledCtrl;
use App\Http\Controllers\PracticeCheckCtrl;
use App\Http\Controllers\PracticeHistoryCtrl;
use App\Http\Controllers\PracticePlansCtrl;
use App\Http\Controllers\PracticeRegistrationCtrl;
use App\Http\Controllers\PracticeRejectedCtrl;
use App\Http\Controllers\SessionCtrl;
use App\Http\Controllers\ToolClassificationCtrl;
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
        Route::post('kirim-form', [PracticeRegistrationCtrl::class, 'storeForm'])->name('register-fill-practice-data');
        Route::get('tiket-praktikum/{id}', [PracticeRegistrationCtrl::class, 'practiceTicket'])->name('register-get-practice-ticket');
    });

    Route::prefix('cek')->group(function () {
        Route::get('/', [PracticeCheckCtrl::class, 'index'])->name('check-registration');
        Route::get('form', [PracticeCheckCtrl::class, 'show'])->name('check-registration-number');
        Route::get('form/{id}/print', [PracticeCheckCtrl::class, 'print'])->name('check-registration-number-print');
    });
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [UserCtrl::class, 'index'])->name('home');

    Route::get('logout', [SessionCtrl::class, 'destroy'])->name('logout');

    Route::get('form/preview', [FormActionCtrl::class, 'preview'])->name('admin-form-preview');
    Route::get('form/{id}/print', [FormActionCtrl::class, 'print'])->name('admin-form-print');

    Route::get('form-baru', [NewFormCtrl::class, 'index'])->name('admin-new-practices');

    Route::get('rencana-praktikum', [PracticePlansCtrl::class, 'index'])->name('admin-practice-plans');
    Route::get('rencana-praktikum/edit', [PracticePlansCtrl::class, 'adjust'])->name('admin-practice-plan-edit');
    Route::post('rencana-praktikum/{id}/selesai', [PracticePlansCtrl::class, 'update'])->name('admin-practice-plan-set-done');
    
    Route::get('riwayat-praktikum', [PracticeHistoryCtrl::class, 'index'])->name('admin-practice-histories');
    Route::get('praktikum-dibatalkan', [PracticeCancelledCtrl::class, 'index'])->name('admin-practice-cancelled');
    Route::get('praktikum-ditolak', [PracticeRejectedCtrl::class, 'index'])->name('admin-practice-rejected');

    Route::get('laboratorium', [LaboratoryCtrl::class, 'index'])->name('admin-manage-laboratories');
    Route::get('laboratorium/tambah', [LaboratoryCtrl::class, 'create'])->name('admin-add-laboratory');
    Route::post('laboratorium/tambah', [LaboratoryCtrl::class, 'store'])->name('admin-add-laboratory');
    Route::get('laboratorium/{id}', [LaboratoryCtrl::class, 'show'])->name('admin-show-laboratory');
    Route::get('laboratorium/{id}/edit', [LaboratoryCtrl::class, 'edit'])->name('admin-edit-laboratory');
    Route::post('laboratorium/{id}/edit', [LaboratoryCtrl::class, 'update'])->name('admin-edit-laboratory');
    Route::get('laboratorium/{id}/hapus', [LaboratoryCtrl::class, 'destroy'])->name('admin-delete-laboratory');

    Route::get('alat', [ToolClassificationCtrl::class, 'index'])->name('admin-manage-tools');
    Route::get('alat/tambah', [ToolClassificationCtrl::class, 'create'])->name('admin-add-tool');
    Route::post('alat/tambah', [ToolClassificationCtrl::class, 'store'])->name('admin-add-tool');
    Route::get('alat/{id}', [ToolClassificationCtrl::class, 'show'])->name('admin-show-tool');
    Route::get('alat/{id}/edit', [ToolClassificationCtrl::class, 'edit'])->name('admin-edit-tool');
    Route::post('alat/{id}/edit', [ToolClassificationCtrl::class, 'update'])->name('admin-edit-tool');
    Route::get('alat/{id}/hapus', [ToolClassificationCtrl::class, 'destroy'])->name('admin-delete-tool');

    Route::get('mata-kuliah', [CourseCtrl::class, 'index'])->name('admin-manage-courses');
    Route::get('mata-kuliah/tambah', [CourseCtrl::class, 'create'])->name('admin-add-course');
    Route::post('mata-kuliah/tambah', [CourseCtrl::class, 'store'])->name('admin-add-course');
    Route::get('mata-kuliah/{id}', [CourseCtrl::class, 'show'])->name('admin-show-course');
    Route::get('mata-kuliah/{id}/edit', [CourseCtrl::class, 'edit'])->name('admin-edit-course');
    Route::post('mata-kuliah/{id}/edit', [CourseCtrl::class, 'update'])->name('admin-edit-course');
    Route::get('mata-kuliah/{id}/hapus', [CourseCtrl::class, 'destroy'])->name('admin-delete-course');
    
    Route::prefix('akun')->group(function () {
        Route::get('/', [UserCtrl::class, 'index'])->name('admin-account-info');
        Route::get('pw-change', [UserCtrl::class, 'passwordEdit'])->name('admin-change-account-password');
        Route::post('pw-change', [UserCtrl::class, 'passwordUpdate'])->name('admin-change-account-password');
        Route::get('info-change', [UserCtrl::class, 'infoEdit'])->name('admin-change-account-info');
        Route::post('info-change', [UserCtrl::class, 'infoUpdate'])->name('admin-change-account-info');
    });
});
