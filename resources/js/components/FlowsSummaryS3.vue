<template>
    <div>
        <div class="jumbotron">
            <h1>Flows Summary - vSwitch3</h1>
        </div>
        <button class="btn btn-info col-lg-2 control-label" v-on:click.prevent="createFlow">Create Flow</button>
        <button type="button" class="btn btn-outline-danger" v-on:click.prevent="goBack">Cancel</button>
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
                <tr v-for='f in tablesInfo["flow-node-inventory:table"][0]["flow"]'>
                    <td>{{f["id"]}}</td>
                    <td>{{f["table_id"]}}</td>
                    <td>{{switchInfo.id}}</td>
                    <td>{{switchInfo["flow-node-inventory:hardware"]}}</td>
                    <td>{{switchInfo["flow-node-inventory:description"]}}</td>
                    <td>ON DEVICE</td>
                    <td>
                        <button class="btn btn-info" v-on:click.prevent="createFlow">Edit</button>
                        <button type="button" class="btn btn-danger" v-on:click.prevent="deleteFlow(f)">Delete</button>
                    </td>
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
                switchInfo: [],
            };
        },
        methods: {
            getSwitchesInfo: function () {
                this.switchesInfo = [];
                var vm = this;
                axios.get('api/flowsSummary')
                    .then(function (response){
                        vm.switchesInfo = response.data;
                        vm.switchInfo = vm.switchesInfo.nodes.node[0];
                    })
                    .catch(function (error){
                        vm.switchesInfo = 'An error occurred.' + error;
                    });
            },

            getTablesInfo: function () {
                this.tablesInfo = [];
                var vm = this;
                axios.get('api/flowsSummary/3')
                    .then(function (response){
                        vm.tablesInfo = response.data;
                    })
                    .catch(function (error){
                        vm.tablesInfo = 'An error occurred.' + error;
                    });
            },

            goBack() {
                this.$router.push('/flowsSummary');
            },

            deleteFlow: function(flow) {
                axios.delete('api/flowsSummary/3/' + flow.id)
                    .then(response => {
                        this.getTablesS1();
                    })
            },

            createFlow() {
                this.$router.push('/createFlow');
            }
        },
        mounted() {
            this.getSwitchesInfo();
            this.getTablesInfo();
        }
    };
</script>