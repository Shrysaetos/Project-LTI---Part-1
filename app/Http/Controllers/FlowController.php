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
        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);
    }

public function addFlowPortDrop ($device, $flowTable, $flowId, $priority, $inPort) {

        $client = new \GuzzleHttp\Client();

       
        $cod = ['flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'in-port' => 'openflow:1:1'
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => '0',
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ] 

        ];


        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);
        
    }



    public function addFlowVlanDrop ($device, $flowTable, $flowId, $priority, $vlanId) {

        $client = new \GuzzleHttp\Client();

        $cod = '{
                  "flow": [
                    {
                      "table_id": "0",
                      "id": "123",
                      "priority": "500",
                      "match": {
                        "vlan-match": {
                          "vlan-id": {
                            "vlan-id": "0",
                            "vlan-id-present": "true"
                          }
                        }
                      },
                      "instructions": {
                        "instruction": [
                          {
                            "order": "0",
                            "apply-actions": {
                              "action": [
                                {
                                  "order": "0",
                                  "drop-action": {}
                                }
                              ]
                            }
                          }
                        ]
                      }
                    }
                  ]
                }';

        $decod = json_decode($cod);

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $decod,
        ]);
        
    }

    public function addFlowIpSourceDrop ($device, $flowTable, $flowId, $priority, $ipSource) {

        $client = new \GuzzleHttp\Client();

        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'ipv4-source' => $ipSource,
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => 0,
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);
    }


    public function addFlowIpDestDrop ($device, $flowTable, $flowId, $priority, $ipDest) {

        $client = new \GuzzleHttp\Client();

        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'ipv4-destination' => $ipDest,
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => 0,
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);


    }


 public function addFlowUdpSourceDrop ($device, $flowTable, $flowId, $priority, $udpSIp) {

       $client = new \GuzzleHttp\Client();

        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'udp-source-port' => $udpSIp,
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => 0,
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);


    }


    public function addFlowUdpDestDrop ($device, $flowTable, $flowId, $priority, $udpDIp) {

        $client = new \GuzzleHttp\Client();

        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'udp-destination-port' => $udpDIp,
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => 0,
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);

    }


    public function addFlowTcpSourceDrop ($device, $flowTable, $flowId, $priority, $tcpSIp) {

        $client = new \GuzzleHttp\Client();

        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'tcp-source-port' => $tcpSIp,
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => 0,
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);

    }


    public function addFlowTcpDestDrop ($device, $flowTable, $flowId, $priority, $tcpDIp) {

        $client = new \GuzzleHttp\Client();

        $cod = [ 
            'flow' => [
                'table_id' => $flowTable,
                'id' => $flowId,
                'priority' => $priority,
                'match' => [
                    'tcp-destination-port' => $tcpDIp,
                ],
                'instructions' => [
                    'instruction' => [
                        'order' => '0',
                        'apply-actions' => [
                            'action' => [
                                'order' => 0,
                                'drop-action' => [],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $client->request('PUT', 'http://10.10.10.2:8181/restconf/config/opendaylight-inventory:nodes/node/'.$device.'/table/'.$flowTable.'/flow/'.$flowId, [
            'auth' => ['admin', 'admin'],
            'NETOAPI_KEY' => env('NETO_API_KEY'),
            'Accept' => 'application/json',
            'NETOAPI_ACTION' => 'GetOrder',
            'json'    => $cod,
        ]);

    }







}
