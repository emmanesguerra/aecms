/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (document.getElementById('slider'))
{
    Vue.component('slider-list', require('./components/slider/Template.vue'));

    window.slidervue = new Vue({
        el: '#slider',
        data: {
            model: info,
        }
    });
}
