/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (document.getElementById('contactform'))
{
    Vue.component('contact-form', require('./components/contactus/Form.vue'));

    window.contactformvue = new Vue({
        el: '#contactform',
        data: {
            model: {
                name: null,
                email: null,
                message: null
            },
            errors: [],
        },
        methods: {
            reset: function () {
                this.errors = [];
            },
            submit: function () {
                var vm = this;

                axios({
                    url: contactusindexurl,
                    method: 'post',
                    data: this.model
                }).then(function (response) {
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
}


if (document.getElementById('contactusmain'))
{
    Vue.component('contact-list', require('./components/contactus/List.vue'));
    Vue.component('store-hours', require('./components/contactus/Hour.vue'));

    window.contactusmainvue = new Vue({
        el: '#contactusmain',
        data: {
            model: info,
        }
    });
}
