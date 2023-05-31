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

Route::get('/', function () { return view('about'); });
Route::get('/login', function () { return view('auth'); });
Route::get('/register', function () { return view('register'); });
Route::get('/catalog', function () { return view('catalog'); })->middleware("auth");
Route::post('/getProduct/by/filter',[\App\Http\Controllers\ProductController::class, 'filter'])->middleware("auth");


Route::post("/login/api", [\App\Http\Controllers\AuthController::class, 'loginUser']);
Route::post("/register/api", [\App\Http\Controllers\AuthController::class, 'registerUser']);
Route::get("/logout", function (){ auth()->logout(); return redirect("/"); });

Route::get('/dashboard/login', function () { return view('admin.auth'); });
Route::post('/dashboard/attempt/log', [\App\Http\Controllers\AuthController::class, 'loginAdmin']);
Route::post('/dashboard/attempt/reg',[\App\Http\Controllers\AuthController::class, 'registrateAdmin']);
Route::get("/dashboard/getCategories", [\App\Http\Controllers\CategoryController::class, "getCategories"]);
Route::get("/dashboard/getManufactures", [\App\Http\Controllers\ManufacturesController::class, "getManufactures"]);


Route::group(['middleware' => 'admin', 'prefix' => 'dashboard'], function () {

    Route::get('/', function () { return view('admin.dashboard'); });
    Route::get('/category', function () { return view('admin.category'); });
    Route::get('/manufactures', function () {return view('admin.manufactures'); });
    Route::get('/products', function () { return view('admin.product.products'); });


    Route::post("/saveCategory" , [\App\Http\Controllers\CategoryController::class, "saveCategory"]);

    Route::get("/deleteCategory/{id}", [\App\Http\Controllers\CategoryController::class,"deleteCategory"]);


    Route::post("/saveManufacture" , [\App\Http\Controllers\ManufacturesController::class, "saveManufacture"]);

    Route::get("/deleteManufacture/{id}", [\App\Http\Controllers\ManufacturesController::class,"deleteManufacture"]);

    Route::post("/saveProduct",[\App\Http\Controllers\ProductController::class,"saveProduct"]);
    Route::get("/getProducts",[\App\Http\Controllers\ProductController::class,"getProduct"]);
    Route::get("/deleteProduct/{id}",[\App\Http\Controllers\ProductController::class,'deleteProduct']);

});

