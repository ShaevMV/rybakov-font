/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//require("babel-polyfill");
// подключаемые библиотеки
import store from './store/index';
import Vue from 'vue'
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import axios from 'axios';
import CKEditor from '@ckeditor/ckeditor5-vue';
//Подключаем JQuery
import $ from 'jquery';
//Подключаем UIkit
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
import router from './router.js';

window.jQuery = $;
window.jQuery = jQuery;


window.UIkit = UIkit;
UIkit.use(Icons);



window.eventBus = new Vue(); // события
window.Vue = Vue;
window.store = store;
window.Vue.use(VueRouter);
window.Vue.use(VueResource);
window.Vue.use(CKEditor);
//Подключение компонентов
require('./component');




// добавить токент клиента
axios.interceptors.request.use(function(config) {
    let token = localStorage['userToken'];
    if(token) {
        config.headers.Authorization = token;
    }
    return config;
}, function (error) {
    console.log('unauthorized, logging out ...');
    // Do something with response error
    /*if (error.response.status === 401) {

        auth.logout();
        router.replace('/auth/login');
    }*/
    return Promise.reject(error.response);
});
if(typeof localStorage['clientToken'] === 'undefined') {
    // установка клиента
    store.dispatch('initSecretApi').then(function (token) {
        localStorage['clientToken'] = token.data.token;
    });
}

if(typeof localStorage['userToken'] !== 'undefined') {
    // установка клиента
    store.dispatch('appNotification/loadCountNotification');
}

Vue.use(VueRouter);


const app = new Vue({
    store,
    router
}).$mount('#app');

export default app;

