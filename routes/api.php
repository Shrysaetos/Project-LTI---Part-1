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



//create flow
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}', 'FlowController@addFlow');

/* +.+.+.+ Add flow with Match and DROP +.+.+.+ */ 
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{inPort}', 'FlowController@addFlowPortDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{vlanId}', 'FlowController@addFlowVlanDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{ipSource}', 'FlowController@addFlowIpSourceDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{ipDest}', 'FlowController@addFlowIpDestDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{udpSIp}', 'FlowController@addFlowUdpSourceDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{udpDIp}', 'FlowController@addFlowUdpDestDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{tcpSIp}', 'FlowController@addFlowTcpSourceDrop');
Route::put('createFlow/{device}/{flowTable}/{flowId}/{priority}/{tcpDIp}', 'FlowController@addFlowTcpDestDrop');





//getInPort
Route::get('nodeSummary/{device}', 'NodeController@getInPort');


Route::get('/nodeSummary', 'NodeController@getNodes');
Route::post('login', 'LoginControllerAPI@login'); 
Route::middleware('auth:api')->post('logout', 'LoginControllerAPI@logout');
Route::get('/link', 'LinksController@getLinks');
Route::get('/configFlow', 'ItemController@getNodes');

