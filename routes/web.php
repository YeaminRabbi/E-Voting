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
Route::get('/voting-portal/change/{id}', 'AdminController@portalChange')->name('portalChange')->middleware('auth');
Route::post('/voting-portal/update', 'AdminController@portalupdate')->name('portalupdate')->middleware('auth');

Route::get('/candidate/change/{id}', 'AdminController@CandidateChange')->name('CandidateChange')->middleware('auth');
Route::post('/candidate/update', 'AdminController@CandidateUpdate')->name('CandidateUpdate')->middleware('auth');
Route::post('/candidate/add-new', 'AdminController@candidateAddNew')->name('candidateAddNew')->middleware('auth');



Route::get('/voting-portal/active/{id}', 'AdminController@portalActive')->name('portalActive')->middleware('auth');
Route::get('/voting-portal/close/{id}', 'AdminController@portalClose')->name('portalClose')->middleware('auth');

//Adding user according to organization
Route::get('/add-users', 'AdminController@addUsers')->name('addUsers')->middleware('auth');
Route::post('/user-upload', 'AdminController@userlistUpload')->name('userlistUpload')->middleware('auth');
Route::post('/add-users/create', 'AdminController@addSingleUser')->name('addSingleUser')->middleware('auth');



//Doublicate Email Users
Route::get('/duplicate-email-users', 'AdminController@DuplicateEmailUsers')->name('DuplicateEmailUsers')->middleware('auth');
Route::get('/duplicate-email-users/update/{id}', 'AdminController@UpdateDubplicateEmails')->name('UpdateDubplicateEmails')->middleware('auth');
Route::get('/duplicate-email-users/change/all', 'AdminController@AllUserUpdateOrganizer')->name('AllUserUpdateOrganizer')->middleware('auth');




Route::get('/test/{id}', 'AdminController@test')->name('testTrial')->middleware('auth');
