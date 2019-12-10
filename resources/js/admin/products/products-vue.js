/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import FormError from '../components/FormError.vue';
import Multiselect from 'vue-multiselect';
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

Vue.component('multiselect', Multiselect)
Vue.component('category-form', require('./CategoryForm.vue').default);

window.categoryformvue = new Vue({
    el: '#categoryform',
    data: {
        model: {
            id: 0,
            name: null,
            short_description: null,
            description: null,
            image: null,
            sequence: null
        },
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.id = 0;
            this.model.name = null;
            this.model.short_description = null;
            this.model.description = null;
            this.model.image = null;
            this.model.sequence = null;

            this.errors = [];
        },
        setImage (data) {
            this.model.image = data.data;
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
               url: categoryindexurl,
               method: method,
               data: this.model,
            }).then(function (response) {
                categorytable.ajax.reload();
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

Vue.component('product-form', require('./ProductForm.vue'));

window.productformvue = new Vue({
    el: '#productform',
    data: {
        model: {
            id: 0,
            category_id: null,
            name: null,
            description: null,
            factory_price: null,
            selling_price: null,
            stocks: null,
            is_bestseller: null,
            primary_image: null,
            alternative_image: null,
            sequence: null
        },
        categories: [],
        products: [],
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.id = 0
            this.model.category_id = null;
            this.model.name = null;
            this.model.description = null;
            this.model.factory_price = null;
            this.model.selling_price = null;
            this.model.stocks = null;
            this.model.is_bestseller = null;
            this.model.primary_image = null;
            this.model.alternative_image = null;
            this.model.sequence = null;

            this.errors = [];
        },
        setPrimaryImage (data) {
            this.model.primary_image = data.data;
        },
        setAlternateImage (data) {
            this.model.alternative_image = data.data;
        },
        setMoreImage (data) {
            return;
        },
        setCategory (data) {
            this.model.category_id = data.id;
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
               url: productindexurl,
               method: method,
               data: this.model,
            }).then(function (response) {
                producttable.ajax.reload();
                proccessnoti(response);
                vm.reset();
                $('#productlisttab').trigger('click');
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
