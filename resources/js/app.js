/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import router from './components/router'
import VueResource from 'vue-resource'
import {store} from './components/store/store'
import axios from 'axios'
require('./bootstrap');

//utilisation de vue-resource
Vue.use(VueResource)

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component',require('./components/ExampleComponent.vue').default);

Vue.component('dashboard',require('./components/view/dashbord').default);

Vue.component('top-bar',require('./partials/top-bar').default);

Vue.component('sidebar',require('./partials/sidebar.vue').default);

Vue.component('app',require('./partials/App').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     store:store,
//     el: '#app',
//     router,
//
//
// });

// const home=new Vue({
//     store:store,
//     el: '#app-b',
//     router,
//     render:h=>h(App)
// })
