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
    return view('home');
});

Auth::routes();

Route::get('dashboard', 'Backend\DashboardController@index')->name('dashboard');
Route::get('admin', 'Backend\DashboardController@index')->name('dashboard');


Route::get('admin/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Backend\Auth\LoginController@login');
Route::post('admin/logout', 'Backend\Auth\LoginController@logout')->name('admin.logout');

//Riders Routes
Route::resource('admin/riders','Backend\RiderController');
Route::post('admin/riders/store', 'Backend\RiderController@store');
Route::post('admin/riders/update', 'Backend\RiderController@update');
Route::get('admin/riders/delete/{id}', 'Backend\RiderController@destroy');

//Riders Routes
Route::resource('admin/rides','Backend\RideController');
Route::post('admin/rides/store', 'Backend\RideController@store');
Route::post('admin/rides/update', 'Backend\RideController@update');
Route::get('admin/rides/delete/{id}', 'Backend\RideController@destroy');

//Owners Routes
Route::resource('admin/owners','Backend\OwnerController');
Route::post('admin/owners/store', 'Backend\OwnerController@store');
Route::post('admin/owners/update', 'Backend\OwnerController@update');
Route::get('admin/owners/delete/{id}', 'Backend\OwnerController@destroy');


//Pending Booking Routes
Route::resource('admin/trips/pending','Backend\PendingController');
//Route::post('admin/rides/store', 'Backend\RideController@store');
Route::post('admin/trips/pending/update', 'Backend\PendingController@update');
//Route::get('admin/rides/delete/{id}', 'Backend\RideController@destroy');


//Scheduled Booking Routes
Route::resource('admin/trips/scheduled','Backend\ScheduledController');
//Route::post('admin/rides/store', 'Backend\RideController@store');
Route::post('admin/trips/scheduled/update', 'Backend\ScheduledController@update');
//Route::get('admin/rides/delete/{id}', 'Backend\RideController@destroy');


//Completed Booking Routes
Route::resource('admin/trips/complete','Backend\CompleteController');
//Route::post('admin/rides/store', 'Backend\RideController@store');
Route::post('admin/trips/complete/update', 'Backend\CompleteController@update');
//Route::get('admin/rides/delete/{id}', 'Backend\RideController@destroy');


//Completed Booking Routes
Route::resource('admin/trips/all','Backend\TripsController');
//Route::post('admin/rides/store', 'Backend\RideController@store');
//Route::post('admin/trips/complete/update', 'Backend\CompleteController@update');
//Route::get('admin/rides/delete/{id}', 'Backend\RideController@destroy');













Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/admin', 'Backend\AdminLoginController@index')->name('adminlogin');
//Route::post('/admin/login', 'Backend\AdminLoginController@index')->name('adminlogin');


route::get('verify', 'Frontend\PhoneVerificationController@index')->name('verify');
route::post('verify', 'Frontend\PhoneVerificationController@verify')->name('verify.submit');

route::get('book', 'Frontend\BookingsController@index')->name('book');
route::post('booking/confirm', 'Frontend\BookingsController@store')->name('booking.confirm');
route::get('my-bookings', 'Frontend\BookingsController@show')->name('mybooking');

route::get('myaccount', 'Frontend\MyAccountController@index')->name('bookings');
