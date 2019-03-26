<template>
    <div>
        <div class="jumbotron">
            <h3>Nodes Summary</h3>
        </div>
    	<table class="table">
        	<thead>
        	    <tr>
        	        <th>Device</th>
        	        <th>Device type</th>
        	        <th>Device name</th>
        	    </tr>
       		</thead>
        	<tbody>
            	<tr v-for="s in switchesInfo">
            	    <td>{{s.nodes.node.id}}</td>
            	</tr>
        	</tbody>
    	</table>
    	</div>
</template>
<script>
    module.exports = {
        data() {
        	return {
        		switchesInfo: [],
            	switchesCount: 0,
        	};
        },
        methods: {

            // Make the actual CORS request.
            makeCorsRequest: function(method, url) {

                var xhr = new XMLHttpRequest();

                if ("withCredentials" in xhr) {
                    // XHR for Chrome/Firefox/Opera/Safari.
                    xhr.open(method, url, true);
                } else if (typeof XDomainRequest != "undefined") {
                    // XDomainRequest for IE.
                    xhr = new XDomainRequest();
                    xhr.open(method, url);
                } else {
                    // CORS not supported.
                    xhr = null;
                }

                if (!xhr) {
                    alert('CORS not supported');
                    return;
                }

                // Response handlers.
                xhr.onload = function() {
                    var text = xhr.responseText;
                    var title = text.match('<title>(.*)?</title>')[1];
                    alert('Response from CORS request to ' + url + ': ' + title);
                };

                xhr.onerror = function() {
                    alert('Woops, there was an error making the request.');
                };


                xhr.withCredentials = true;
                xhr.setRequestHeader('Authorization', 'Basic YWRtaW46YWRtaW4=');
                xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
                xhr.send();
            },

            getNumberOfSwitches: function () {
                this.switchesInfo = [];
                var vm = this;
                makeCorsRequest('GET', 'http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes')
                    .then(function (response){
                        vm.switchesInfo = response.data;
                        vm.switchesCount = vm.switchesInfo.nodes.node.length;
                    })
                    .catch(function (error){
                        vm.switchesInfo = 'An error occurred.' + error;
                    });
            }


        },
        mounted() {
            this.getNumberOfSwitches();
        }
    };
</script>