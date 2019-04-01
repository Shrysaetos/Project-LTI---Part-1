<template>
    <div>
        <div class="jumbotron">
            <h1>Flows Summary</h1>
        </div>
        <button class="btn btn-lg btn-info col-lg-2 control-label" v-on:click.prevent="createFlow">Create Flow</button>
    	<table class="table">
        	<thead>
        	    <tr>
        	        <th>Flow ID</th>
        	        <th>Table ID</th>
        	        <th>Device</th>
                    <th>Device type</th>
                    <th>Device name</th>
                    <th>Operational</th>
                    <th>Actions</th>
        	    </tr>
       		</thead>
        	<tbody>
                <tr v-for="s in switchesInfo.nodes.node">
                    <tr v-for='t in tablesInfo["flow-node-inventory:table"][0]["flow"]'>{{t["id"]}}
                    </tr>
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
                tablesInfo: [],
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
            },

            getTablesInfo: function () {
                this.tablesInfo = [];
                var vm = this;
                axios.get('api/flowsSummary')
                    .then(function (response){
                        vm.tablesInfo = response.data;
                    })
                    .catch(function (error){
                        vm.tablesInfo = 'An error occurred.' + error;
                    });
            }
        },
        mounted() {
            this.getSwitchesInfo();
            this.getTablesInfo();
        }
    };
</script>