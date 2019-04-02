
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Vuex from 'vuex';
Vue.use(Vuex);

import Toasted from 'vue-toasted';

Vue.use(Toasted, {
    position: 'top-right',
    duration: 5000,
    type: 'info',
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const loginComponent = Vue.component('login', require('./components/Login.vue').default);
const nodeSummaryComponent = Vue.component('node-summary', require('./components/NodesSummary.vue').default);

const flowSummaryComponent = Vue.component('flow-summary', require('./components/FlowsSummary.vue').default);
const flowSummaryS1Component = Vue.component('flow-summary-s1', require('./components/FlowsSummaryS1.vue').default);
const flowSummaryS2Component = Vue.component('flow-summary-s2', require('./components/FlowsSummaryS2.vue').default);
const flowSummaryS3Component = Vue.component('flow-summary-s3', require('./components/FlowsSummaryS3.vue').default);
const flowSummaryS4Component = Vue.component('flow-summary-s4', require('./components/FlowsSummaryS4.vue').default);

const createFlowComponent = Vue.component('create-flow', require('./components/CreateFlow.vue').default);

const linksComponent = Vue.component('links', require('./components/Links.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const routes = [
	
	{
		path: '/',
		redirect: '/login',
	},

	{
		path: '/login',
		component: loginComponent,
	},

	{
		path: '/nodeSummary',
		component: nodeSummaryComponent,
	},

	{
		path: '/flowsSummary',
		component: flowSummaryComponent
	},

	{
		path: '/flowsSummary/1',
		component: flowSummaryS1Component
	},

	{
		path: '/flowsSummary/2',
		component: flowSummaryS2Component
	},

	{
		path: '/flowsSummary/3',
		component: flowSummaryS3Component
	},

	{
		path: '/flowsSummary/4',
		component: flowSummaryS4Component
	},
	{
		path: '/createFlow',
		component: createFlowComponent,
	},

	{
		path: '/links',
		component: linksComponent,
	}


];

const router = new VueRouter({
    routes: routes
});

const app = new Vue({
    router: router,
    el: '#app'
});
