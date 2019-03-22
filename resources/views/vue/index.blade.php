@extends('master')

@section('title', 'Manager OpenFlow')

@section('content')

<div class="jumbotron" id="">
    <button v-on:click="getNumberOfSwitches">GET</button>
    <p>@{{switchesCount}}</p>
</div>


@endsection
@section('pagescript')
<script src="http://unpkg.com/vue"></script>
<script src="http://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var vm = new Vue ({
        el: '#app',
        data: {
            switchesInfo: [],
            switchesCount: 0,
        },
        methods: {
            getNumberOfSwitches: function () {
                this.switchesInfo = [];
                var vm = this;
                axios.get('http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes', 
                            { headers: { "Authorization": "Basic YWRtaW46YWRtaW4="}})
                    .then(function (response){
                        vm.switchesInfo = response.data;
                        vm.switchesCount = vm.switchesInfo.nodes.node.length;
                    })
                    .catch(function (error){
                        vm.switchesInfo = 'An error occurred.' + error;
                    });
            }
        },
    });
</script>
@stop  
