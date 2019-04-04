<template>
  <div>
    <div class="jumbotron">
      <h1>Create Flow</h1>
    </div>

    <div>
      <h4>General Properties</h4>
      <label>Device: </label>
      <select v-model="device" @change='getInPort(device)'>
        <option disabled value="">Please select one</option>
        <option v-for="s in switchesInfo.nodes.node">{{s.id}}</option>
      </select>
      <br>

      <label>Flow ID: </label>
      <input v-model="flowId" placeholder="Insert flow ID">
      <br>

      <label>Flow Table: </label>
      <input v-model="flowTable" placeholder="Insert flow Table [0-255]">
      <br>

      <label>Priority: </label>
      <input v-model="priority" placeholder="Priority">
      <br><br><br>

      <div>
        <h4>Match</h4>
        <label>Select a match option: </label>
        <select v-model="match">
          <option disabled value="">Please select one</option>
          <option>In Port</option>
          <option>VLAN ID</option>
          <option>IPv4 Source</option>
          <option>IPv4 Destination</option>
          <option>UDP Source Port</option>
          <option>UDP Destination Port</option>
          <option>TCP Source Port</option>
          <option>TCP Destination Port</option>
        </select>

        <div v-if="match === 'In Port'">
          <br>
          <ul>
            <li>
              <label>In Port: </label>
              <select :disabled="verificar" v-model="inPort">
              <option disabled value="">Select one</option>
              <option v-for='t in inPortInfo.node'>{{t["id"]}}</option>
              </select>
            </li>
          </ul>
        </div>
        <div v-if="match === 'VLAN ID'">
          <br>
          <ul>
            <li>
              <label>VLAN ID: </label>
              <input v-model="vlanId" placeholder="[0-4095]">
            </li>
          </ul>
          <br>
        </div>
        <div v-if="match === 'IPv4 Source'">
          <br>
          <ul>
            <li>
              <label>IPv4 Source: </label>
              <input v-model="ipSource" placeholder="<ip>/<mask>">
            </li>
          </ul>
          <br>
        </div>
        <div v-if="match === 'IPv4 Destination'">
          <br>
          <ul>
            <li>
              <label>IPv4 Destination:</label>
              <input v-model="ipDest" placeholder="<ip>/<mask>">
            </li>
          </ul>
          <br>
        </div>
        <div v-if="match === 'UDP Source Port'">
          <br>
          <ul>
            <li>
              <label>UDP Source Port:</label>
              <input v-model="udpSIp" placeholder="[0-65635]">
            </li>
          </ul>
          <br>
        </div>
        <div v-if="match === 'UDP Destination Port'">
          <br>
          <ul>
            <li>
              <label>UDP Destination Port:</label>
              <input v-model="udpDIp" placeholder="[0-65635]">
            </li>
          </ul>
          <br>
        </div>
        <div v-if="match === 'TCP Source Port'">
          <br>
          <ul>
            <li>
              <label>TCP Source Port:</label>
              <input v-model="tcpSIp" placeholder="[0-65635]">
            </li>
          </ul>
          <br>
        </div>
        <div v-if="match === 'TCP Destination Port'">
          <br>
          <ul>
            <li>
              <label>TCP Destination Port:</label>
              <input v-model="tcpDIp" placeholder="[0-65635]">
            </li>
          </ul>
          <br>
        </div>
      </div>
      </div>
      <br><br>


      <div>
        <h4>Actions</h4>
        <input type="checkbox" id="checkDrop" v-model="checkedDrop">
        <label>Drop</label>
      </div>
      <br>

      <div>

        <button type="button" class="btn btn-outline-success" v-on:click.prevent='addFlow(device, flowTable, flowId, priority)'>Add Flow Teste</button>
      
        <button v-if="match === 'In Port' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowPortDrop(device, flowTable, flowId, priority, inPort)'>Add Flow1</button>

        <button v-if="match === 'VLAN ID' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowVlanDrop(device, flowTable, flowId, priority, vlanId)'>Add Flow2</button>

        <button v-if="match === 'IPv4 Source' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowIpSourceDrop(device, flowTable, flowId, priority, ipSource)'>Add Flow3</button>

        <button v-if="match === 'IPv4 Destination' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowIpDestDrop(device, flowTable, flowId, priority, ipDest)'>Add Flow4</button>

        <button v-if="match === 'UDP Source Port' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowUdpSourceDrop(device, flowTable, flowId, priority, udpSIp)'>Add Flow5</button>

        <button v-if="match === 'UDP Destination Port' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowUdpDestDrop(device, flowTable, flowId, priority, udpDIp)'>Add Flow6</button>

        <button v-if="match === 'TCP Source Port' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowTcpSourceDrop(device, flowTable, flowId, priority, tcpSIp)'>Add Flow7</button>

        <button v-if="match === 'TCP Destination Port' && checkedDrop" type="button" class="btn btn-outline-success" v-on:click.prevent='addFlowTcpDestDrop(device, flowTable, flowId, priority, tcpDIp)'>Add Flow8</button>



        <button type="button" class="btn btn-outline-danger" v-on:click.prevent="goBack">Cancel</button>

      </div>
    </div>
  </div>
