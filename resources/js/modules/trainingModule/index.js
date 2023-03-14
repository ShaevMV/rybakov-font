import * as getters from './getters';
import * as actions from './actions';
import * as mutations from './mutations';

export default {
    namespaced: true,
    state: {
        listCertificate: [], // список сертификатов
        progressUser: {}, // прогресс по обучению
        level: {},
        dataError: {},
        detailsList: {} // Детальная информация
    },
    getters,
    actions,
    mutations
};