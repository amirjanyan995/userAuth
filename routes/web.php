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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();
// delete post
Route::post('post/delete/{id}','PostsController@delete')->name('post.delete');

// remove post img
Route::post('post/removeImg/{id}','PostsController@removeImg');

//post resource
Route::resource('post', 'PostsController',
    ['except' => 'destroy']);

// get post by category
Route::get('posts/category/{categoryID}','PostsController@category')->name('post.category');

// get post by author
Route::get('posts/author/{authorID}','PostsController@userPosts')->name('post.author');

//get post for serch
Route::post('posts/search/{val}','PostsController@search');
// update fName,lName,email,phone ...
Route::post('profile/update','UserController@basicInfo')->name('basicUpdate');

//profile edit page
Route::get('/profile/edit','UserController@editProfile')->name('editProfile');

// change user password
Route::post('profile/change/password','UserController@changePassword')->name('changePassword');
// upload new profile img
Route::post('profile/newIMG','UserController@uploadProfileIMG')->name('profileIMG');
// remove profile IMG
Route::post('profile/removeIMG','UserController@removeProfileIMG')->name('removeProfileIMG');
//  Comment
Route::post('post/{id}/comment/store','CommentController@store')->name('addComment');
//Admin
Route::group(['prefix' => 'admin/page','middleware' => ['auth','role']], function () {

    //user page
    Route::get('users', 'AdminController@users')
        ->name('admin.users');

    Route::post('user/{id}/delete',"AdminController@userDel");

    // user edit page
    Route::get('user/{id}/edit', 'AdminController@editUser')
        ->name('admin.user.edit');

    //update user
    Route::post('user/{id}/update','AdminController@basicUpdate')
        ->name('admin.user.update');
    Route::post('user/{id}/as','AdminController@asAdmin')
        ->name('asAdmin');

    // posts page
    Route::get('posts', 'AdminController@posts')
        ->name('admin.posts');

    //psts edit
    Route::get('post/{id}/edit', 'AdminController@editPost')
        ->name('admin.posts.edit');

});
