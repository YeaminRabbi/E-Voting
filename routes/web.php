<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Auth::routes(['verify' => true]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');

Route::post('/login', 'LoginController@LOGIN')->name('adminlogin');
Route::get('/logout', 'LoginController@LOGOUT')->name('adminlogout')->middleware('auth');
Route::get('/register', 'UserRegistrationController@user_registration')->name('user_registration');
Route::post('/user/create', 'UserRegistrationController@UserAccountCreate')->name('UserAccountCreate');



Route::get('/organizer', 'AdminController@organizer')->name('organizer')->middleware('auth');
Route::post('/organizer/create/', 'AdminController@organizercreate')->name('organizercreate')->middleware('auth');
Route::get('/organizer/delete/{id}', 'AdminController@organizerdelete')->name('organizerdelete')->middleware('auth');
Route::get('/user-list', 'AdminController@userlist')->name('userlist')->middleware('auth');

Route::get('/voting-portal', 'AdminController@votingportal')->name('votingportal')->middleware('auth');
Route::post('/voting-portal/create', 'AdminController@portalcreate')->name('portalcreate')->middleware('auth');
Route::get('/voting-portal/list', 'AdminController@portallist')->name('portallist')->middleware('auth');
Route::get('/voting-portal/view/{id}', 'AdminController@portalView')->name('portalView')->middleware('auth');


Route::get('/voting-portal/active/{id}', 'AdminController@portalActive')->name('portalActive')->middleware('auth');
Route::get('/voting-portal/close/{id}', 'AdminController@portalClose')->name('portalClose')->middleware('auth');

