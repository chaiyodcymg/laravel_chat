<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UploadProfileController;
use App\Http\Controllers\FeedNewsController;
use App\Http\Controllers\OtherUserController;
use App\Http\Controllers\WritePostController;
use App\Http\Controllers\ProfilePostsController;
use App\Http\Controllers\DeletePostController;
use App\Http\Controllers\ListFollowController;
use App\Http\Livewire\Messages;
use App\Http\Controllers\EditController;


// Route::prefix('login')->group(function () {

// Route::get('/login', function () {
//     return redirect('/');
// })->name('login');
// Route::get('/', function () {
//     return view('auth.register');
// });
// });

//  Route::get('/page', function () {
//         return view('testpage');
//     });
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/', [FeedNewsController::class,'index'])->name('feed'); 
  
    Route::get('/chat', function () {
         return view('messages');
    })->name('chat');



    Route::get('/otheruser{user_id}',[OtherUserController::class,'index'])->name('otheruser');
    
    Route::post('/write_post',[WritePostController::class,'submit_post'])->name('write_post'); 
  
    Route::get('/profile',[ProfilePostsController::class,'profile_post'])->name('profile'); 
    
    // Route::post('/upload-profile', [UploadProfileController::class, 'upload'])->name('upload');
    // Route::view('chat','users.messages');
    // Route::get('/user_id', 'UserController@index')->name('post.index');
    Route::get('/delete/{id}', [DeletePostController::class,'delete'])->name('delete');

    // Route::get('/delete-comment/{id}', [DeleteCommentController::class,'delete_comment'])->name('delete-comment');
    // {{route('delete', ['id'=> Crypt::encryptString($post->id)]);}}
    Route::get('/chat{id}', Messages::class)->name('userchat');

    Route::get('/follow/{id}',[ListFollowController::class,'follow1'])->name('follow');
    Route::post('/upload', [UploadProfileController::class, 'upload'])->name('upload'); 

    Route::post('/comment_post',[WritePostController::class,'comment_post'])->name('comment_post');
    Route::post('/edit{id}',[EditController::class,'editpost'])->name('edit');

});
