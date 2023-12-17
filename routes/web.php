<?php

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
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannersController;
use App\Http\Controllers\Front\IndexController;
use App\Models\Category;
//use App\Http\Controllers;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::prefix("/admin")->namespace("Admin")->group(function(){
    Route::match(['get','post'],'/',[AdminController::class,'login']);

    Route::group(["middleware" => ["admin"]],function(){
        Route::get('/dashboard',[AdminController::class,'dashboard']);
        Route::get('/logout',[AdminController::class,'logout'])->name("admin.logout");
        Route::get('/settings',[AdminController::class,'settings'])->name("admin.settings");
        Route::post('/currentpwd',[AdminController::class,'currentPwd'])->name("admin.currentpwd");
        Route::post('/updatecurrentpwd',[AdminController::class,'updateCurrentPwd'])->name("admin.updatepwd");
        Route::match(['get','post'],'/updateAdminDetails',[AdminController::class,'updateAdminDetails'])->name("admin.updateAdminDetails");
        
        //sections
        Route::get('/sections',[SectionController::class,'sections'])->name("admin.sections");
        Route::post('/update-status',[SectionController::class,'updateStatus'])->name("admin.update-status");

        //Brands
        Route::post('/update-brand-status',[BrandController::class,'updateBrandStatus'])->name("admin.update-brand-status");
        Route::match(['get','post'],'/add-update-brands/{id?}',[BrandController::class,'addUpdateBrands'])->name("admin.add_edit_brands");
        Route::get('/brands',[BrandController::class,'getBrands'])->name("admin.brands");
        Route::get('/delete-brand/{id}',[BrandController::class,'deleteBrand'])->name('admin.delete-brand');

        //Banners
        Route::get('/banners',[BannersController::class,'index'])->name('admin.banners');
        Route::post('/update-banner-status',[BannersController::class,'updateBannerStatus'])->name("admin.update-banner-status");
        Route::match(['get','post'],'/add-edit-banner/{id?}',[BannersController::class,'addEditBanner'])->name("admin.add_edit_banners");
        // Route::get('/brands',[BrandController::class,'getBrands'])->name("admin.brands");
        Route::get('/delete-banner/{id}',[BannersController::class,'deleteBanner'])->name('admin.delete-banner');


        //categories
        Route::post('/append-categories-level',[CategoryController::class,'appendCategoriesLevel'])->name("admin.append-categories-level");
        Route::post('/update-category-status',[CategoryController::class,'updateStatus'])->name("admin.update-category-status");
        Route::get('/categories',[CategoryController::class,'categories'])->name("admin.categories");
        Route::match(['get','post'],'/add-edit-category/{id?}',[CategoryController::class,'addEditCategories'])->name("admin.add_edit_categories");
        Route::get('/delete-category-image/{id}',[CategoryController::class,'deleteCategoryImage'])->name('admin.delete-category-image');
        Route::get('/delete-category/{id}',[CategoryController::class,'deleteCategory'])->name('admin.delete-category');

        //products
        Route::get('/products',[ProductController::class,'products'])->name("admin.products");
        Route::post('/update-product-status',[ProductController::class,'updateStatus'])->name("admin.update-product-status");
        Route::match(['get','post'],'/add-edit-product/{id?}',[ProductController::class,'addEditProducts'])->name("admin.add_edit_products");
        Route::get('/delete-product-image/{id}',[ProductController::class,'deleteProductImage'])->name('admin.delete-product-image');
        Route::get('/delete-product-video/{id}',[ProductController::class,'deleteProductVideo'])->name('admin.delete-product-video');
        Route::get('/delete-product/{id}',[ProductController::class,'deleteProduct'])->name('admin.delete-product');

        // add product attribute
        Route::match(['get','post'],"/add-product-attribute/{id}",[ProductController::class,'addProductAttribute'])->name('admin.add-product-attribute');
        Route::post('/editAttribute',[ProductController::class,'editAttribute'])->name('admin.editAttribute');
        Route::post('/update-attribute-status',[ProductController::class,'updateAttributeStatus'])->name("admin.updateAttributeStatus");
        Route::get('/delete-product-attribute/{id}',[ProductController::class,'deleteProductAttribute'])->name('admin.deleteProductAttribute');
        Route::match(['get','post'],"/add-images/{id}",[ProductController::class,'addImages'])->name('admin.add-images');
        Route::post('/update-product-image-status',[ProductController::class,'updateImageStatus'])->name("admin.updateImageStatus");
        Route::get('/delete-product-image/{id}',[ProductController::class,'deleteProductImages'])->name('admin.deleteProductImage');
        

    });
});

Route::namespace("Front")->group(function(){
    Route::get('/',[IndexController::class,'index'])->name('listing');

    $urls = Category::select('url')->where('status',1)->pluck('url')->toArray();
    foreach($urls as $url){
        Route::get('/'.$url,[App\Http\Controllers\Front\ProductController::class,'listing']);
    }

    Route::post('/add-to-cart',[App\Http\Controllers\Front\ProductController::class,'addToCart'])->name("add-to-cart");
    Route::get('/product/{id}',[App\Http\Controllers\Front\ProductController::class,'detail']);
    Route::post('/get-product-price',[App\Http\Controllers\Front\ProductController::class,'getProductPrice'])->name('product-price');
    Route::get('/cart',[App\Http\Controllers\Front\ProductController::class,'cart']);

});