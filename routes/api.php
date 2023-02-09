<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\LoginController;
use App\Mail\OrderShipped;
use App\Http\Controllers\InvoiceController;
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

//collection
Route::get("collection",[CollectionController::class,'collection_class']);
Route::get("collection1",[CollectionController::class,'collection_method']);
Route::get("collection2",[CollectionController::class,'filter_data']);
Route::get("collection3",[CollectionController::class,'member_collection']);
Route::post("auth", [LoginController::class,'login']);

Route::get('/sendmail',function(){
    Mail::to('test@test.com')->send(new OrderShipped());
});

//notification
Route::get('invoice/{id}', [InvoiceController::class, 'show'])->name('show.invoice');
 
Route::post('invoice-paid', [InvoiceController::class, 'sendInvoicePaidNotification'])
    ->name('notify.invoice.paid');