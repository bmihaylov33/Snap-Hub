<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PhotoController::class, 'home'])->name('home');
Route::get('/home', [PhotoController::class, 'home'])->name('home');

Route::get('/admin/home', [PhotoController::class, 'adminHome'])->name('admin.home');

Route::get('/admin/register', [AdminController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos');
Route::get('/photos/{photo}', [PhotoController::class, 'getPhoto'])->name('photo.index');
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photo.destroy');
Route::get('/photo/upload', [PhotoController::class, 'showUploadForm'])->name('photo.upload.form');
Route::post('/photo/upload', [PhotoController::class, 'upload'])->name('photo.upload');

Route::post('/photos/{photo}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{user}/photos', [UserController::class, 'photos'])->name('users.photos');

Route::get('/contacts', [ContactController::class, 'showForm'])->name('contacts');
Route::post('/contacts', [ContactController::class, 'submitForm'])->name('contacts.upload');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/', [PhotoController::class, 'adminHome'])->name('admin.home');
// });

require __DIR__.'/auth.php';
