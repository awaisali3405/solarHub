<?php

use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\front\CalculateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/product/raw', [RecipeController::class, 'rawProduct'])->name('rawProduct');
Route::get('/remove/product/{id}', [RecipeController::class, 'removeProduct']);
Route::get('/purchase/product', [PurchaseController::class, 'addProduct']);
Route::post('/purchase/product/remove', [PurchaseController::class, 'removeProduct']);
Route::get('/contact-list/{id}', [App\Http\Controllers\Api\ContactController::class, 'getContactList']);


Route::get('/conversation/{id}/{auth_id}', [App\Http\Controllers\Api\ContactController::class, 'getMessages']);


Route::post('/conversation/send', [App\Http\Controllers\Api\ContactController::class, 'sendNewMessage']);

Route::post('/search/product',[\App\Http\Controllers\front\HomeController::class,'searchProduct']);
Route::get('/get/accessories',[CalculateController::class,'getAccessories']);
