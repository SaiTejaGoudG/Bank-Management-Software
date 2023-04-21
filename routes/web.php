<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;


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

Route::get('/', function () {
    return view('welcome');
});


/* API Routes */
// include_once('api.php');
/* API Routes */

// Route::get('states', [StateController::class, 'index'] );
// // dd("HI");
// Route::post('states', [StateController::class, 'store'] );
// Route::get('states/{state}', [StateController::class, 'show'] );
