<template>
    <div>
        <div class="jumbotron">
            <h1>Nodes Summary</h1>
        </div>
        <p>Number of Switches: {{switchesCount}}</p>

    	<table class="table">
        	<thead>
        	    <tr>
        	        <th>Device</th>
        	        <th>Device type</th>
        	        <th>Device name</th>
                    <th>Active flows</th>
        	    </tr>
       		</thead>
        	<tbody>
            	<tr v-for="s in switchesInfo.nodes.node">
            	    <td>{{s.id}}</td>
                    <td>{{s["flow-node-inventory:hardware"]}}</td>
                    <td>{{s["flow-node-inventory:description"]}}</td>
                    <td>{{s["flow-node-inventory:table"][68]["opendaylight-flow-table-statistics:flow-table-statistics"]["active-flows"]}}</td>
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
            getSwitchesInfo: function () {
                this.switchesInfo = [];
                var vm = this;
                axios.get('api/nodeSummary')
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
            this.getSwitchesInfo();
        }
    };
</script>