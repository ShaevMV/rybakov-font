import App from './components/App.vue' // стартовый компонент
import Header from './components/Header/Header.vue'; // шапка сайта
import auth from './components/Auth/AuthModal.vue'; // форма авторизации
import HeaderUser from './components/Header/UserData.vue'; // Данные пользователя
import VueCarousel from '@chenfengyuan/vue-carousel';
import Vue from 'vue'
//админка
import AdminApp from './components/Admin/AdminApp.vue' // стартовый компонент


Vue.component(VueCarousel.name, VueCarousel);
Vue.component('Header', Header);
Vue.component('HeaderUser', HeaderUser);
Vue.component('app', App);
Vue.component('auth', auth);


Vue.component('AdminApp', AdminApp);








/*
import MobileMenu from './components/Mobile-menu.vue'; // меню в уменьшенной версии
import SiteMenu from './components/Menu.vue'; // меню
import Sidebar from './components/Sidebar.vue'; // Sidebar



import Pagination from "./components/Pagination.vue"; // пагинация на странице

import Delete from "./components/Delete.vue" // удаление определённого элемента

import Users from './components/User/Users.vue'; // список пользователей
import CreateUser from "./components/User/CreateUser.vue"; // создать пользователя

import Documents from './components/Documents/Documents.vue'; // список документов
//import Inbox from './components/Documents/Inbox.vue'; // Входящие документы
import CreateDocument from './components/Documents/Create.vue'; // форма для создания документа
import Monitoring from './components/Documents/Monitoring.vue'; // мониторинг
import DocumentStatus from './components/Documents/Document-status.vue'; // расширенный статус


import Companies from './components/Company/Companies.vue'; // список компаний
import CreateCompany from "./components/Company/CreateCompany.vue"; // создать компанию




//Vue.component('Inbox', Inbox);
Vue.component('Documents', Documents);
Vue.component('Sidebar', Sidebar);
Vue.component('Users', Users);

Vue.component('MobileMenu', MobileMenu);
Vue.component('CreateUser', CreateUser);
Vue.component('CreateDocument', CreateDocument);
Vue.component('Companies', Companies);

Vue.component('SiteMenu', SiteMenu);
Vue.component('Monitoring', Monitoring);
Vue.component('CreateCompany', CreateCompany);
Vue.component('CreateUser', CreateUser);
Vue.component('Pagination', Pagination);
Vue.component('DocumentStatus', DocumentStatus);
Vue.component('Delete', Delete);*/
