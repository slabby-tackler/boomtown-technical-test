window.axios = require('axios');
window.Vue = require('vue');
window.Vuex = require('vuex');
window.VueRouter = require('vue-router').default;

window.Quasar = require('quasar/dist/quasar.umd.min.js');

require('quasar-extras/material-icons/material-icons.css');
require('quasar/dist/quasar.min.css');

import store from './store.js';
import router from './router.js';

Vue.use(Quasar);

let token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    router,
});
