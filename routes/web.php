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

Route::get('/','ViewDetailsController@index');

Route::get('service_provider/login',function(){return view('auth.provider_login');})->name('provider_login');
Route::get('admin/login',function(){return view('auth.admin_login');})->name('admin_loginpanel');
Route::get('customer/login',function(){return view('auth.client_login');})->name('client_login');
Route::get('/view_details/{id}', 'ViewDetailsController@view_details')->name('view_details');
Route::get('search','ViewDetailsController@search')->name('search_property');
Route::get('about_us','ViewDetailsController@about_us');
Auth::routes();
Route::post('admin_login','Auth\LoginController@admin_login')->name('admin_login');
Route::post('service_provider','Auth\LoginController@service_provider')->name('service_provider');
//auth customer..................
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/booking/{id}', 'HomeController@booking')->name('booking');
Route::post('/submit_booking', 'HomeController@submit_booking')->name('submit_booking');
Route::get('/booking_list', 'HomeController@booking_list');
 Route::get('change_password','HomeController@change_password');
 Route::post('change_password','HomeController@submit_password')->name('change_customer_password');
 Route::get('profile','HomeController@profile');
 Route::post('profile','HomeController@change_profile')->name('customer_profile');
//auth service provider.......................
Route::prefix('provider')->group(function () {
    Route::get('change_password','ServiceProviderController@change_password');
 Route::post('change_password','ServiceProviderController@submit_password')->name('change_provider_password');
 Route::get('profile','ServiceProviderController@profile');
 Route::post('profile','ServiceProviderController@change_profile')->name('provider_profile');
 Route::get('home','ServiceProviderController@home');
 Route::get('post_list','ServiceProviderController@post_list');
 Route::get('give_post','ServiceProviderController@give_post');
 Route::post('submit_post','ServiceProviderController@submit_post')->name('submit_post');
 Route::get('edit_post/{id}','ServiceProviderController@edit_post')->name('edit_post');
 Route::post('update_post','ServiceProviderController@update_post')->name('update_post');
 Route::post('delete_post','ServiceProviderController@delete_post');
 Route::get('booking_list','ServiceProviderController@booking_list');
 Route::post('update_booking_info','ServiceProviderController@update_booking_info');
});
//auth admin.......................
Route::prefix('admin')->group(function () {
 Route::get('profile','AdminController@profile');
 Route::get('change_password','AdminController@change_password');
 Route::post('change_password','AdminController@submit_password')->name('change_password');
 Route::post('profile','AdminController@admin_profile')->name('admin_profile');
 Route::get('home','AdminController@home');
 Route::get('local_admin_list','AdminController@local_admin_list');
 Route::get('customer_list','AdminController@customer_list');
 Route::get('booking_list','AdminController@booking_list');
 Route::get('new_local_admin','AdminController@new_local_admin');
 Route::get('add_new_customer','AdminController@add_new_customer');
 Route::get('update_local_admin/{id}','AdminController@update_local_admin')->name('update_local_admin');
 Route::get('update_customer/{id}','AdminController@update_customer')->name('update_customer');
 Route::post('update_local_admin_info','AdminController@update_local_admin_info')->name('update_local_admin_info');
 Route::post('update_customer_info','AdminController@update_customer_info')->name('update_customer_info');
 Route::post('new_local_admin_info','AdminController@new_local_admin_info')->name('new_local_admin_info');
 Route::post('new_customer_info','AdminController@new_customer_info')->name('new_customer_info');
 Route::post('delete_local_admin','AdminController@delete_local_admin');
 Route::get('post_list','AdminController@post_list');
 Route::post('update_post','AdminController@update_post');
 Route::post('delete_post','AdminController@delete_post');
    Route::post('delete_customer','AdminController@delete_customer');
});
