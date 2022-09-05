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



// post Form Show 0.1
Route::get('/post', [App\Http\Controllers\Dashboard::class, 'index'])->middleware(['auth'])->name('post_index');
// post Form Show

// Submit post start 0.2
Route::post('/post', [App\Http\Controllers\Dashboard::class, 'create'])->middleware(['auth'])->name('post-create');
// Submit post end



// Dashbord all data shows Start 1
Route::get('/all-data-show', [App\Http\Controllers\Dashboard::class, 'allDataShowContr'])->middleware(['auth'])->name('show_post');
// Dashbord all data shows End
// soft delete data show Start 2
Route::get('/show-soft-delete-data', [App\Http\Controllers\Dashboard::class, 'showDeletePost'])->middleware(['auth'])->name('show_delete_post');
// soft delete data show End

// all data edit START 1.1
Route::get('/edit/post/{id}', [App\Http\Controllers\Dashboard::class, 'editPostContro'])->middleware(['auth'])->name('edit-post'); 
// all data edit END

// all Edit post UPDATE 
Route::put('/edit/post/{id}', [App\Http\Controllers\Dashboard::class, 'updatePostContro'])->middleware(['auth'])->name('update-post'); 
// all Edit post UPDATE 


// Dashbord all data shows 3 | All data soft delete START
Route::get('/soft-delete/{id}', [App\Http\Controllers\Dashboard::class, 'softDeleteProduct'])->middleware(['auth'])->name('delete-post'); 
// Dashbord all data shows 3 | All data soft delete END

//4
Route::get('/restor_dashboard/{id}', [App\Http\Controllers\Dashboard::class, 'restorData'])->middleware(['auth'])->name('restor-data');
Route::get('/permanent_delete/{id}', [App\Http\Controllers\Dashboard::class, 'pDeleteData'])->middleware(['auth'])->name('permanent-delete');


require __DIR__.'/auth.php';
