<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
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


// Public Routes
Route::get('/login', function() {
    return response([
        'message' => 'Unauthenticated.'
    ], 401);
})->name('login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// User
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // User
    Route::post('/logout', [AuthController::class, 'logout']);

    // Addresses
    Route::resource('addresses', AddressController::class);
    Route::get('/addresses/search/address/{address}', [AddressController::class, 'searchByAddress']);
    Route::get('/addresses/search/postal-code/{postal_code}', [AddressController::class, 'searchByPostalCode']);
});
