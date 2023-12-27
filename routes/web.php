<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginRegisterController;


 
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
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
   return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/register', [App\Http\Controllers\Auth\LoginRegisterController::class, 'register'])->name('register');
    Route::post('/store', [App\Http\Controllers\Auth\LoginRegisterController::class, 'store'])->name('store');
    Route::get('/login', [App\Http\Controllers\Auth\LoginRegisterController::class, 'login'])->name('login');
    Route::post('/authenticate', [App\Http\Controllers\Auth\LoginRegisterController::class, 'authenticate'])->name('authenticate');
    Route::get('/dashboard', [App\Http\Controllers\Auth\LoginRegisterController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [App\Http\Controllers\Auth\LoginRegisterController::class, 'logout'])->name('logout');
    //Route::get('/employees', [App\Http\Controllers\Auth\EmployeeController::class, 'index'])->name('employees');

});

//For After Login
Route::get('/employees', 'EmployeeController@index')->name('employees.index');



Route::resource('employees', App\Http\Controllers\EmployeeController::class);

//Filter or Drop Down
Route::get('employees-index', 'App\Http\Controllers\EmployeeController@index');

// search option
//Route::get('/', 'App\Http\Controllers\SearchController@index');
//Route::get('/search','App\Http\Controllers\SearchController@search');

//Filter
 //Route::get('/', 'App\Http\Controllers\FilterController@index');
 //Route::get('/filter','App\Http\Controllers\FilterController@filter');






