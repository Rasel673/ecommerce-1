<?php

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
    return $request->user();
});
///admin login register-----------------
Route::post('/register','AuthorApiController@register');
Route::post('/login','AuthorApiController@login');

///category route--------------------------------------
Route::get('/showCategories','CategoriesController@showCategories');
Route::get('/allCategories','CategoriesController@allCategories');
Route::post('/addCategories','CategoriesController@addCategories');
Route::post('/updateCategories','CategoriesController@updateCategories');
Route::delete('/deleteCategories/{cat_id}','CategoriesController@deleteCategories');
Route::post('/singleCategories','CategoriesController@singleCategories');
////subcategory route-----------------------------
Route::get('/showSubcategories','SubcategoriesController@showSubcategories');
Route::get('/allSubcategories','SubcategoriesController@allSubcategories');
Route::post('/addSubcategories','SubcategoriesController@addSubcategories');
Route::post('/updateSubcategories','SubcategoriesController@updateSubcategories');
Route::delete('/deleteSubcategories/{sub_id}','SubcategoriesController@deleteSubcategories');
Route::post('/singleSubcategories','SubcategoriesController@singleSubcategories');
///brand route here---------------------------------
Route::get('/showBrands','BrandController@showBrands');
Route::get('/allBrands','BrandController@allBrands');
Route::post('/addBrands','BrandController@addBrands');
Route::post('/updateBrands','BrandController@updateBrands');
Route::delete('/deleteBrands/{b_id}','BrandController@deleteBrands');
Route::post('/singleBrands','BrandController@singleBrands');
////product route here----------------------------------
Route::get('/showProducts','ProductController@showProducts');
Route::get('/allProducts','ProductController@allProducts');
Route::post('/addProducts','ProductController@addProducts');
Route::post('/updateProducts','ProductController@updateProducts');
Route::delete('/deleteProducts/{id}','ProductController@deleteProducts');
Route::post('/singleProducts','ProductController@singleProducts');
Route::get('/singleView/{id}','ProductController@singleView');
