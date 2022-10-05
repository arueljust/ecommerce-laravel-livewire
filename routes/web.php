<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\FrontEndController;
use App\Http\Livewire\Frontend\Ongkir\TambahOngkir;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route Frontend
Route::controller(FrontEndController::class)->group(function(){
Route::get('/','index');
Route::get('/category','category');
Route::get('/category/{category_slug}','product');
Route::get('/category/{category_slug}/{product_slug}','productView');
Route::get('/new-arrival','newArrival');
Route::get('/featured-product','featuredProduct');

Route::middleware(['auth'])->group(function(){
    Route::get('wishlist',[WishlistController::class,'index']);
    Route::get('cart',[CartController::class,'index']);
    Route::get('checkout',[CheckOutController::class,'index']);
    Route::get('order',[OrderController::class,'index']);
    Route::get('order/{ordeId}',[OrderController::class,'show']);

});

Route::get('thank-you',[FrontEndController::class,'thankyou']);


// Frontend Product Livewire
Route::get('/product/{product_slug}',App\Http\Livewire\FrontEnd\Product\Index::class);

});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin Route
Route::prefix('admin')->middleware('auth','isAdmin')->group(function(){
    Route::get('dashboard',[DashboardController::class,'index']);
    Route::get('setting',[SettingController::class,'index']);
// Route Slider
Route::controller(SliderController::class)->group(function(){
    Route::get('slider','index');
    Route::get('slider/create','create');
    Route::post('/slider','store');
    Route::get('/slider/{slider}/edit','edit');
    Route::put('/slider/{slider}','update');
    Route::get('/slider/{slider}','destroy');
    });

// Route Category
Route::controller(CategoryController::class)->group(function(){
    Route::get('/category','index');
    Route::get('/category/create','create');
    Route::post('/category','store');
    Route::get('/category/{category}/edit','edit');
    Route::put('/category/{category}','update');
    });

// Route Product
Route::controller(ProductController::class)->group(function(){
    Route::get('/product','index');
    Route::get('/product/create','create');
    Route::post('/product','store');
    Route::get('/product/{product}/edit','edit');
    Route::put('/product/{product}','update');
    Route::get('/product/{product_id}/delete','destroy');

    Route::post('product-color/{prod_color_id}','updateProdColorQty');
    Route::get('product-image/{product_image_id}/delete','destroyImage');
    });

// Route Color
Route::controller(ColorController::class)->group(function(){
    Route::get('/color','index');
    Route::get('/color/create','create');
    Route::post('/color','store');
    Route::get('/color/{color}','edit');
    Route::put('/color/{color_id}','update');
    Route::get('/color/{color_id}/delete','destroy');
   });
// Route Order/Transaction
Route::controller(AdminOrderController::class)->group(function(){
    Route::get('order','index');
    Route::get('order/{orderId}','show');
    Route::put('order/{orderId}','updateOrderStatus');
    Route::get('invoice/{orderId}','viewInvoice');
    Route::get('invoice/{orderId}/generate','downloadInvoice');

   });

// Route Brand
Route::get('/brand',App\Http\Livewire\Admin\Brand\Index::class);
});


