<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);

Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');


Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Show the form for creating a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Store a newly created product in the database
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Show the form for editing a specific product
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Update the specified product in the database
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Remove the specified product from the database
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/search','ProductController@search');



Auth::routes();

Route::get('/auth/login', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/auth/register', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/auth/verify', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();


Auth::routes(
    [
        'verify' => true,
    ]
);


// Route::middleware(['auth', 'message'])->group(function () {
//     Route::resource('products', ProductController::class)->except(['index']); // Excluding index
//     Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

Route::get('/login', function () {
    // This route should render the login page
    return view('/auth/login');
})->name('login');

