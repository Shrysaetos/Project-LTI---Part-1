<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as IlluRequest;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class FlowController extends Controller
{
    public function getTablesS1() {

    	
		$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
		$table = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes/node/openflow:1/table/0/', $headers);

		return $table;
    }

    public function getTablesS2() {

		$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
		$table = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes/node/openflow:2/table/0/', $headers);

		return $table;
    }

    public function getTablesS3() {

		$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
		$table = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes/node/openflow:3/table/0/', $headers);

		return $table;
    }

    public function getTablesS4() {

		$client = new \GuzzleHttp\Client();
		$headers = ['auth' => ['admin', 'admin']];
		$table = $client->request('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes/node/openflow:4/table/0/', $headers);

		return $table;
    }

    public function deleteFlowS1 ($flow) {
    	$client = new \GuzzleHttp\Client();
    	$headers = ['auth' => ['admin', 'admin']];
    	$client->delete('http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/openflow:1/table/0/flow/' . $flow , $headers);
    }

    public function deleteFlowS2 ($flow) {
    	$client = new \GuzzleHttp\Client();
    	$headers = ['auth' => ['admin', 'admin']];
    	$client->delete('http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/openflow:2/table/0/flow/' . $flow , $headers);
    }

    public function deleteFlowS3 ($flow) {
    	$client = new \GuzzleHttp\Client();
    	$headers = ['auth' => ['admin', 'admin']];
    	$client->delete('http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/openflow:3/table/0/flow/' . $flow , $headers);
    }

    public function deleteFlowS4 ($flow) {
    	$client = new \GuzzleHttp\Client();
    	$headers = ['auth' => ['admin', 'admin']];
    	$client->delete('http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/openflow:4/table/0/flow/' . $flow , $headers);
    }



    //Adicionar flows

    public function addFlow ($device, $flowTable, $flowId, $priority) {
        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];

        $body = '{
                  "flow": [
                    {
                      "table_id": "'.$flowTable.'",
                      "id": "'.$flowId.'"
                    }
                  ]
                }';

        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        //$client->put($url, $headers, json_encode($body));
        $client->request('PUT', $url, [
            'headers' => [
                'auth' => 'Basic YWRtaW46YWRtaW4=',
                'content-type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'body' => $body
        ]);

    }
 

    //Adicionar flows match+drop
    public function addFlowPortDrop ($device, $flowTable, $flowId, $priority, $inPort) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowVlanDrop ($device, $flowTable, $flowId, $priority, $vlanId) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowIpSourceDrop ($device, $flowTable, $flowId, $priority, $ipSource) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowIpDestDrop ($device, $flowTable, $flowId, $priority, $ipDest) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowUdpSourceDrop ($device, $flowTable, $flowId, $priority, $udpSIp) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowUdpDestDrop ($device, $flowTable, $flowId, $priority, $udpDIp) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowTcpSourceDrop ($device, $flowTable, $flowId, $priority, $tcpSIp) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }


    public function addFlowTcpDestDrop ($device, $flowTable, $flowId, $priority, $tcpDIp) {

        $client = new \GuzzleHttp\Client();
        $headers = [
            'auth' => ['admin', 'admin'],
            'content-type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $url = 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId;

        $body =
    }



}
