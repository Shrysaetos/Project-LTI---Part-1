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
            	<tr v-for="s in switchesInfo.nodes.node">
            	    <td>{{s.id}}</td>
                    <td>{{s["flow-node-inventory:hardware"]}}</td>
                    <td>{{s["flow-node-inventory:description"]}}</td>
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