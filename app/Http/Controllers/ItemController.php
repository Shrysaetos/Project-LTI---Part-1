<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ItemController extends Controller
{
    
    public function getNodes() {

		$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
    	$response = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes', $headers);

		return $response;
    }

    public function getTables() {

		$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
		$table = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes/node/openflow:1/table/0', $headers);

		return $table;
    }


}
