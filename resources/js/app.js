/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// window.Vue=require('axios');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('vue-login', require('./components/login.vue').default);
Vue.component('vue-register', require('./components/register.vue').default);


// import axios from 'axois'
import ChatApp from './components/ChatApp'
import ChatApp2 from './components2/ChatApp'
const app = new Vue({
    el: '#app',
    components: {
        ChatApp,ChatApp2
    },
});
