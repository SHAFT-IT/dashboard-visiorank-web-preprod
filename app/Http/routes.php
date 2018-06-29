<?php
use Dingo\Api\Routing\Router;

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

Route::any('/login', 'DashboardController@login');
Route::any('/logout', 'DashboardController@logout');
Route::get('/', 'DashboardController@index');
Route::get('/stats', 'DashboardController@stats');
Route::get('/calls', 'DashboardController@calls');
Route::post('/update_call', 'DashboardController@update_call');
Route::get('/messages', 'DashboardController@messages');
Route::get('/view_message/{id}', 'DashboardController@read_message');
Route::get('/get_attachment/{id}/{part}/{encoding}', 'DashboardController@get_attachment');
Route::get('/bills', 'DashboardController@bills');
Route::get('/add_bill', 'DashboardController@add_bill');
Route::post('/save_bill', 'DashboardController@save_bill');
Route::get('/get_bill/{filename}', 'DashboardController@get_bill');
Route::get('/users', 'DashboardController@users');
Route::get('/edit_user/{id?}', 'DashboardController@edit_user');
Route::post('/save_user', 'DashboardController@save_user');
Route::post('/update_user', 'DashboardController@update_user');

//Delete user ---
Route::get('/delete_user/{id?}', 'DashboardController@delete_user');

/* *
 * Applicatin routes for ServiceDeskController
 * */
Route::get('/ticket', 'ServiceDeskController@ticket');
Route::post('/ticket', 'ServiceDeskController@ticket');
Route::get('/edit_ticket/{id?}', 'ServiceDeskController@edit_ticket');
Route::post('/save_ticket', 'ServiceDeskController@save_ticket');
Route::post('/dropzone/uploadFiles', 'ServiceDeskController@uploadFiles');
Route::get('/delete_ticket/{id?}', 'ServiceDeskController@delete_ticket');
Route::get('/save_historique/{id}/{status}/{redirect}', 'ServiceDeskController@save_historique');
Route::post('/save_historique_comment', 'ServiceDeskController@save_historique_comment');
Route::get('/delete_pj_ticket/{idpj}/{id}', 'ServiceDeskController@delete_pj_ticket');
Route::get('/download_pj_ticket/{file}', 'ServiceDeskController@download_pj_ticket');

// Mail
Route::get('send_mail_test', 'ServiceDeskController@sendMailTest');

// WS
app(Router::class)->version('v1', [], function (Router $api) {
    app(Router::class)->get('get_all_user', 'App\Http\Controllers\Api\V1\UserController@get_all_user');
    app(Router::class)->get('get_user_by_id/{id}', 'App\Http\Controllers\Api\V1\UserController@get_user_by_id');
});