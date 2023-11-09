<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;

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
// route for landing page
Route::get('/', function () {
    return view('welcome');
});

//route for jetstream auth
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});

//route for viewing category page
Route::get('/all/category', [CategoryController::class, 'Index'])->name('display.category');

//route for adding new category
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('insert.category');
//route for editing existing category
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
//route for updating categories
Route::post('/category/update/{id}', [CategoryController::class, 'Update'])->name('update.category');