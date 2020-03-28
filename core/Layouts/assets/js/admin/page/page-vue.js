/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../bootstrap-admin');

window.Vue = require('vue');

import Multiselect from 'vue-multiselect';
import Editor from '@tinymce/tinymce-vue';

Vue.component('multiselect', Multiselect);
Vue.component('editor', Editor );
Vue.component('page-form', require('./Form.vue').default);
Vue.component('panel-form', require('./Panel2.vue').default);
Vue.component('page-lists', require('./List.vue').default);
Vue.component('page-lists-row', require('./ListRow.vue').default);

window.pageformvue = new Vue({
    el: '#pageform',
    data: {
        model: {
            id: null,
            name: null,
            url: null,
            title: null,
            description: null,
            template: null,
            javascripts: null,
            css: null
        },
        templates: templates,
        javascripts: javascripts,
        styles: styles,
        mainpanels: mainpanels,
        regularpanels: regularpanels,
        errorsm: [],
        errorsp: null,
        panels: []
    },
    methods: {
        getTemplate (data) {
            var vm = this;
            axios.post(pagetemplateurl, {'template': data.template}).then(function (response) {
                vm.panels = response.data.data;
            }).catch(function (error) {
                if (error.response) {         
                    vm.errors = error.response.data.errors;   
                    proccessnoti(error.response);
                }
            });
        },
        reset: function () {
            this.model.id = null;
            this.model.name = null;
            this.model.url = null;
            this.model.title = null;
            this.model.description = null;
            this.model.template = null;
            this.model.javascripts = null;
            this.model.css = null;
            this.panels = [];

            this.errorsm = [];
            this.errorsp = null;
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
               url: pageindexurl,
               method: method,
               data: {
                   model: this.model,
                   panels: this.panels
               }
            }).then(function (response) {
                pagetable.ajax.reload();
                proccessnoti(response);
                vm.reset();
            }).catch(function (error) {
                vm.errorsm = [];
                vm.errorsp = null;
                if (error.response) {         
                    vm.errorsm = error.response.data.merrors;  
                    vm.errorsp = error.response.data.perrors;  
                    proccessnoti(error.response);
                }
            });
        }
    }
});

window.pagelistvue = new Vue({
    el: '#pagelists',
    data: {
        pages: pagelists
    },
    methods: {
        addEntry (data) {
            this.pages.push({
               'id': null, 
               'name': null, 
               'url': null, 
               'title': null, 
               'description': null,
               'template': null, 
               'type': null, 
               'created_at': null, 
               'updated_at': null,
               'editable': true
            });
        },
    }
});