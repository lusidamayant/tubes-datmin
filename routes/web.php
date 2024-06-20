<?php

use App\Http\Controllers\studentController;
use App\Http\Controllers\KMeansController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('student', StudentController::class);
Route::get('/kmeans', [KMeansController::class, 'index']);


// Route::get('/student/tambah', [studentController::class, 'create']);
// Route::post('/student/store', [studentController::class, 'store']);
// Route::get('/student/edit/{id}', [studentController::class, 'edit']);
// Route::put('/student/update/{id}', [studentController::class, 'update']);
// Route::get('/student/hapus/{id}', [studentController::class, 'delete']);
// Route::get('/student/destroy/{id}', [studentController::class, 'destroy']);
