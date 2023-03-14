import * as getters from './getters';
import * as actions from './actions';
import * as mutations from './mutations';


/**
 *  Модуль работы с заявками
 */
export default {
    namespaced: true,
    state: {
        /**
         * @type Number  Кол-во уведомлений
         */
        countNotifications: 0,
        /**
         * @type array  Уведомления
         */
        notificationsList: [],
    },
    getters,
    actions,
    mutations
};
