import Vue from 'vue';
import RootAdmin from '../components/Admin/RootAdmin.vue';
import WidgetsAdmin from '../components/Admin/Widgets/ListWidgets.vue';
import ExpertAdmin from '../components/Admin/Experts/Experts.vue';
import RequestAdmin from '../components/Admin/Request/RequestAdmin.vue';
import LessonsAdmin from '../components/Admin/Lessons/List';
import LessonsEdit from '../components/Admin/Lessons/Edit';
import TestingAdmin from '../components/Admin/Testing/ListQuestions.vue';
import PlatformsAdmin from '../components/Admin/Platforms/ListPlatforms.vue';
import ListCertificate from "../components/Admin/Сertificate/ListCertificate.vue";
import ListCoordinate from "../components/Admin/Map/ListCoordinate.vue";
import MoreDetailisList from "../components/Admin/MoreDetails/MoreDetailsList.vue";
import CreateTask from '../components/Admin/Lessons/CreateTask.vue';


Vue.component('RootAdmin', RootAdmin);
Vue.component('WidgetsAdmin', WidgetsAdmin);
Vue.component('ExpertAdmin', ExpertAdmin);
Vue.component('RequestAdmin', RequestAdmin);
Vue.component('LessonsAdmin', LessonsAdmin);
Vue.component('LessonsEdit', LessonsEdit);
Vue.component('TestingAdmin', TestingAdmin);
Vue.component('PlatformsAdmin', PlatformsAdmin);
Vue.component('ListCertificate', ListCertificate);
Vue.component('ListCoordinate', ListCoordinate);
Vue.component('MoreDetailisList', MoreDetailisList);
Vue.component('CreateTask', CreateTask);




const ROOT_URL = '/';
const ROOT_ADMIN = 'admin';
const ADMIN_ROLE = 1;


let routes = [
    // главной страницы
    {
        path: ROOT_URL + ROOT_ADMIN,
        component: RootAdmin,
        name: 'rootAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // витжеты
    {
        path: ROOT_URL + ROOT_ADMIN + '/widgets',
        component: WidgetsAdmin,
        name: 'widgetsAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // уроки
    {
        path: ROOT_URL + ROOT_ADMIN + '/lessons/:type',
        component: LessonsAdmin,
        name: 'LessonsAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // редактирование уроков
    {
        path: ROOT_URL + ROOT_ADMIN + '/lesson/edit/:id',
        component: LessonsEdit,
        name: 'lessonsEdit',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // редактирование задания
    {
        path: ROOT_URL + ROOT_ADMIN + '/lesson/task/:id/:task',
        component: CreateTask,
        name: 'editTask',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        },
        beforeEnter: (to, from, next) => {
            store.dispatch('appLesson/getTask', {
                id: to.params.task,
                next: next
            });
        },
    },
    // создание задачи для урока
    {
        path: ROOT_URL + ROOT_ADMIN + '/lesson/create/:id',
        component: CreateTask,
        name: 'createTask',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        },
        beforeEnter: (to, from, next) => {
            store.dispatch('appLesson/clearTask', {
                id: to.params.task
            });
            next();
        },
    },
    // эксперты
    {
        path: ROOT_URL + ROOT_ADMIN + '/experts',
        component: ExpertAdmin,
        name: 'expertAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // Заявки
    {
        path: ROOT_URL + ROOT_ADMIN + '/request/:type/:level?',
        component: RequestAdmin,
        name: 'requestAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // Тесты
    {
        path: ROOT_URL + ROOT_ADMIN + '/testing/:type/:level',
        component: TestingAdmin,
        name: 'testingAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // Платформы
    {
        path: ROOT_URL + ROOT_ADMIN + '/platforms',
        component: PlatformsAdmin,
        name: 'PlatformsAdmin',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // Сертификаты
    {
        path: ROOT_URL + ROOT_ADMIN + '/certificate',
        component: ListCertificate,
        name: 'listCertificate',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // Координаты на катре
    {
        path: ROOT_URL + ROOT_ADMIN + '/map',
        component: ListCoordinate,
        name: 'listCoordinate',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
    // Подробнее
    {
        path: ROOT_URL + ROOT_ADMIN + '/moreDetails/:type',
        component: MoreDetailisList,
        name: 'moreDetailisList',
        meta: {
            requiresAuth: true,
            role_id: [ADMIN_ROLE]
        }
    },
];

export default routes;