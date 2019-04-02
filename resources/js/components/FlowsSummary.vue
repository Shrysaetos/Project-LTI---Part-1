<template>
    <div>
        <div class="jumbotron">
            <h1>Flows Summary</h1>
        </div>
        <button class="btn btn-lg btn-info col-lg-2 control-label" v-on:click.prevent="flowsSummaryS1">Flows Summary vSwitch 1</button>
        <button class="btn btn-lg btn-info col-lg-2 control-label" v-on:click.prevent="flowsSummaryS2">Flows Summary vSwitch 2</button>
        <button class="btn btn-lg btn-info col-lg-2 control-label" v-on:click.prevent="flowsSummaryS3">Flows Summary vSwitch 3</button>
        <button class="btn btn-lg btn-info col-lg-2 control-label" v-on:click.prevent="flowsSummaryS4">Flows Summary vSwitch 4</button>
    </div>
</template>
<script>
    module.exports = {
        data() {
            return {
                switchesInfo: [],
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
            },
            
            flowsSummaryS1 () {
                this.$router.push('/flowsSummary/1');
            },

            flowsSummaryS2 () {
                this.$router.push('/flowsSummary/2');
            },

            flowsSummaryS3 () {
                this.$router.push('/flowsSummary/3');
            },

            flowsSummaryS4 () {
                this.$router.push('/flowsSummary/4');
            },
        },
        mounted() {
            this.getSwitchesInfo();
        }
    };
</script>