<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;

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

Route::get('/', function () {
    return view('frontEnd.welcome');
});

Auth::routes();


Route::get('management/login', 'Admin\Auth\AuthenticationController@loginPage')
        ->name('dashboard.loginPage')->middleware('goHome');
Route::post('management/login', 'Admin\Auth\AuthenticationController@login')->name('dashboard.login');
Route::post('management/logout', 'Admin\Auth\AuthenticationController@logout')->name('dashboard.logout');

Route::group(['middleware' => ['IsAdmin']], function () {
    
    //password expired
    Route::get('management/password/expired', 'Admin\Auth\AuthenticationController@expired')
        ->name('password.expired');
    Route::post('management/password/post_expired', 'Admin\Auth\AuthenticationController@postExpired')
        ->name('password.post_expired');


    // routes for management
    Route::group(['prefix' => 'management', 'middleware' => 'password_expired'], function () {
        //dashboard
        Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
        

        //managers/admins
        Route::get('/users', 'Admin\UsersController@list_users')->name('list_users');
        Route::get('/user/{id}/medias', 'Admin\UsersController@list_user_media')->name('list_user_media');
        Route::post('/user/{id}/delete', 'Admin\UsersController@delete_user')->name('delete_user');
        Route::get('/admins', 'Admin\UsersController@list_admins')->name('list_admins');
        Route::post('/admins/create', 'Admin\UsersController@add_admin')->name('add_admin');
        Route::get('/admins/{id}/permissions', 'Admin\UsersController@list_permissions')->name('list_permissions');
        Route::put('/admins/{id}/permissions', 'Admin\UsersController@update_permissions')->name('update_permissions');

        //categories
        Route::resource('categories', 'Admin\CategoriesController');

        //audios
        Route::get('/songs', 'Admin\SongsController@index')->name('songs.index');
        Route::get('/song/{id}', 'Admin\SongsController@show')->name('songs.show');
        Route::get('/song/{id}/edit', 'Admin\SongsController@edit')->name('songs.edit');
        Route::put('/song/{id}/update', 'Admin\SongsController@update')->name('songs.update');
        Route::get('/songs/upload', 'Admin\SongsController@create')->name('songs.create');
        Route::post('/songs/upload', 'Admin\SongsController@upload')->name('songs.upload');
    
        //videos
        Route::get('/videos', 'Admin\VideosController@index')->name('videos.index');
        Route::get('/video/{id}', 'Admin\VideosController@show')->name('videos.show');
        Route::get('/video/{id}/edit', 'Admin\VideosController@edit')->name('videos.edit');
        Route::put('/video/{id}/update', 'Admin\VideosController@update')->name('videos.update');
        Route::get('/videos/upload', 'Admin\VideosController@create')->name('videos.create');
        Route::post('/videos/upload', 'Admin\VideosController@upload')->name('videos.upload');

        //beats
        Route::get('/beats', 'Admin\BeatsController@index')->name('beats.index');
        Route::get('/beat/{id}', 'Admin\BeatsController@show')->name('beats.show');
        Route::get('/beat/{id}/edit', 'Admin\BeatsController@edit')->name('beats.edit');
        Route::put('/beat/{id}/update', 'Admin\BeatsController@update')->name('beats.update');
        Route::get('/beats/upload', 'Admin\BeatsController@create')->name('beats.create');
        Route::post('/beats/upload', 'Admin\BeatsController@upload')->name('beats.upload');
    });

});


//front end routes
Route::get('/', 'FrontEnd\HomeController@index')->name('frontend.index');

Route::get('/mp3-music', 'FrontEnd\MusicController@index')->name('frontend.music');
Route::get('/mp3-music/{id}', 'FrontEnd\MusicController@show')->name('frontend.music.show');
Route::get('/mp3-music/category/{category}', 'FrontEnd\MusicController@showByCategory')->name('frontend.music.showByCategory');
Route::get('/mp3-music/{id}/download', 'FrontEnd\MusicController@download')->name('frontend.music.download');
Route::post('/mp3-music/{id}/comment', 'FrontEnd\MusicController@comment')->name('frontend.music.comment');

