<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
    Route::delete('/{contact}/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::get('/{contact}/show-more', [ContactController::class, 'showMore'])->name('contact.show-more');
    Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{contact}/update', [ContactController::class, 'update'])->name('contact.update');
});

require __DIR__.'/auth.php';
