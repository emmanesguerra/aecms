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
Vue.component('module-form', require('./Form.vue').default);

window.moduleformvue = new Vue({
    el: '#moduleform',
    data: {
        model: {
            module_name: null,
            description: null,
            loaddefault: false,
            includepanel: false,
            link: null,
            icon: null,
            permissions: []
        },
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.module_name = null;
            this.model.description = null;
            this.model.loaddefault = false;
            this.model.includepanel = false;
            this.model.link = null;
            this.model.icon = null;
            this.model.permissions = [];

            this.errors = [];
        },
        submit: function () {
            var vm = this;            
            axios.post(moduleindexurl, this.model)
            .then(function (response) {
                moduletable.ajax.reload();
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