</template>
<script>
  module.exports = {
    data() {
      return {
        switchesInfo: [],
        inPortInfo: [],
        teste: [],
        device: "",
        flowTable: "",
        flowId: "",
        priority: "",



        verificar: "",
        inPort: "",
        vlanId: "",
        ipSource: "",
        ipDest: "",
        udpSIp: "",
        udpDIp: "",
        tcpSIp: "",
        tcpDIp: "",
        match: "",


        checkedDrop: "",

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

      getInPort: function(device) {
        this.inPortInfo = [];
        var vm = this;
        axios.get('api/nodeSummary/' + device)
          .then(function (response){
            vm.inPortInfo = response.data;
          })
          .catch(function (error){
            vm.inPortInfo = 'An error occurred.' + error;
          });
          this.verificar = false;
      },

      addFlow: function (device, flowTable, flowId, priority) {
        this.teste = [];
          var vm = this;
          axios.put('api/createFlow/' + device + '/'+ flowTable + '/' + flowId + '/' + priority)
            .then(response => {
              this.$router.push('/flowsSummary')
          })
      },

      addFlowPortDrop: function (device, flowTable, flowId, priority, inPort) {
        var vm = [];
        axios.put('api/createFlow/port/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + inPort)
          .then(response => {

          })
      },

      addFlowVlanDrop: function (device, flowTable, flowId, priority, vlanId) {
        var vm = [];
        axios.put('api/createFlow/vlan/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + vlanId)
          .then(response => {

          })
      },

      addFlowIpSourceDrop: function (device, flowTable, flowId, priority, ipSource) {
        var vm = [];
        axios.put('api/createFlow/ipSource/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + ipSource)
          .then(response => {

          })
      },

      addFlowIpDestDrop: function (device, flowTable, flowId, priority, ipDest) {
        var vm = [];
        axios.put('api/createFlow/ipDest/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + ipDest)
          .then(response => {

          })
      },

      addFlowUdpSourceDrop: function (device, flowTable, flowId, priority, udpSIp) {
        var vm = [];
        axios.put('api/createFlow/udpSource/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + udpSIp)
          .then(response => {

          })
      },

            addFlowUdpDestDrop: function (device, flowTable, flowId, priority, udpDIp) {
        var vm = [];
        axios.put('api/createFlow/udpDest/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + udpDIp)
          .then(response => {

          })
      },

      addFlowTcpSourceDrop: function (device, flowTable, flowId, priority, tcpSIp) {
        var vm = [];
        axios.put('api/createFlow/tcpSource/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + tcpSIp)
          .then(response => {

          })
      },

      addFlowTcpDestDrop: function (device, flowTable, flowId, priority, tcpDIp) {
        var vm = [];
        axios.put('api/createFlow/tcpDest/' + device + '/'+ flowTable + '/' + flowId + '/' + priority + '/' + tcpDIp)
          .then(response => {

          })
      },



      goBack() {
        this.$router.push('/flowsSummary');
      },
    },
    mounted() {
      this.getSwitchesInfo();
    }
  };
</script>