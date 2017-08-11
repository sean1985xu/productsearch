<?php

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

Route::get('/', function () {
    return redirect('product/category-input');
});

Route::get('product/category-input', 'ProductController@categoryInput');

Route::get('product/category-search', 'ProductController@categorySearch');

Route::get('product/subcategory-search/{category}/{subcategory}', 'ProductController@subcategorySearch');
Route::get('product/subcategory-search/{category}/{subcategory}/pages/{page}', 'ProductController@subcategorySearch');
