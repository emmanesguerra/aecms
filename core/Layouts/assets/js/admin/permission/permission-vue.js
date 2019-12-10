/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import FormError from '../../components/FormError.vue';
import Multiselect from 'vue-multiselect';

Vue.component('multiselect', Multiselect);
Vue.component('permission-form', require('./Form.vue').default);

window.permissionformvue = new Vue({
    el: '#permissionform',
    data: {
        model: {
            userid: null,
            perms: []
        },
        users: uesrs,
        modules: modules,
        errors: [],
    },
    methods: {
        setPerm (data) {
            var index = this.model.perms.indexOf(data);
            if (index > -1) {
                this.model.perms.splice(index, 1);
            } else {
                this.model.perms.push(data)
            }
        },
        setUser (data) {
            this.model.userid = data.id
            var vm = this;
            axios.get(permissionindexurl + '/' + data.id).then(function (response) {
                vm.model = response.data;
            });
        },
        submit() {
            var vm = this;
            axios.post(permissionindexurl, this.model).then(function (response) {
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