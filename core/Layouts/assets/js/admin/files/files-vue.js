/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import FormError from '../../components/FormError.vue';
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

Vue.component('file-form', require('./Form.vue').default);

window.fileformvue = new Vue({
    el: '#fileform'
});