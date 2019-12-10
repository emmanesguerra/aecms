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
Vue.component('navigation-form', require('./Form.vue').default);

window.navigationformvue = new Vue({
    el: '#navigationform',
    data: {
        model: {
            id: null,
            name: null,
            start: null,
            passive: null,
            active: null,
            hover: null,
            end: null,
            parent_page: null,
            sublevel: null,
        },
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.id = null;
            this.model.name = null;
            this.model.start = null;
            this.model.passive = null;
            this.model.active = null;
            this.model.hover = false;
            this.model.end = false;
            this.model.parent_page = null;
            this.model.sublevel = null;

            this.errors = [];
        },
        submit: function () {
            var vm = this;            
            axios.post(navigationindexurl, this.model)
            .then(function (response) {
                navigationtable.ajax.reload();
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