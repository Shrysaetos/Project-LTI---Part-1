<template>
	<div class="jumbotron" id="">
    	<p>Insert ip address</p>
    	<input v-model="ipAndPort" placeholder="<ip address>:<port>">
    	<br> <br>
    	<p>Login: </p>
    	<input v-model="username" placeholder="username">
    	<input type="password" v-model="password" placeholder="password">
    	<button v-on:click= "getNumberOfSwitches(ipAndPort, username, password)">SEND</button><br><br>

	</div>
</template>