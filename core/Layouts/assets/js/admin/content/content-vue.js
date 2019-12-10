/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import FormError from '../../components/FormError.vue';
import Editor from '@tinymce/tinymce-vue';
import Multiselect from 'vue-multiselect';

Vue.component('editor', Editor);
Vue.component('multiselect', Multiselect)
Vue.component('content-form', require('./Form.vue').default);

window.contentformvue = new Vue({
    el: '#contentform',
    data: {
        model: {
            name: null,
            type: null,
            html_template: null
        },
        types: [
            {
                code: 'M',
                name: 'Main'
            },
            {
                code: 'P',
                name: 'Panels'
            }
        ],
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.name = null;
            this.model.html_template = '';
            this.model.type = null;

            this.errors = [];
        },
        submit: function () {
            var vm = this;

            axios({
                url: contentindexurl,
                method: 'put',
                data: this.model
            }).then(function (response) {
                contenttable.ajax.reload();
                proccessnoti(response);
                vm.reset();
            }).catch(function (error) {
                vm.errors = [];
                if (error.response) {
                    vm.errors = error.response.data.errors;
                    proccessnoti(error.response);
                }
            });
        }
    }
});