<?php

use App\Http\Controllers\NewFormCtrl;
use App\Http\Controllers\PracticeCancelledCtrl;
use App\Http\Controllers\PracticeHistoryCtrl;
use App\Http\Controllers\PracticePlansCtrl;
use App\Http\Controllers\PracticeRejectedCtrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function () {
    Route::get('form-baru/hitung', [NewFormCtrl::class, 'countNewForm'])->name('api-new-form-count');
    Route::get('form-baru/list', [NewFormCtrl::class, 'newForm'])->name('api-new-form-list');
    Route::post('form-baru/setujui', [NewFormCtrl::class, 'acc'])->name('api-new-form-acc');
    Route::post('form-baru/tolak', [NewFormCtrl::class, 'reject'])->name('api-new-form-reject');

    Route::get('rencana-praktikum/list', [PracticePlansCtrl::class, 'allPlans'])->name('api-practice-plan-list');
    Route::post('rencana-praktikum/batal', [PracticePlansCtrl::class, 'cancel'])->name('api-practice-plan-cancel');

    Route::get('riwayat-praktikum/list', [PracticeHistoryCtrl::class, 'allPractices'])->name('api-practice-history-list');
    Route::get('praktikum-ditolak/list', [PracticeRejectedCtrl::class, 'allPlans'])->name('api-new-form-rejected-list');
    Route::get('praktikum-ditolak/acc', [PracticeRejectedCtrl::class, 'acc'])->name('api-new-form-rejected-list');
    Route::get('praktikum-dibatalkan/list', [PracticeCancelledCtrl::class, 'allPractices'])->name('api-practice-plan-canceled-list');
    Route::get('praktikum-dibatalkan/jalan', [PracticeCancelledCtrl::class, 'acc'])->name('api-practice-plan-canceled-acc');
});

