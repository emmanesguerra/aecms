/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

Vue.component('contact-form', require('./Form.vue').default);

window.contactformvue = new Vue({
    el: '#contactform',
    data: {
        model: {
            id: 0,
            address: null,
            storehours: [
                {
                    day: null,
                    start: null,
                    end: null,
                }
            ],
            contact_person: null,
            telephone: null,
            mobile: null,
            email: null,
            marker: null
        },
        removehours: [],
        errors: [],
    },
    methods: {
        addMore () {
            this.model.storehours.push({
                    day: null,
                    start: null,
                    end: null,
                });
        },
        removeSelected (data) {
            this.removehours.push(data.id);
            this.model.storehours.splice(data.index, 1);
        },
        reset: function () {
            this.model.id = 0;
            this.model.address = null;
            this.model.storehours = [
                {
                    day: null,
                    start: null,
                    end: null,
                }
            ];
            this.model.contact_person = null;
            this.model.telephone = null;
            this.model.mobile = null;
            this.model.email = null;
            this.model.marker = null;

            this.errors = [];
            this.removehours = [];
        },
        submit: function () {
            var vm = this;
            var method;
            if(this.model.id > 0) {
                method = 'put';
            } else {
                method = 'post';
            }
            
            axios({
               url: contactindexurl,
               method: method,
               data: {
                   model: this.model,
                   removehours: this.removehours
               }
            }).then(function (response) {
                contacttable.ajax.reload();
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