import Vue from 'vue';
import Vuex from 'vuex';
import VueAxios from 'vue-axios';
import axios from 'axios'

import * as actions from './actions';
import * as getters from './getters';
import * as mutations from './mutations';
// модули
import appLogin from '../modules/loginModule/index';
import appStatic from '../modules/staticModule/index';
import appWidgets from '../modules/widgetsModule/index';
import appLesson from '../modules/lessonModule/index';
import appTesting from '../modules/testingModule/index';
import appRequest from '../modules/requestModule/index';
import appExpert from '../modules/expertModule/index';
import appKindergarten from '../modules/kindergartenModule/index';
import appTraining from '../modules/trainingModule/index';
import appNotification from '../modules/notificationModule/index';

Vue.use(Vuex, VueAxios, axios);

const store = new Vuex.Store({
    state: {
        /**
         * @type boolean права доступа к ресурсу
         */
        access: false,
        /**
         * @type string токен приложения
         */
        clientToken: '',
        /**
         * @type object Данные о пользователе
         */
        user: {},
        /**
         * @type string Токен пользователя
         */
        token: localStorage.getItem('userToken') || '',
        /**
         * @type Object Данные для пагинации
         */
        page: 1,
        /**
         * @type number|null Выбранный уровень
         */
        selectLevel: null,
        /**
         * @type string|null  Выбранное направление
         */
        selectDirection: null,
        /**
         * @type string|null  Выбранное направление
         */
        selectDirectionName: null,
        /**
         * @type string|null  Сообщение в модальном окне
         */
        messageModal: null,
        /**
         * @type Number  Кол-во уведомлений
         */
        countNotifications: 0,
        /**
         * @type array  Уведомления
         */
        notificationsList: [],
        /**
         * @type object <array>  Список ошибок валидации
         */
        dataError: {},
    },
    mutations,
    getters,
    actions,
    modules: {
        'appLogin': appLogin,
        'appStatic': appStatic,
        'appWidgets': appWidgets,
        'appLesson': appLesson,
        'appTesting': appTesting,
        'appRequest': appRequest,
        'appExpert' : appExpert,
        'appTraining' : appTraining,
        'appNotification' : appNotification,
        'appKindergarten' : appKindergarten,
        /*'appMenu': appMenu,
        'appCompany': appCompany,
        'appDocument': appDocument,*/

    }
});

export default store;
