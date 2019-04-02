<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/flowsSummary', 'NodeController@getNodes');

//See flows
Route::get('/flowsSummary/1', 'FlowController@getTablesS1');
Route::get('/flowsSummary/2', 'FlowController@getTablesS2');
Route::get('/flowsSummary/3', 'FlowController@getTablesS3');
Route::get('/flowsSummary/4', 'FlowController@getTablesS4');

//Delete flow
Route::delete('flowsSummary/1/{flow}', 'FlowController@deleteFlowS1');
Route::delete('flowsSummary/2/{flow}', 'FlowController@deleteFlowS2');
Route::delete('flowsSummary/3/{flow}', 'FlowController@deleteFlowS3');
Route::delete('flowsSummary/4/{flow}', 'FlowController@deleteFlowS4');


Route::get('/nodeSummary', 'NodeController@getNodes');
Route::post('login', 'LoginControllerAPI@login'); 
Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');
Route::get('/link', 'LinksController@getLinks');
Route::get('/configFlow', 'ItemController@getNodes');