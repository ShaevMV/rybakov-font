import * as getters from './getters';
import * as actions from './actions';
import * as mutations from './mutations';


/**
 *  Модуль работы с заявками
 */
export default {
    namespaced: true,
    state: {
        dataError: {},
        groupTraining: {}, //
        requestList: [],
        groupRequestList: [],
        groupList: [],
    },
    getters,
    actions,
    mutations
};