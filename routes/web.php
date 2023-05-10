<?php

use App\Models\User;
use Ghasedak\GhasedakApi;
use App\Notifications\OTPSms;
use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\Admin\TagController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\CartController;
use App\Http\controllers\Home\HomeController;
use App\Http\Controllers\Home\ShopController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Home\SearchController;
use App\Http\controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Home\CompareController;
use App\Http\Controllers\Home\PaymentController;
use App\Http\Controllers\Home\ProfileController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\controllers\Admin\ProductController;
use App\Http\Controllers\Home\WishListController;
use App\Http\controllers\Admin\CategoryController;
use App\Http\controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SearchUserController;
use App\Http\Controllers\Home\UserAddressController;
use App\Http\Controllers\home\UserProfileController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\controllers\Admin\ProductImageController;
use App\Http\Controllers\Home\CommentController as HomeCommentController;
use App\Http\Controllers\Home\ProductController as HomeProductController;
use App\Http\Controllers\Home\CategoryController as HomeCategoryController;



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

Route::get('/admin-panel/dashboard',[AdminController::class , 'index'])->name('dashboard')->middleware(['role:admin']);

// ADMIN_PANEL
Route::prefix('admin-panel/management')->name('Admin.')->middleware(['role:admin|seller'])->group(function(){
    Route::resource('brands', BrandController::class);
    Route::resource('contactUs', ContactUsController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('products', ProductController::class)->middleware(['role:admin|seller']);
    Route::resource('banners', BannerController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class)->middleware(['role:admin']);
    Route::resource('permissions', PermissionController::class)->middleware(['role:admin']);
    Route::resource('roles', RoleController::class)->middleware(['role:admin']);
    Route::get('/search-user' , [SearchUserController::class , 'searchUser'])->name('search.user');


    Route::get('/comments/{comment}/change_approve' , [CommentController::class , 'changeApprove'])->name('comments.change_approve')->middleware(['role:admin']);

    //GET CATEGORY ATTRIBUTES
    Route::get('/category-attributes/{category}' , [CategoryController::class , 'getCategoryAttributes'])->middleware(['role:admin']);

    //edit product image
    Route::get('/products/{product}/images-edit' , [ProductImageController::class , 'edit'])->name('products.images.edit');
    Route::delete('/products/{product}/images-destroy' , [ProductImageController::class , 'destroy'])->name('products.images.destroy');
    Route::put('/products/{product}/images-set-primary' , [ProductImageController::class , 'setPrimary'])->name('products.images.set_primary');
    Route::post('/products/{product}/images-add' , [ProductImageController::class , 'add'])->name('products.images.add');

    //edit category
    Route::get('/products/{product}/category-edit' , [ProductController::class , 'editCategory'])->name('products.category.edit');
    Route::put('/products/{product}/category-update' , [ProductController::class , 'updateCategory'])->name('products.category.update');

});

//HOME
Route::get('/' , [HomeController::class , 'index'])->name('home.index');
Route::get('/categories/{category:slug}' , [HomeCategoryController::class , 'show'])->name('home.categories.show');
Route::get('/products/{product:slug}' , [HomeProductController::class , 'show'])->name('home.products.show');
Route::post('/comments/{product}' , [HomeCommentController::class , 'store'])->name('home.comments.store');

//WISH LIST
Route::get('/add_to_wishlist/{product}' , [WishListController::class , 'add'])->name('home.wishlist.add');
Route::get('/remove_to_wishlist/{product}' , [WishListController::class , 'remove'])->name('home.wishlist.remove');

//COMPARE
Route::get('/compare' , [CompareController::class , 'index'])->name('home.compare.index');
Route::get('/add_to_compare/{product}' , [CompareController::class , 'add'])->name('home.compare.add');
Route::get('/remove_from_compare/{product}' , [CompareController::class , 'remove'])->name('home.compare.remove');

//CART
Route::get('/cart' , [CartController::class , 'index'])->name('home.cart.index');
Route::post('/add_to_cart' , [CartController::class , 'add'])->name('home.cart.add');
Route::get('/remove_from_cart/{rowId}' , [CartController::class , 'remove'])->name('home.cart.remove');
Route::put('/cart' , [CartController::class , 'update'])->name('home.cart.update');
Route::get('/clear_cart' , [CartController::class , 'clear'])->name('home.cart.clear');
Route::post('/check_coupon' , [CartController::class , 'checkCoupon'])->name('home.coupons.check');
Route::get('/checkout' , [CartController::class , 'checkout'])->name('home.orders.checkout');

Route::post('/payment' , [PaymentController::class , 'payment'])->name('home.payment');
Route::get('/payment-verify/{gatewayName}' , [PaymentController::class , 'paymentVerify'])->name('home.payment_verify');

//LOGIN
Route::any('/login' , [AuthController::class , 'login'])->name('login');
Route::any('/logout' , [AuthController::class , 'logout'])->name('logout');
Route::post('/check-otp' , [AuthController::class , 'checkOtp']);
Route::post('/resend-otp' , [AuthController::class , 'resendOtp']);

Route::get('/search' , [SearchController::class , 'search'])->name('search');

//PROFILE
Route::prefix('profile')->name('home.')->group(function(){

    Route::get('/' , [UserProfileController::class , 'index'])->name('users_profile.index');
    Route::post('/profiles' , [ProfileController::class , 'update'])->name('profile.update');
    Route::post('/password' , [ProfileController::class , 'updatePassword'])->name('profile.update.password');

    Route::get('/comments' , [HomeCommentController::class , 'usersProfileIndex'])->name('comments.users_profile.index');

    Route::get('/wishlist' , [WishListController::class , 'usersProfileIndex'])->name('wishlist.users_profile.index');

    Route::get('/addresses' , [UserAddressController::class , 'index'])->name('addresses.index');
    Route::post('/addresses' , [UserAddressController::class , 'store'])->name('addresses.store');
    Route::put('/addresses/{address}' , [UserAddressController::class , 'update'])->name('addresses.update');

    Route::get('/orders' , [CartController::class , 'usersProfileIndex'])->name('orders.users_profile.index');

});

Route::get('/get-province-cities-list' , [UserAddressController::class , 'getProvinceCitiesList']);

Route::get('/about-us' , [HomeController::class , 'aboutUs'])->name('home.about-us');
Route::get('/contact-us' , [HomeController::class , 'contactUs'])->name('home.contact-us');
Route::post('/contact-us-form' , [HomeController::class , 'contactUsForm'])->name('home.contact-us.form');


