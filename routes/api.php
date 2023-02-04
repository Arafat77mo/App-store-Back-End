<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\getwaysController;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
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


});
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('change/password',  [NewPasswordController::class, 'forgotPassword']);
Route::post('forgot/check-code', [NewPasswordController::class, 'checkCode']);
Route::post('reset/password', [NewPasswordController::class, 'reset']);
Route::post('admin/Register', [AuthController::class, 'adminRegister']);
Route::group(['middleware' => 'auth:api'], function () {

    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');


    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/edit/user', [AuthController::class, 'updateProfile']);
    Route::get('user/{id}/delete', [AuthController::class, 'destroy']);
    Route::get('show/user', [AuthController::class, 'details']);
    Route::get('show/category/{id}', [CategoryController::class, 'show']);
    Route::post('favourite/product', [HomeController::class, 'favourite']);
    Route::get('favourite/show/{id}', [HomeController::class, 'show']);
    Route::get('/favourite/{id}/delete', [HomeController::class, 'destroy']);
Route::get('/favourite/delete/all', [HomeController::class, 'delete']);


Route::apiResource('carts', CartController::class)->except(['update', 'index']);
// Route::post('/carts/{cart}/checkout', 'CartController@checkout');
Route::post('/carts/{id}', [CartController::class, 'addProducts']);
Route::post('/carts/{id}/checkout', [CartController::class, 'checkout']);
Route::get('/carts/{id}/delete', [CartController::class, 'destroy']);
Route::get('/carts/delete/all', [CartController::class, 'delete']);

Route::post('Payment', [PaymentController::class, 'payment']);
    Route::get('myOrders', [OrderController::class,'myOrder']);

Route::get("usernotfy",[UserController::class ,'usernotfy']);
Route::get("allGetways",[getwaysController::class,"allgetways"]);
Route::delete("deleteprofile",[UserController::class,"deleteProfile"]);
Route::get('/show/carts/{id}', [CartController::class, 'show']);

});
Route::get("search/{title}",[ProductController::class,'searchproduct']);
Route::get('product', [ProductController::class, 'indexxx']);




