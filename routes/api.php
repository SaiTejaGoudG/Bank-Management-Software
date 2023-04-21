<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
use App\Http\Controllers\AccountHoldersController;
use App\Http\Controllers\TransactionController;




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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('states', [StateController::class, 'index'] );
Route::post('states', [StateController::class, 'store'] );
Route::get('states/{state}', [StateController::class, 'show'] );



Route::get('account-details', [AccountHoldersController::class, 'index'] );
Route::post('account-details', [AccountHoldersController::class, 'store'] );
Route::get('account-details/{id}', [StaAccountHoldersControllerteController::class, 'show'] );

Route::get('transactions', [TransactionController::class, 'index'] );
Route::get('transactions/accountHolders', [TransactionController::class, 'getAccountHolders'] );
Route::post('transactions', [TransactionController::class, 'store'] );
Route::get('transactions/{id}', [TransactionController::class, 'show'] );