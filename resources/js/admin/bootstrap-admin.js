
window._ = require('lodash');
window.Popper = require('popper.js').default;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

$.notifyDefaults({
    type: 'warning',
    placement: {
        from: 'bottom',
        align: 'right'
    },
    template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon" class="pull-left" style="font-size:6rem; padding-right: 15px;"></span>' +
                    '<span data-notify="title"><strong>{1}</strong></span> <br />' +
                    '<span data-notify="message">{2}</span>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
               '</div>'
});

proccessnoti = function (resp) {
    var message = resp.data.message;
    var statusText = resp.statusText;
    var title = (typeof resp.data.title == 'undefined') ? 'Action Terminated' : resp.data.title;
    var icon = (typeof resp.data.icon == 'undefined') ? 'icon fa fa-warning' : resp.data.icon;
    var type = (typeof resp.data.type == 'undefined') ? 'warning' : resp.data.type;
    
    displaynoti (message, statusText, title, icon, type);
}

displaynoti = function (message, statusText, title, icon, type) {
    $.notify({
        message: message + ' ' + statusText,
        icon: icon,
        title: title,
    },{
        type: type
    });
}