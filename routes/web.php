<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::prefix('admin')->group(function (){
   Route::get('login',[AuthController::class,'login'])->name('admin.auth.login');
   Route::post('login',[AuthController::class,'checkLogin'])->name('admin.auth.check-login');
});

Route::prefix('admin')->middleware('admin.login')->group(function (){
    Route::get('/logout',[AuthController::class,'logout'])->name('admin.logout');
    Route::get('/profile',[AuthController::class,'profile'])->name('admin.profile');
    Route::put('/profile',[AuthController::class,'updateProfile'])->name('admin.profile.update');
   Route::prefix('category')->group(function (){

       Route::get('',[CategoryController::class,'index'])->name('admin.category.index');

       Route::get('create',[CategoryController::class,'create'])->name('admin.category.create');
       Route::post('store',[CategoryController::class,'store'])->name('admin.category.store');

       Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
       Route::put('/update/{id}',[CategoryController::class,'update'])->name('admin.category.update');

       Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');

   }) ;
    Route::prefix('post')->group(function (){
        Route::get('',[PostController::class,'index'])->name('admin.post.index');

        Route::get('create',[PostController::class,'create'])->name('admin.post.create');
        Route::post('store',[PostController::class,'store'])->name('admin.post.store');

        Route::get('/edit/{id}',[PostController::class,'edit'])->name('admin.post.edit');
        Route::put('/update/{id}',[PostController::class,'update'])->name('admin.post.update');

        Route::get('/delete/{id}',[PostController::class,'delete'])->name('admin.post.delete');

    }) ;
    Route::prefix('contact')->group(function (){
        Route::get('',[ContactController::class,'index'])->name('admin.contact.index');
        Route::get('/delete/{id}',[ContactController::class,'delete'])->name('admin.contact.delete');

    }) ;

    Route::prefix('user')->group(function (){
        Route::get('',[UserController::class,'index'])->name('admin.user.index');

        Route::get('create',[UserController::class,'create'])->name('admin.user.create');
        Route::post('store',[UserController::class,'store'])->name('admin.user.store');

        Route::get('/edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
        Route::put('/update/{id}',[UserController::class,'update'])->name('admin.user.update');

        Route::get('/delete/{id}',[UserController::class,'delete'])->name('admin.user.delete');

    }) ;
});



    Route::get('/', [WebController::class, 'home'])->name('web.home');
    Route::get('category', [WebController::class, 'category']);
    Route::get('category/{slug}', [WebController::class, 'categorySlug'])->name('web.category');
    Route::get('post/{slug}', [WebController::class, 'post'])->name('web.post');
    Route::post('post/comment/{id}', [WebController::class, 'comment'])->name('web.post.comment');
    Route::get('contact', [WebController::class, 'contact'])->name('web.contact');
    Route::post('contact', [WebController::class, 'sendContact'])->name('web.contact.store');

    Route::get('login', [LoginController::class, 'formLogin'])->name('web.login');
    Route::post('login', [LoginController::class, 'checkLogin'])->name('web.auth.login');
    Route::post('logout', [LoginController::class, 'checkLogout'])->name('web.auth.logout');
    Route::get('register', [LoginController::class, 'formRegister'])->name('web.register');
    Route::post('register', [LoginController::class, 'checkRegister'])->name('web.auth.register');


