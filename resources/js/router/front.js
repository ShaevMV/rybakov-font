import Vue from 'vue';
import Widgets from '../components/Widgets/Widgets.vue';
import Register from '../components/Auth/Register.vue';
import Cabinet from '../components/PersonalArea/Cabinet.vue'
import NotAccess from "../components/NotAccess.vue";
import NotFound from "../components/NotFound.vue";
import EvalTraining from "../components/Training/EvalTraining.vue";
import PageLesson from "../components/Lesson/Page.vue";
import Test from "../components/Testing/Test.vue";
import GroupRequest from "../components/Expert/GroupRequestList.vue";
import RequestListInGroup from "../components/Expert/RequestListInGroup.vue";
import RequestListKindergarten from "../components/Expert/RequestListKindergarten.vue"
import ViewUserAnswer from "../components/Testing/ViewUserAnswer.vue";
import Notifications from "../components/PersonalArea/Notifications.vue";
import Auth from "../components/Auth/Auth.vue";
import Map from "../components/Other/Map.vue";
import Activation from "../components/Auth/activation.vue";
import ForgotPassword from "../components/Auth/ForgotPassword.vue";
import RestorePassword from "../components/Auth/RestorePassword.vue";


Vue.component('Test', Test);
Vue.component('PageLesson', PageLesson);
Vue.component('Widgets', Widgets);
Vue.component('Register', Register);
Vue.component('Cabinet', Cabinet);
Vue.component('EvalTraining', EvalTraining);
Vue.component('GroupRequest',GroupRequest);
Vue.component('RequestListInGroup', RequestListInGroup);
Vue.component('RequestListKindergarten', RequestListKindergarten);
Vue.component('ViewUserAnswer', ViewUserAnswer);
Vue.component('Notifications', Notifications);
Vue.component('Auth', Auth);
Vue.component('Map', Map);
Vue.component('NotAccess', NotAccess);
Vue.component('NotFound', NotFound);
Vue.component('RestorePassword', RestorePassword);
Vue.component('ForgotPassword', ForgotPassword);
Vue.component('Activation', Activation);

const ROOT_URL = '/';

const ADMIN_ROLE = 1;
const USER_ROLE = 2;
const KINDERGARTEN_ROLE = 3;
const EXPERT_ROLE = 4;

let routes = [
    // получить данные о виджетах
    {
        path: ROOT_URL,
        component: Widgets,
        name: 'widgets',
    },
    // регистрация пользователя
    {
        path: ROOT_URL + 'register',
        component: Register,
        name: 'register',
        meta: {
            guest: true
        }
    },
    // авторизация
    {
        path: ROOT_URL + 'login',
        component: Auth,
        name: 'auth',
        meta: {
            guest: true
        }
    },
    // личный кабинет
    {
        path: ROOT_URL + 'lk',
        component: Cabinet,
        name: 'cabinet',
        meta: {
            requiresAuth: true
        }
    },
    // данные о заявках
    {
        path: ROOT_URL + 'notifications',
        component: Notifications,
        name: 'notifications',
        meta: {
            requiresAuth: true
        }
    },
    // данные о группах заявок эксперта
    {
        path: ROOT_URL + 'group',
        component: GroupRequest,
        name: 'groupRequest',
        meta: {
            requiresAuth: true,
            role_id: [EXPERT_ROLE]
        }
    },
    // данные о группах заявок эксперта детских садов
    {
        path: ROOT_URL + 'groupKindergarten',
        component: RequestListKindergarten,
        name: 'requestListKindergarten',
        meta: {
            requiresAuth: true,
            role_id: [EXPERT_ROLE]
        }
    },
    // Данные об участниках группы
    {
        path: ROOT_URL + 'groupRequest/:groupId',
        component: RequestListInGroup,
        name: 'requestListInGroup',
        meta: {
            requiresAuth: true,
            role_id: [EXPERT_ROLE]
        }
    },
    // данные об обучении
    {
        path: ROOT_URL + 'training/:type',
        component: EvalTraining,
        name: 'evalTraining',
        props: true,
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE,USER_ROLE]
        }

    },
    // тестирование
    {
        path: ROOT_URL + 'testing/:type/:level',
        component: Test,
        name: 'test',
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    // Показать ответы пользователя
    {
        path: ROOT_URL + 'testingView/:training',
        component: ViewUserAnswer,
        name: 'viewUserAnswer',
        props: true,
        meta: {
            requiresAuth: true,
            role_id: [EXPERT_ROLE]
        }
    },
    // урок
    {
        path: ROOT_URL + 'lesson/:type',
        component: PageLesson,
        name: 'pageLesson',
        props: true,
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE,USER_ROLE]
        }
    },
    // карта
    {
        path: ROOT_URL + 'kindergarten',
        component: Map,
        name: 'map',
    },
    // активация емайла
    {
        path: ROOT_URL + 'activation/:id/:token',
        component: Activation,
        name: 'Activation',
        meta: {
            guest: true
        }
    },
    // Восстановления пароля
    {
        path: ROOT_URL + 'forgotPassword',
        component: ForgotPassword,
        name: 'ForgotPassword',
        meta: {
            guest: true
        }
    },
    // Восстановления пароля
    {
        path: ROOT_URL + 'passwordResets/:token',
        component: RestorePassword,
        name: 'RestorePassword',
        meta: {
            guest: true
        }
    },
];

export default routes;