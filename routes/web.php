<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
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

// Auth routes
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //Dashboard Routes
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/password', [ProfileController::class, 'updatePasswordProfile'])->name('password.profile.update');

    //Books Routes
    Route::resource('books', BookController::class);
    Route::resource('/generateBills', BillController::class);
    Route::get('book/records' , [BookController::class, 'records'])->name('book.records');

    Route::get('/print/{name}',    [PdfController::class, 'print'])->name('publication.print');


    //Bills Routes
    Route::resource('bills', BillController::class);

    //Publication Controller
    Route::resource('publications', PublicationController::class);
    Route::get('/publications/records' , [PublicationController::class , 'random'])->name('publications.records');


});
