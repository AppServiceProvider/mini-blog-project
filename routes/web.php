<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;

Route::get('/', function () {
    $post= Post::paginate(15);
    return view('welcome',['post'=>$post]);
    // return view('welcome');
    
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
