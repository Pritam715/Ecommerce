<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubsubcategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\CartController;


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
Auth::routes();
//Ckeditor
Route::post('ckeditor', [CKEditorController::class,'upload'])->name('upload');


Route::get('/',[FrontendController::class,'index'])->name('outtdoor');
Route::match(['get','post'],'dp/{slug}',[FrontendController::class,'details'])->name('product-details');
Route::get('size',[FrontendController::class,'findsize']);

//Wishlist
Route::post('wishlist',[FrontendController::class,'wishlist'])->name('wishlist');


//Cart
Route::get('view-cart',[FrontendController::class,'allcart'])->name('view.cart');
Route::post('cart',[FrontendController::class,'cart'])->name('cart');




//Frontend///
//Route::group(['middleware'=>['auth:customer']],function()
//{

  Route::match(['get','post'],'/login-register',[CustomerController::class,'account'])->name('customer.login');
  Route::get('/customer-logout',[CustomerController::class,'logout'])->name('customer.logout');
//});











//Admin Route///
Route::group(['middleware'=>['auth']],function()
{

  Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

///UserController///
Route::resource('user', UserController::class);
Route::resource('roles', RoleController::class);
Route::get('roles/delete/{id}',[RoleController::class,'delete'])->name('roles.delete');


///Category//
Route::get('main_category',[CategoryController::class,'index'])->name('main_category');
Route::post('main_category/store',[CategoryController::class,'store'])->name('main_category.store');
Route::put('main_category/update/{id}',[CategoryController::class,'update'])->name('main_category.update');
Route::get('main_category/delete/{id}',[CategoryController::class,'delete'])->name('main_category.delete');
Route::post('update-category-status',[CategoryController::class,'updatestatus']);


///Sub Category///
Route::get('sub_category',[SubCategoryController::class,'index'])->name('sub_category');
Route::post('sub_category/store',[SubCategoryController::class,'store'])->name('sub_category.store');
Route::put('sub_category/update/{id}',[SubCategoryController::class,'update'])->name('sub_category.update');
Route::get('sub_category/delete/{id}',[SubCategoryController::class,'delete'])->name('sub_category.delete');
Route::post('update-subcategory-status',[SubCategoryController::class,'updatestatus']);

//Sub SubCategory///
Route::get('sub_subcategory',[SubsubcategoryController::class,'index'])->name('sub_subcategory');
Route::post('sub_subcategory/store',[SubsubcategoryController::class,'store'])->name('sub_subcategory.store');
Route::put('sub_subcategory/update/{id}',[SubsubcategoryController::class,'update'])->name('sub_subcategory.update');
Route::get('sub_subcategory/delete/{id}',[SubsubcategoryController::class,'delete'])->name('sub_subcategory.delete');
Route::post('update-sub_subcategory-status',[SubsubcategoryController::class,'updatestatus']);

//Find Categories
Route::get('/findsubcategory',[SubsubcategoryController::class,'findSubcategory']);
Route::get('/findsubsubcategory',[SubsubcategoryController::class,'findSubsubcategory']);

//Brand
Route::get('brand',[BrandController::class,'index'])->name('brand');
Route::post('brand/store',[BrandController::class,'store'])->name('brand.store');
Route::put('brand/update/{id}',[BrandController::class,'update'])->name('brand.update');
Route::post('update-brand-status',[BrandController::class,'updatestatus']);
Route::get('brand/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');


//Banner
Route::get('banners',[BannerController::class,'index'])->name('banner.index');
Route::post('banners/store',[BannerController::class,'store'])->name('banners.store');
Route::post('update-banner-status',[BannerController::class,'updatestatus']);
Route::put('banners/update/{id}',[BannerController::class,'update'])->name('banners.update');
Route::get('banners/delete/{id}',[BannerController::class,'delete'])->name('banners.delete');

//Products
Route::get('products',[ProductController::class,'index'])->name('product.index');
Route::get('addproduct',[ProductController::class,'add'])->name('product.add');
Route::get('editproduct/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::post('products/store',[ProductController::class,'store'])->name('product.store');
Route::post('products/update/{id}',[ProductController::class,'update'])->name('product.update');
Route::get('product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
Route::post('update-product-status',[ProductController::class,'updatestatus']);
Route::post('update-featured-status',[ProductController::class,'featured']);

//AddImages

Route::match(['get','post'],'add-images/{id}',[ProductController::class,'addimage'])->name('product-image');
Route::get('delete/images/{id}',[ProductController::class,'deleteimages']);

//AddAttributes
Route::match(['get','post'],'product-color/{id}',[ProductController::class,'addcolor'])->name('product-color');
Route::match(['get','post'],'add-attributes/{id}',[ProductController::class,'addattributes'])->name('product-attributes');
Route::get('deleteattribute/{id}',[ProductController::class,'deleteattribute']);
Route::match(['get','post'],'editattribute/{id}',[ProductController::class,'editattribute']);


});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
