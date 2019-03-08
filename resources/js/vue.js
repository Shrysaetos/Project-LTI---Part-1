/*jshint esversion: 6 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        title: 'List Users',
        editingUser: false,   
        showSuccess: false,
        showFailure: false,
        successMessage: '',
        failMessage: '',
        currentUser: {},
        users: [],
        departments: []
    },
    methods: {
        editUser: function(user){
         
        },
        deleteUser: function(user){
         
        },
        saveUser: function(){
         
        },
        cancelEdit: function(){
         
        }
    },
    mounted() {
        
    }
});
