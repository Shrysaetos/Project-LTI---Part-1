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
            	<tr v-for="t in tablesInfo">
                    <td>{{t}}</td>
                    <td>{{flowsCount}}</td>
            	</tr>
        	</tbody>
    	</table>
    	</div>
</template>
<script>
    module.exports = {
        data() {
        	return {
                tablesInfo: [],
                flowsCount: 0,
        	};
        },
        methods: {
            getTablesInfo: function () {
                this.switchesInfo = [];
                var vm = this;
                axios.get('api/flowsSummary')
                    .then(function (response){
                        vm.tablesInfo = response.data;
                        vm.flowsCount = vm.tablesInfo.length;
                    })
                    .catch(function (error){
                        vm.tablesInfo = 'An error occurred.' + error;
                    });
            },
            createFlow: function () {
                this.$router.push('/createFlow');
            }
        },
        mounted() {
            this.getTablesInfo();
        }
    };
</script>