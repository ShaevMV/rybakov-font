import * as getters from './getters';
import * as actions from './actions';
import * as mutations from './mutations';

export default {
    namespaced: true,
    state: {
        /**
         * @type Object список ошибок
         */
        dataError: {},
        /**
         * @type Object список вопосов в тесте
         */
        listQuestions: {},
        /**
         * @type Object Данные о тесте
         */
        testing : {},
        /**
         * @type Object Данные о пагинации
         */
        pagination: {},
        /**
         * @type String Название направления
         */
        directionName: '',
        /**
         * @type Number Выбранная страница
         */
        page: 1,
        /**
         * @type Number Количество неотвеченных вопросов
         */
        countAnswered: 0,
        /**
         * @type Object  Стартовые занчения для нового вопроса
         */
        itemQuestions: {},
        /**
         * @type Object данные об прохождение теста
         */
        training: {},

    },
    getters,
    actions,
    mutations
};
