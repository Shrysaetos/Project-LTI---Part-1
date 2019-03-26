@extends('master')

@section('title', 'Manager OpenFlow')

@section('content')

<div class="jumbotron" id="">
    <p>Insert ip address</p>
    <input v-model="ipAndPort" placeholder="<ip address>:<port>">
    <br> <br>
    <p>Login: </p>
    <input v-model="username" placeholder="username">
    <input type="password" v-model="password" placeholder="password">
    <button v-on:click= "getNumberOfSwitches(ipAndPort, username, password)">SEND</button><br><br>

    <p>string: @{{str}}</p>
    <p>base64: @{{encodedStr}}</p>



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
            str:'',
            encodedStr:'',
        },
    
        methods: {
            getNumberOfSwitches: function (ipAndPort, username, password) {
                this.switchesInfo = [];
                this.str = `${username}:${password}`;
                //this.encodedStr = btoa(this.str);
                this.encodedStr = btoa(this.str);

                var vm = this;
                //axios.get('http://10.10.10.2:8181/restconf/operational/opendaylight-inventory:nodes', 
                axios.get(`http://${ipAndPort}/restconf/operational/opendaylight-inventory:nodes`, 
                            //{ headers: { "Authorization": "Basic YWRtaW46YWRtaW4="}}) admin:admin
                            { headers: { "Authorization": 'Basic @{{encodedStr}'}})
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
