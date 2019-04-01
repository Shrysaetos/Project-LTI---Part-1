<template>
	<div>
		<div class="jumbotron" id="">
			<h3>Links Inventory</h3>
		</div>
	    <table class="table">
        	<thead>
        	    <tr>
        	        <th>Link ID</th>
        	        <th>Source Node</th>
        	        <th>Destination Node</th>
        	    </tr>
       		</thead>
        	<tbody>
            	<tr v-for="s in linksInfo.topology[0].link">
            	    <td>{{s["link-id"]}}</td>
            	    <td>{{s["source"]["source-node"]}}</td>
                    <td>{{s["destination"]["dest-node"]}}</td>
            	</tr>
        	</tbody>
    	</table>
    	<br>
    	<p>Links Number: {{linksNumber}}</p>
    
    </div>
</template>


<script>
module.exports = {
        data() {
        	return {
            	linksInfo: [],
            	linksNumber: 0,
        	};
        },

        methods: {
            getLinksInfo: function () {
                this.linksInfo = [];
                var vm = this;
                axios.get('api/link')
                    .then(function (response){
                        vm.linksInfo = response.data;
                        vm.linksNumber = vm.linksInfo.topology[0].link.length;
                    })
                    .catch(function (error){
                        vm.linksInfo = 'An error occurred.' + error;
                });
            }
        },
        mounted() {
            this.getLinksInfo();
        }
    };
</script>