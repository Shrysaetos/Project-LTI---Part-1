<template>
  <div>
    <div class="jumbotron">
      <h1>Create Flow</h1>
      <p>TESTE URL: {{device}} | {{flowId}} | {{flowTable}} | {{priority}}</p>

    </div>

    <div>
      <label>Device: </label>
      <select v-model="device">
        <option disabled value="">Please select one</option>
        <option v-for="s in switchesInfo.nodes.node">{{s.id}}</option>
      </select>
      <br>

      <label>Flow ID: </label>
      <input v-model="flowId" placeholder="Insert flow ID">
      <br>

      <label>Flow Name: </label>
      <input v-model="flowName" placeholder="Insert flow name">
      <br>

      <label>Flow Table: </label>
      <input v-model="flowTable" placeholder="Insert flow Table [0-255]">
      <br>

      <label>Priority: </label>
      <input v-model="priority" placeholder="Priority">
      <br><br>

      <div>
        <h4>Match</h4>
        <label>In Port: </label>
        <input v-model="port" placeholder="Port">
        <br>
        <label>VLAN ID: </label>
        <input v-model="vlanId" placeholder="[0-4095]">
        <br>
        <label>IPv4 Source: </label>
        <input v-model="ipSource" placeholder="<ip>/<mask>">
        <br>
        <label>IPv4 Destination: </label>
        <input v-model="ipDest" placeholder="<ip>/<mask>">
        <br>
      </div>
      <br>
      <div>
        <h4>Actions</h4>
        <input type="checkbox" id="checkDrop" v-model="checkedDrop">
        <label>Drop</label>
      </div>

      <button type="button" class="btn btn-outline-success" v-on:click.prevent='addFlow(device, flowTable, flowId)'>Add Flow</button>
      <p>Teste Final: {{teste}}</p>
      <button type="button" class="btn btn-outline-danger" v-on:click.prevent="goBack">Cancel</button>
    </div>
  </div>
</template>
<script>
  module.exports = {
    data() {
      return {
        switchesInfo: [],
        teste: [],
        device: "",
        flowTable: "",
        flowId: "",
        priority: "",
        flowName: "",
        port: "",
        vlanId: "",
        ipSource: "",
        ipDest: "",
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

      addFlow: function (device, flowTable, flowId) {
        this.teste = [];
          var vm = this;
          axios.put('api/createFlow/' + device + '/'+ flowTable + '/' + flowId)
            .then(response => {
              this.getTablesS1();
            })
      },

      goBack() {
        this.$router.push('/flowsSummary');
      },
    },
    mounted() {
      this.getSwitchesInfo();
      this.addFlow();
    }
  };
</script>