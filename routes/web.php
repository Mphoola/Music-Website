<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => ['throttle:100,1']], function () {
    Route::get('/', function () {
        return view('frontEnd.welcome');
    });
    
    Auth::routes();
    
    Route::group(['middleware' => ['ActivityLogGuard']], function () {

        Route::get('management/login', 'Admin\Auth\AuthenticationController@loginPage')
            ->name('dashboard.loginPage')->middleware('goHome');
        Route::post('management/login', 'Admin\Auth\AuthenticationController@login')->name('dashboard.login');
        Route::post('management/logout', 'Admin\Auth\AuthenticationController@logout')->name('dashboard.logout');

        Route::group(['middleware' => ['CheckAdminBanned', 'IsAdmin']], function () {
            
            //password expired
            Route::get('management/password/expired', 'Admin\Auth\AuthenticationController@expired')
                ->name('password.expired');
            Route::post('management/password/post_expired', 'Admin\Auth\AuthenticationController@postExpired')
                ->name('password.post_expired');


            // routes for management
            Route::group(['prefix' => 'management', 'middleware' => 'password_expired'], function () {
                
                //dashboard
                Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

                //notifications
                Route::get('notifications', 'Admin\NotificationsController@index')->name('notifications');
                Route::get('notifications/{id}/view-single-notification/{v}/type/{t}', 'Admin\NotificationsController@show')->name('notifications.show');
                Route::get('notifications/{id}/mark-as-read/', 'Admin\NotificationsController@markAsRead')->name('notifications.markAsRead');
                Route::get('notifications/mark-all-as-read', 'Admin\NotificationsController@markAllAsRead')->name('notifications.markAllAsRead');
                Route::get('notifications/{id}/delete-single-notification', 'Admin\NotificationsController@delete')->name('notifications.delete');
                Route::get('notifications/delete-all-read-notification', 'Admin\NotificationsController@deleteAll')->name('notifications.delete.all');

                //managers/admins
                Route::get('/users', 'Admin\UsersController@list_users')->name('list_users');
                Route::get('/user/{id}/medias', 'Admin\UsersController@list_user_media')->name('list_user_media');
                Route::post('/user/{id}/delete', 'Admin\UsersController@delete_user')->name('delete_user');
                Route::get('/admins', 'Admin\UsersController@list_admins')->name('list_admins');
                Route::post('/admins/create', 'Admin\UsersController@add_admin')->name('add_admin');
                Route::get('/admins/{id}/permissions', 'Admin\UsersController@list_permissions')->name('list_permissions');
                Route::put('/admins/{id}/permissions', 'Admin\UsersController@update_permissions')->name('update_permissions');
                Route::get('my-profile/{id}', 'Admin\UsersController@my_profile')->name('my_profile');
                Route::put('my-profile-update/{id}', 'Admin\UsersController@my_profile_update')->name('my_profile_update');
                

                //categories
                Route::resource('categories', 'Admin\CategoriesController');

                //advert management
                Route::resource('advert_categories', 'Admin\AdvertCategoryController');
                Route::resource('advert', 'Admin\AdvertController');
                
                //search function
                Route::get('/beat_search', 'Admin\SearchController@beat_search')->name('beat_search');
                Route::get('/song_search', 'Admin\SearchController@song_search')->name('song_search');
                Route::get('/video_search', 'Admin\SearchController@video_search')->name('video_search');
                Route::get('/post_search', 'Admin\SearchController@post_search')->name('post_search');
                Route::get('/user_search', 'Admin\SearchController@user_search')->name('user_search');

                //audios
                Route::get('/songs', 'Admin\SongsController@index')->name('songs.index');
                Route::get('/song/{id}', 'Admin\SongsController@show')->name('songs.show');
                Route::get('/song/{id}/edit', 'Admin\SongsController@edit')->name('songs.edit');
                Route::put('/song/{id}/update', 'Admin\SongsController@update')->name('songs.update');
                Route::get('/songs/upload', 'Admin\SongsController@create')->name('songs.create');
                Route::post('/songs/upload', 'Admin\SongsController@upload')->name('songs.upload');
                Route::delete('/songs/delete/{id}', 'Admin\SongsController@delete')->name('songs.delete');
            
                //videos
                Route::get('/videos', 'Admin\VideosController@index')->name('videos.index');
                Route::get('/video/{id}', 'Admin\VideosController@show')->name('videos.show');
                Route::get('/video/{id}/edit', 'Admin\VideosController@edit')->name('videos.edit');
                Route::put('/video/{id}/update', 'Admin\VideosController@update')->name('videos.update');
                Route::get('/videos/upload', 'Admin\VideosController@create')->name('videos.create');
                Route::post('/videos/upload', 'Admin\VideosController@upload')->name('videos.upload');
                Route::delete('/videos/delete/{id}', 'Admin\VideosController@delete')->name('videos.delete');

                //beats
                Route::get('/beats', 'Admin\BeatsController@index')->name('beats.index');
                Route::get('/beat/{id}', 'Admin\BeatsController@show')->name('beats.show');
                Route::get('/beat/{id}/edit', 'Admin\BeatsController@edit')->name('beats.edit');
                Route::put('/beat/{id}/update', 'Admin\BeatsController@update')->name('beats.update');
                Route::get('/beats/upload', 'Admin\BeatsController@create')->name('beats.create');
                Route::post('/beats/upload', 'Admin\BeatsController@upload')->name('beats.upload');
                Route::post('/beats/upload', 'Admin\BeatsController@upload')->name('beats.upload');
                Route::delete('/beats/delete/{id}', 'Admin\BeatsController@delete')->name('beats.delete');

                //blog posts
                Route::get('/blog-posts/trashed', 'Admin\PostsController@trashed')->name('blog-posts.trashed');
                Route::get('/blog-posts/trash/{id}', 'Admin\PostsController@trash')->name('blog-posts.trash');
                Route::get('/blog-posts/restore/{id}', 'Admin\PostsController@restore')->name('blog-posts.restore');
                Route::resource('/blog-posts', 'Admin\PostsController');

                //activity logs
                Route::get('/activity-logs', 'Admin\LogsController@index')->name('logs.index');
                Route::get('/activity-logs/{id}/user/type/{g}', 'Admin\LogsController@user_logs')->name('logs.show.user');
            });

        });
 
    });
    
    
    
    //front end routes
    Route::get('/', 'FrontEnd\HomeController@index')->name('frontend.index');
    
    Route::get('/mp3-music', 'FrontEnd\MusicController@index')->name('frontend.music');
    Route::get('/mp3-music/{f}/{id}', 'FrontEnd\MusicController@show')->name('frontend.music.show');
    Route::get('/mp3-music/category/{category}/show', 'FrontEnd\MusicController@showByCategory')->name('frontend.music.showByCategory');
    Route::get('/mp3-music/{f}/download/{id}', 'FrontEnd\MusicController@download')->name('frontend.music.download');
    Route::post('/mp3-music/{id}/comment', 'FrontEnd\MusicController@comment')->name('frontend.music.comment');
    
    Route::get('/beats', 'FrontEnd\BeatsController@index')->name('frontend.beats');
    Route::get('/beats/{f}/{id}', 'FrontEnd\BeatsController@show')->name('frontend.beats.show');
    Route::get('/beats/category/{category}/show', 'FrontEnd\BeatsController@showByCategory')->name('frontend.beats.showByCategory');
    Route::get('/beat/{id}/download', 'FrontEnd\BeatsController@download')->name('frontend.beats.download');
    Route::post('/beats/{id}/comment', 'FrontEnd\BeatsController@comment')->name('frontend.beats.comment');
    
    Route::get('/videos', 'FrontEnd\VideosController@index')->name('frontend.videos');
    Route::get('/videos/{f}/{id}', 'FrontEnd\VideosController@show')->name('frontend.videos.show');
    Route::get('/videos/category/{category}/show-more', 'FrontEnd\VideosController@showByCategory')->name('frontend.videos.showByCategory');
    Route::get('/video/{f}/download/{id}', 'FrontEnd\VideosController@download')->name('frontend.videos.download');
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
    
    //checkout
    Route::get('/store/cart-checkout/all', 'CheckoutController@index')->name('cart.checkout');
    Route::get('/store/cart-checkout/zachangu/error', 'CheckoutController@zachanguError')->name('cart.checkout.zachangu.error');
    Route::get('/store/cart-checkout/zachangu/success', 'CheckoutController@zachanguSuccess')->name('cart.checkout.zachangu.success');
    Route::post('/store/cart-checkout/all', 'CheckoutController@pay')->name('cart.pay');
    
    //blog
    Route::get('/blog', 'FrontEnd\BlogsController@index')->name('blogs.index');
    Route::get('/blog/{slug}/show', 'FrontEnd\BlogsController@show')->name('blogs.show');
    Route::post('/blog/{slug}/comment', 'FrontEnd\BlogsController@comment')->name('blogs.comment');
    
    //advert redirect url
    Route::get('marketing-with-96legacy/{id}/redirect/vendor/site', 'Admin\AdvertController@redirect')
            ->name('redirect-to-vendor-site');
    

    //emptying the cart        
    Route::get('/empty', function () {
        return \Cart::clear();
    });

    // Youtube vedio upload
    Route::get('video', 'YouController@index');
    Route::post('video', 'YouController@store')->name('video');
    

    //frontend search
    Route::get('/search', 'SearchController@index')->name('search');
    
    
    //social login
    
    Route::get('/social_login/{provider}/', 'Auth\SocialLoginController@redirect_to')->name('social_login');
    Route::get('/social_login/{provider}/callback', 'Auth\SocialLoginController@callback');
    
    
    //logged in users
    Route::group(['middleware' => ['auth', 'CheckUserBanned']], function () {
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
});