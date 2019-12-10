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
Vue.component('settings-form', require('./Form.vue').default);

window.settingsformvue = new Vue({ 
    el: '#settingsform',
    data: {
        model: model,
        timezones: timezones,
        tags: tags,
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.domain_name = null;
            this.model.website_name = null;
            this.model.owner = null;
            this.model.meta_title = null;
            this.model.meta_description = null;
            this.model.meta_keywords = null;
            this.model.timezone = null;
            this.model.developer = null;
            this.model.email_subject = null;
            this.model.email_recipients = null;
            this.model.email_cc = null;
            this.model.email_bcc = null;

            this.errors = [];
        },
        submit: function () {       
            var vm = this;     
            axios.post(settingindexurl,this.model).then(function (response) {
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