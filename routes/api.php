<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register-client', [ClientController::class, 'store']);

Route::get('list-clients', [ClientController::class, 'index']);

Route::get('find-client/{id}', [ClientController::class, 'show']);

Route::put('update-client/{id}', [ClientController::class, 'update']);

Route::delete('delete-client/{id}',[ClientController::class, 'destroy']);