require('./bootstrap');
window.$ = window.jQuery = require('jquery');

window.Vue = require('vue');

import Vue from 'vue';

import VueRouter from 'vue-router';
import moment from 'moment';
import VueProgressBar from 'vue-progressbar';
import Swal from 'sweetalert2';
import {
    Form,
    HasError,
    AlertError
} from 'vform';
import Routes from './routes';


import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);



window.Form = Form;

window.Swal = Swal;
window.Fire = new Vue();

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});


window.Toast = Toast;


Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: Routes // short for `routes: routes`
});

Vue.use(VueProgressBar, {
    color: 'rgba(143,255,199)',
    failedcolor: 'red',
    height: '2px'
})

Vue.filter('upText', function (text) {
    // if (!text) return ''
    // text = text.toString()
    return text.charAt(0).toUpperCase() + text.slice(1)
    //return text.toUpperCase();
})

Vue.filter('myDate', function (created) {
    return moment(created).format('MMMM Do YYYY, h:mm:ss a');
    // return moment(created).format('MMMM Do YYYY');
})

Vue.component('notFound', require('./components/NotFound.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);




const app = new Vue({
    el: '#app',
    router
});
