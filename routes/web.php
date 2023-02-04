<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\getwaysController;

use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\SubbCategory;
use Illuminate\Support\Facades\Route;
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
Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::prefix("admin")->middleware(['auth','role:admin'])->group(function(){
    Route::get("/",[HomeController::class,'HomeInfo']);
    Route::resource("category",CategoryController::class);
    Route::get("category/{id}/delete",[CategoryController::class,'destroy'])->name("category.delete");
    Route::resource("products",ProductController::class);
    Route::resource("order",OrderController::class);
    Route::get("order/{id}/delete",[OrderController::class,'destroy'])->name("order.delete");
    Route::post("order/{id}",[OrderController::class,'updateStatus'])->name("order.updateStatus") ;
    Route::get("neworder",[OrderController::class,'neworder'])->name("order.neworder");
    Route::get("orderrs/canceled",[OrderController::class,'indexx'])->name("order.indexx");
    Route::get("workprogress",[OrderController::class,'workprogress'])->name("order.workprogress");
    Route::get("orderDriver",[OrderController::class,'orderDriver'])->name("order.orderDriver");


    Route::get("productSoldOut",[ProductController::class,'productSoldOut'])->name("products.productSoldOut");

    Route::get("proindex",[ProductController::class,'indexx'])->name("products.indexx");
    Route::get("products/{id}/delete",[ProductController::class,'destroy'])->name("products.delete");
    Route::resource("user",UserController::class);
    Route::resource("Anoncement",AnnouncementController::class);
    Route::delete("delAnoncement/{id}",[AnnouncementController::class,'delete'])->name("Anoncement.delete");
    Route::get("user/{id}/delete",[UserController::class,'destroy'])->name("user.delete");

    Route::get("/admin/profile",[UserController::class ,'indexx'])->name('admin.indexx');
    Route::put("/admin/profilee",[UserController::class ,'updateProfilee'])->name('admin.updateProfilee');


    Route::post("order/{id}",[OrderController::class,'updateStatus'])->name("order.updateStatus") ;
    Route::get("/Home",[HomeController::class,'HomeInfo'])->name("HomeStatstic.info");
    Route::get("/Home/Mony",[HomeController::class,'HomeMony'])->name("HomeMony.HomeMony");
    Route::get("recentOrder",[HomeController::class,'recentOrder'])->name("recent.order");

    Route::resource('sub_category',SubbCategory::class);
    Route::resource('offers',OfferController::class);
    Route::get("offerindex",[OfferController::class,'indexx'])->name("offer.indexx");
    Route::get('sub_categoryy/{id}',[SubbCategory::class,'showw'])->name("sub_category.showw");
    Route::get('sub_category/{id}/delete',[SubbCategory::class,'destroy'])->name("sub_category.delete");
  Route::apiResource('color', ColorController::class);
    Route::get("colors",[ColorController::class,"create"])->name("color.create");
    Route::get("colors/{id}",[ColorController::class,"edit"])->name("color.edit");
    Route::get("deletenotfy",[UserController::class,'deletenotfy'])->name("notfy.deletenotfy");
    Route::get("deleteMessage/{id}",[UserController::class,'deleteMessage'])->name("admin.deleteMessage");
    Route::get("deleteAllMessage",[UserController::class,'deleteAllMessage'])->name("admin.deleteAllMessage");

        Route::view('notes','admin.notes');
        Route::apiResource("getways",getwaysController::class);
    Route::get("getway",[getwaysController::class,"create"])->name("getway.create");
    Route::get("getway/{id}",[getwaysController::class,"edit"])->name("getway.edit");
     Route::post('send',[PushNotificationController::class, 'bulksend'])->name('bulksend');
    Route::get('message', [PushNotificationController::class, 'message'])->name("admin.message");
    Route::get('get-notification-form', [PushNotificationController::class, 'create'])->name("admin.get-notification-form");

});

