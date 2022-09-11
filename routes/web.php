<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('frontend.home.index');
});
Route::get('/home', function () {
    if(Auth::user()->is_verified != 1){
        return redirect()->route('VerifyPage');
    }
    else{
        return redirect()->route('user-panel');
    }
});
Auth::routes(['verify' => true]);


Route::post('/login', 'LoginController@LOGIN')->name('adminlogin');
Route::get('/logout', 'LoginController@LOGOUT')->name('adminlogout')->middleware('auth');
Route::get('/register', 'UserRegistrationController@user_registration')->name('user_registration');
Route::post('/user/create', 'UserRegistrationController@UserAccountCreate')->name('UserAccountCreate');

//Admin Routes
Route::group(['prefix'=>'admin'],function(){
    Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');
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

    //Result history
    Route::get('/result/history/{id}', 'AdminController@ResultHistory')->name('AdminResultHistory')->middleware('auth');

});



// Organizer Routes
Route::group(['prefix'=>'organizer'],function(){

    Route::get('/dashboard', 'OrganizerController@index')->name('oraganizer-panel')->middleware('auth');

    //adding users
    Route::get('/add-users', 'OrganizerController@addUsers')->name('addUsers-organizer')->middleware('auth');
    Route::post('/user-upload', 'OrganizerController@userlistUpload')->name('userlistUpload-organizer')->middleware('auth');
    Route::post('/add-users/create', 'OrganizerController@addSingleUser')->name('addSingleUser-organizer')->middleware('auth');
    Route::get('/user-list', 'OrganizerController@userlist')->name('userlist-organizer')->middleware('auth');

    Route::get('/voting-portal', 'OrganizerController@votingportal')->name('votingportal-organizer')->middleware('auth');
    Route::post('/voting-portal/create', 'OrganizerController@portalcreate')->name('portalcreate-organizer')->middleware('auth');
    Route::get('/voting-portal/list', 'OrganizerController@portallist')->name('portallist-organizer')->middleware('auth');
    Route::get('/voting-portal/view/{id}', 'OrganizerController@portalView')->name('portalView-organizer')->middleware('auth');
    Route::get('/voting-portal/change/{id}', 'OrganizerController@portalChange')->name('portalChange-organizer')->middleware('auth');
    Route::post('/voting-portal/update', 'OrganizerController@portalupdate')->name('portalupdate-organizer')->middleware('auth');

    Route::get('/candidate/change/{id}', 'OrganizerController@CandidateChange')->name('CandidateChange-organizer')->middleware('auth');
    Route::post('/candidate/update', 'OrganizerController@CandidateUpdate')->name('CandidateUpdate-organizer')->middleware('auth');
    Route::post('/candidate/add-new', 'OrganizerController@candidateAddNew')->name('candidateAddNew-organizer')->middleware('auth');



    Route::get('/voting-portal/active/{id}', 'OrganizerController@portalActive')->name('portalActive-organizer')->middleware('auth');
    Route::get('/voting-portal/close/{id}', 'OrganizerController@portalClose')->name('portalClose-organizer')->middleware('auth');


    //Result history
    Route::get('/result/history/{id}', 'OrganizerController@ResultHistory')->name('OrganizerResultHistory')->middleware('auth');


});






// User Routes
Route::group(['prefix'=>'user'],function(){

    Route::get('/dashboard', 'UserController@index')->name('user-panel')->middleware('auth');
    Route::get('/vote/{id}', 'UserController@GetToVote')->name('GetToVote')->middleware('auth');
    Route::post('/cast-vote', 'UserController@CastVote')->name('CastVote')->middleware('auth');
    Route::get('/voting/history/{id}', 'UserController@VotingHistory')->name('VotingHistory')->middleware('auth');

    Route::get('/user-verification', 'UserVerification@index')->name('VerifyPage')->middleware('auth');
    Route::post('/user-verification/send-otp', 'UserVerification@sendOTP')->name('sendOTP')->middleware('auth');
    Route::post('/user-verification/confirm-otp', 'UserVerification@confirmOTP')->name('confirmOTP')->middleware('auth');

    
});



Route::get('/myAccount', 'OpenController@myAccount')->name('myAccount')->middleware('auth');
Route::post('/myAccount/update', 'OpenController@UpdateProfile')->name('UpdateProfile')->middleware('auth');








// Testing Routes
Route::get('/test/{id}', 'AdminController@test')->name('testTrial')->middleware('auth');
