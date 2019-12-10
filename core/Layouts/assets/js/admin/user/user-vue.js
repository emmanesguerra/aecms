/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import FormError from '../../components/FormError.vue';
import Multiselect from 'vue-multiselect';

Vue.component('multiselect', Multiselect)
Vue.component('user-form', require('./Form.vue').default);

window.userformvue = new Vue({
    el: '#userform',
    data: {
        model: {
            id: null,
            firstname: null,
            lastname: null,
            middlename: null,
            email: null,    
            password: null,
            usertype: null
        },
        options: [
            'AE Admin',
            'Admin'
        ],
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.id = null;
            this.model.firstname = null;
            this.model.lastname = null;
            this.model.middlename = null;
            this.model.email = null;
            this.model.password = null;
            this.model.usertype = null;

            this.errors = [];
        },
        submit: function () {
            let apiRes = null;
            var vm = this;
            var method;
            if(this.model.id > 0) {
                method = 'put';
            } else {
                method = 'post';
            }
            
            axios({
               url: userindexurl,
               method: method,
               data: this.model
            }).then(function (response) {
                usertable.ajax.reload();
                vm.reset();
                proccessnoti(response);
            }).catch(function (error) {
                if (error.response) {         
                    vm.errors = error.response.data.errors;   
                    proccessnoti(error.response);
                }
            });
        }
    }
});