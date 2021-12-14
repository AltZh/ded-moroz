<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('user.auth');
Route::post('/register', [LoginController::class, 'register'])->name('user.register');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');

Route::get('/about/{numb?}', function($numb = null){
    return view('about', ['n' => $numb]);
})->name('about');

Route::get('/letters_list', [HomeController::class, 'letters_list'])->name('letters.list');
Route::get('/my_letters_list', [HomeController::class, 'my_letters_list'])->name('letters.list.my');

Route::get('/letter_compose', [HomeController::class, 'letter_compose'])->name('letter.compose')->middleware('auth');
Route::post('/letter_compose', [HomeController::class, 'letter_create'])->name('letter.send')->middleware('auth');
Route::get('/letter_edit/{id}', [HomeController::class, 'letter_edit'])->name('letter.edit')->middleware('auth');
Route::post('/letter_update/{id}', [HomeController::class, 'letter_update'])->name('letter.update')->middleware('auth');

Route::get('/letter_response/{id}', [HomeController::class, 'letter_response'])->name('letter.response')->middleware('auth');
Route::post('/letter_response/{id}', [HomeController::class, 'letter_send_response'])->name('letter.response.send')->middleware('auth');
Route::post('/letter_add_gift/{id}', [HomeController::class, 'letter_add_gift'])->name('letter.add_gift')->middleware('auth');

Route::get('/letter_view/{id}', [HomeController::class, 'letter_view'])->name('letter.view')->middleware('auth');
//Route::get('/letter_view/{id}', [HomeController::class, 'letter_view']);
//Route::post('/letter_view/{id}', [HomeController::class, 'letter_update']);

//CRUD
//Create
//Add
//Save
//View
//Update
//Delete
//Destroy