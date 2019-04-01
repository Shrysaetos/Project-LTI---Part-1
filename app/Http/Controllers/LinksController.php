<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class LinksController extends Controller
{
    public function getLinks() {
    	$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
    	$response = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/network-topology:network-topology/topology/flow:1/', $headers);

		return $response;
    }
}
