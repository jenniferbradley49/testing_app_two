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
	Route::get('admin/add_user', 'admin\AdminController@get_add_user');
	Route::post('admin/add_user', 'admin\AdminController@post_add_user');
	Route::get('admin/home', 'admin\AdminController@index');
	Route::get('admin/edit_user', 'admin\AdminController@get_edit_user');
	Route::post('admin/edit_user', 'admin\AdminController@post_edit_user');
	Route::get('admin/add_role', 'admin\AdminController@get_add_role');
	Route::post('admin/add_role', 'admin\AdminController@post_add_role');
	Route::get('admin/delete_role', 'admin\AdminController@get_delete_role');
	Route::post('admin/delete_role', 'admin\AdminController@post_delete_role');
	Route::get('log/add_log_event', 'LogController@get_add_log_event');
	Route::post('log/add_log_event', 'LogController@post_add_log_event');
	Route::get('log/edit_log_event', 'LogController@get_edit_log_event');
	Route::post('log/edit_log_event', 'LogController@post_edit_log_event');
	
// three step security routes
	Route::get('three_step/step_one', 'ThreeStepController@getStepOne');
	Route::post('three_step/step_one', 'ThreeStepController@postStepOne');
	Route::get('three_step/step_two', 'ThreeStepController@getStepTwo');
	Route::get('three_step/logout', 'ThreeStepController@getLogout');

// three step security admin routes	
	Route::get('three_step_admin/dashboard', 'ThreeStepAuth\ThreeStepAdminController@index');
	Route::get('three_step_admin/view_log', 'ThreeStepAuth\ThreeStepAdminController@get_view_log');
	Route::post('three_step_admin/view_log', 'ThreeStepAuth\ThreeStepAdminController@post_view_log');
	Route::get('three_step_admin/configure', 'ThreeStepAuth\ThreeStepAdminController@get_configure');
	Route::post('three_step_admin/configure', 'ThreeStepAuth\ThreeStepAdminController@post_configure');
	Route::get('three_step_admin/change_password', 'ThreeStepAuth\ThreeStepAdminController@get_change_password');
	Route::post('three_step_admin/change_password', 'ThreeStepAuth\ThreeStepAdminController@post_change_password');
	Route::get('three_step_admin/change_password_hint', 'ThreeStepAuth\ThreeStepAdminController@get_change_password_hint');
	Route::post('three_step_admin/change_password_hint', 'ThreeStepAuth\ThreeStepAdminController@post_change_password_hint');
	Route::get('three_step_admin/configure', 'ThreeStepAuth\ThreeStepAdminController@getConfigure');
	Route::post('three_step_admin/configure', 'ThreeStepAuth\ThreeStepAdminController@postConfigure');
	Route::get('three_step_admin/edit_email', 'ThreeStepAuth\ThreeStepAdminController@getEditEmail');
	Route::post('three_step_admin/edit_email', 'ThreeStepAuth\ThreeStepAdminController@postEditEmail');
	
// AJAX routes	
//	Route::get('ajax/get_user_info_admin', 'AjaxController@get_user_info_admin');
	Route::post('ajax/get_user_info_admin', 'AjaxController@get_user_info_admin');
//	Route::get('ajax/resort_users_admin', 'AjaxController@resort_users_admin');
	Route::post('ajax/resort_users_admin', 'AjaxController@resort_users_admin');
	Route::post('ajax/get_role_info_admin', 'AjaxController@get_role_info_admin');
	Route::post('ajax/get_log_event', 'AjaxController@get_log_event');
	
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
	
	