Route::get('/beats', 'FrontEnd\BeatsController@index')->name('frontend.beats');
Route::get('/beats/{id}', 'FrontEnd\BeatsController@show')->name('frontend.beats.show');
Route::get('/beats/category/{category}', 'FrontEnd\BeatsController@showByCategory')->name('frontend.beats.showByCategory');
Route::get('/beats/{id}/download', 'FrontEnd\BeatsController@download')->name('frontend.beats.download');
Route::post('/beats/{id}/comment', 'FrontEnd\BeatsController@comment')->name('frontend.beats.comment');

Route::get('/videos', 'FrontEnd\VideosController@index')->name('frontend.videos');
Route::get('/videos/{id}', 'FrontEnd\VideosController@show')->name('frontend.videos.show');
Route::get('/videos/category/{category}', 'FrontEnd\VideosController@showByCategory')->name('frontend.videos.showByCategory');
Route::get('/videos/{id}/download', 'FrontEnd\VideosController@download')->name('frontend.videos.download');
Route::post('/videos/{id}/comment', 'FrontEnd\VideosController@comment')->name('frontend.videos.comment');

//store routes
Route::get('store/home', 'ShoppingController@index')->name('shop.index');
Route::get('store/beats', 'ShoppingController@beats')->name('shop.beats');
Route::get('store/beats/{id}', 'ShoppingController@singleBeat')->name('shop.beat.show');
Route::get('store/mp3-music', 'ShoppingController@music')->name('shop.mp3-music');
Route::get('store/mp3-music/{id}', 'ShoppingController@singleMusic')->name('shop.mp3-music.show');
Route::get('store/videos', 'ShoppingController@videos')->name('shop.videos');
Route::get('store/videos/{id}', 'ShoppingController@singleVideo')->name('shop.video.show');

//cart
Route::post('/store/add-to-cart', 'CartController@add_to_cart')->name('cart.add');
Route::get('/store/add-to-cart_rapid/{id}/{model}', 'CartController@add_to_cart_rapid')->name('cart.add.rapid');
Route::get('/store/cart-content', 'CartController@cart')->name('cart.items');
Route::get('/store/cart-content/{id}/add_quantity', 'CartController@cart_incr_qty')->name('cart.incr.item');
Route::get('/store/cart-content/{id}/reduce_quantity', 'CartController@cart_decr_qty')->name('cart.decr.item');
Route::get('/store/cart-content/remove/{id}', 'CartController@remove_from_cart')->name('cart.remove.item');

Route::get('/store/cart-checkout/all}', 'CheckoutController@index')->name('cart.checkout');
Route::post('/store/cart-checkout/all}', 'CheckoutController@pay')->name('cart.pay');

Route::get('/empty', function () {
    return \Cart::clear();
});

//logged in users
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'FrontEnd\HomeController@home');

    Route::get('/my_uploads/audios', 'FrontEnd\HomeController@myAudios')->name('myAudios');
    Route::get('/my_uploads/audio/create', 'FrontEnd\HomeController@myAudioCreate')->name('myAudioCreate');
    Route::post('/my_uploads/audio/upload', 'FrontEnd\HomeController@myAudioUpload')->name('myAudioUpload');

    Route::get('/my_uploads/videos', 'FrontEnd\HomeController@myVideos')->name('myVideos');
    Route::get('/my_uploads/video/create', 'FrontEnd\HomeController@myVideoCreate')->name('myVideoCreate');
    Route::post('/my_uploads/video/upload', 'FrontEnd\HomeController@myVideoUpload')->name('myVideoUpload');

    Route::get('/my_uploads/beats', 'FrontEnd\HomeController@myBeats')->name('myBeats');
    Route::get('/my_uploads/beat/create', 'FrontEnd\HomeController@myBeatCreate')->name('myBeatCreate');
    Route::post('/my_uploads/beat/upload', 'FrontEnd\HomeController@myBeatUpload')->name('myBeatUpload');

});