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

// WS
app(Router::class)->version('v1', [], function (Router $api) {
    app(Router::class)->post('ws_login', 'App\Http\Controllers\Api\V1\AuthenticateController@ws_login');
    app(Router::class)->post('ws_logout', 'App\Http\Controllers\Api\V1\AuthenticateController@ws_logout');
    app(Router::class)->post('ws_get_connected_user', 'App\Http\Controllers\Api\V1\AuthenticateController@ws_get_connected_user');
    app(Router::class)->get('ws_get_data_dashboard/{token}', 'App\Http\Controllers\Api\V1\DashboardController@ws_get_data_dashboard');
    app(Router::class)->get('ws_get_stats/{token}', 'App\Http\Controllers\Api\V1\StatsController@ws_get_stats');
    app(Router::class)->get('ws_get_calls/{token}', 'App\Http\Controllers\Api\V1\CallsController@ws_get_calls');
    app(Router::class)->get('ws_get_messages/{token}', 'App\Http\Controllers\Api\V1\MessagesController@ws_get_messages');
    app(Router::class)->post('ws_update_call/{token}', 'App\Http\Controllers\Api\V1\CallsController@ws_update_call');
    app(Router::class)->post('ws_details_message/{token}', 'App\Http\Controllers\Api\V1\MessagesController@ws_details_message');
    app(Router::class)->get('ws_get_users/{token}', 'App\Http\Controllers\Api\V1\UsersController@ws_get_users');
    app(Router::class)->get('ws_get_sites/{token}', 'App\Http\Controllers\Api\V1\UsersController@ws_get_sites');
    app(Router::class)->post('ws_save_user/{token}', 'App\Http\Controllers\Api\V1\UsersController@ws_save_user');
    app(Router::class)->delete('ws_delete_user/{token}', 'App\Http\Controllers\Api\V1\UsersController@ws_delete_user');

    /*
     * Demandes route
     */
    app(Router::class)->get('ws_demandes/{token}', 'App\Http\Controllers\Api\V1\DemandesController@index');
    app(Router::class)->post('ws_demandes/{token}', 'App\Http\Controllers\Api\V1\DemandesController@updateStatus');
    app(Router::class)->post('ws_demandes/edit/{token}', 'App\Http\Controllers\Api\V1\DemandesController@edit');
    app(Router::class)->post('ws_demandes/create/{token}', 'App\Http\Controllers\Api\V1\DemandesController@post');
    app(Router::class)->get('ws_status_list', 'App\Http\Controllers\Api\V1\DemandesController@getStatusList');
    app(Router::class)->get('ws_types_list', 'App\Http\Controllers\Api\V1\DemandesController@getTypeList');
    app(Router::class)->get('ws_priorities_list', 'App\Http\Controllers\Api\V1\DemandesController@getPriorityList');
    app(Router::class)->get('ws_demandes/{token}/{ticketId}', 'App\Http\Controllers\Api\V1\DemandesController@getById');
    app(Router::class)->get('ws_find_demandes/{token}', 'App\Http\Controllers\Api\V1\DemandesController@filter');
    app(Router::class)->delete('ws_demandes/{token}', 'App\Http\Controllers\Api\V1\DemandesController@remove');
});