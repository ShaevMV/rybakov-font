import VueRouter from 'vue-router';
import store from './store/index';

import adminRoutes from "./router/admin.js";
import frontRoutes from "./router/front.js";

const router = new VueRouter({
    mode: 'history',
    routes: [...frontRoutes, ...adminRoutes],
});


/**
 * Проверяем наличие маршрута и права доступа
 */
router.beforeEach((to, from, next) => {
    let token = (localStorage['userToken'] !== undefined && localStorage['userToken'] !== '');

    $('html, body').animate(
        {scrollTop: $("body").offset().top},
        800
    );
    // Очистить сообщения об ошибках
    store.dispatch('clearErrorMessage');
    // очистить глобальное сообщения
    store.dispatch('clearGlobalMessage');

    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('userToken') == null) {
            next({
                path: '/login',
                query: {
                    nextUrl: to.fullPath,
                }
            });
        } else{
            let user = JSON.parse(localStorage.getItem('userData'));

            if (to.matched.some(record => record.meta.role_id)){
                if(to.meta.role_id.indexOf(user.role_id) !== -1){
                    next()
                }
                else{
                    next({ name: 'notAccess'})
                }
            }
            next()
        }
    } else if(to.matched.some(record => record.meta.guest)) {
        if(!token){
            next();
        }
        else{
            next({ path: '/'});
        }
    }else {
        next()
    }
});

export default router;
