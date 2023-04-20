<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SocialMediaController;
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
Route::resource('blogs', BlogsController::class);
Route::resource('services', ServicesController::class);
Route::resource('projects', ProjectsController::class);
Route::resource('social-media', SocialMediaController::class);
Route::resource('shipping', ShippingController::class);
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::get('gallery', [GalleryController::class,'index']);

Route::post('contact-us', [ContactUsController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
