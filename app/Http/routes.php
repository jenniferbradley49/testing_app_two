<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
	Route::get('/', 'WelcomeController@index');
	Route::get('home', 'DashboardController@index');
	
	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	
	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');
	
	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');
	
	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
	
	// admin routes
	Route::get('admin/add_user_admin', 'admin\AdminController@get_add_user_admin');
	Route::post('admin/add_user_admin', 'admin\AdminController@post_add_user_admin');
	Route::get('admin/home', 'admin\AdminController@index');
	Route::get('admin/edit_user_admin', 'admin\AdminController@get_edit_user_admin');
	Route::post('admin/edit_user_admin', 'admin\AdminController@post_edit_user_admin');
	Route::get('admin/add_role_admin', 'admin\AdminController@get_add_role_admin');
	Route::post('admin/add_role_admin', 'admin\AdminController@post_add_role_admin');
	Route::get('admin/delete_role_admin', 'admin\AdminController@get_delete_role_admin');
	Route::post('admin/delete_role_admin', 'admin\AdminController@post_delete_role_admin');
	
// AJAX routes	
//	Route::get('ajax/get_user_info_admin', 'AjaxController@get_user_info_admin');
	Route::post('ajax/get_user_info_admin', 'AjaxController@get_user_info_admin');
//	Route::get('ajax/resort_users_admin', 'AjaxController@resort_users_admin');
	Route::post('ajax/resort_users_admin', 'AjaxController@resort_users_admin');
	Route::post('ajax/get_role_info_admin', 'AjaxController@get_role_info_admin');

	//Test provider organization routes
	Route::get('test_provider_org/home', 'TestProviderOrganizationController@index');
//	Route::get('admin/edit_user_admin', 'admin\AdminController@get_edit_user_admin');
//	Route::post('admin/edit_user_admin', 'admin\AdminController@post_edit_user_admin');

	//Test preparer routes
	Route::get('test_preparer/home', 'TestPreparerController@index');
	Route::get('test_preparer/add_category', 'TestPreparerController@get_add_category');
	Route::post('test_preparer/add_category', 'TestPreparerController@post_add_category');
	Route::get('test_preparer/add_sub_category', 'TestPreparerController@get_add_sub_category');
	Route::post('test_preparer/add_sub_category', 'TestPreparerController@post_add_sub_category');
	Route::get('test_preparer/edit_category', 'TestPreparerController@get_edit_category');
	Route::post('test_preparer/edit_category', 'TestPreparerController@post_edit_category');
	Route::get('test_preparer/edit_sub_category', 'TestPreparerController@get_edit_sub_category');
	Route::post('test_preparer/edit_sub_category', 'TestPreparerController@post_edit_sub_category');
	
	// test routes
	Route::get('tests/add_test', 'tests\TestController@get_add_test');
	Route::post('tests/add_test', 'tests\TestController@post_add_test');
	Route::get('tests/edit_test', 'tests\TestController@get_edit_test');
	Route::post('tests/edit_test', 'tests\TestController@post_edit_test');
	
	