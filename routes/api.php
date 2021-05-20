<?php

use App\Http\Controllers\NewFormCtrl;
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
    Route::get('new-forms', [NewFormCtrl::class, 'countNewForm'])->name('api-new-form-count');
    Route::get('rencana-praktikum', [NewFormCtrl::class, 'newForm'])->name('api-practice-plans');
    Route::post('form-baru/setujui', [NewFormCtrl::class, 'acc'])->name('api-practice-plans-acc');
    Route::post('form-baru/tolak', [NewFormCtrl::class, 'reject'])->name('api-practice-plans-reject');
});

