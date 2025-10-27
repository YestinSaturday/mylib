<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
Route::get('/library/create', [LibraryController::class, 'create'])->name('library.create');
Route::post('/library', [LibraryController::class, 'store'])->name('library.store');
Route::get('/library/{book}', [LibraryController::class, 'show'])->name('library.show');
Route::get('/library/{book}/edit', [LibraryController::class, 'edit'])->name('library.edit');
Route::put('/library/{book}', [LibraryController::class, 'update'])->name('library.update');
Route::delete('/library/{book}', [LibraryController::class, 'destroy'])->name('library.destroy');
