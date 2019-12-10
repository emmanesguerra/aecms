/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import FormError from '../components/FormError.vue';
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

Vue.component('slider-form', require('./Form.vue').default);

window.sliderformvue = new Vue({
    el: '#sliderform',
    data: {
        model: {
            id: 0,
            header: null,
            description: null,
            image: null,
            sequence: null
        },
        errors: [],
    },
    methods: {
        reset: function () {
            this.model.id = 0;
            this.model.header = null;
            this.model.description = null;
            this.model.image = null;
            this.model.sequence = null;

            this.errors = [];
        },
        setImage (data) {
            console.log('test');
            this.model.image = data.data;
        },
        deleteImage (data) {
            this.model.image = null;
        }
    }
});