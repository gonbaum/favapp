<?php

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

# Auth/Guest users are managed inside the controller
Route::get('/', 'LikesController@index');

Auth::routes();

# Like actions controller routes🤭
Route::post('/like', 'LikesController@create');
Route::get('/like', 'LikesController@'); #do something with GET method ?

# Get all the photos
Route::get('/api/photos', 'PhotosController@index');

/*API ROUTES*/
// The rest of API routes where moved to /api.php. I keep the /api/photos here cause I still have to solve an error 500 when I use it there.


##-------------------------##
# My Instagram clone routes#
##-----------------------##
Route::get('/p/create','PostsController@create');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}', 'PostsController@show');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');    
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

# Always remember to keep routes in the right order so dynamic routes like '/p/{post}' -that can take any value after the 'p/'- don't trigger instead of static routes.

Route::post('follow/{user}', 'FollowsController@store');