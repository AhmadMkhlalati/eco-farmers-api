import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
import dom from "@left4code/tw-starter/dist/js/dom";
import helper from "./helper";
import axios from "axios";
import * as Popper from "@popperjs/core";
window.axios = axios;
import $ from 'jquery'
window.$ = $;
window.helper = helper;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';
//
// import Pusher from 'pusher-js';
// window.Pusher = Pusher;
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: '127.0.0.1',
//     wsPort: 6001,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 4433,
//     forceTLS: false,
//     enabledTransports: ['ws', 'wss'],
// });
