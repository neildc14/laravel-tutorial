<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MemberController;

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

Route::get('data', [DummyController::class, 'getData']);
Route::get('list/{id?}/{name?}/{member_id?}',[DeviceController::class,'searchList']);

Route::post('add', [DeviceController::class, 'addDevice']);
Route::put('update', [DeviceController::class, 'updateDevice']);

Route::get("search/{name}", [DeviceController::class, 'search']);
Route::delete("delete/{id}",[DeviceController::class, 'delete']);

Route::get('save',[DeviceController::class, 'testData']);

//resource
Route::resource('member',MemberController::class);