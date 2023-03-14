import _ from 'lodash';

export const getError = state => type => {
    if(state.dataError !== undefined && state.dataError[type] !== undefined){
        if(typeof state.dataError[type] === "object"){
            return state.dataError[type][0];
        }
        return state.dataError[type];
    }
    return '';
};


/**
 * Вывести список вопросов
 *
 * @param state
 * @return {{}|state.listQuestions}
 */
export const getListQuestions = state => {
    return state.listQuestions;
};


/**
 * Вывести стартовые значения для вопроса
 *
 * @param state
 * @return {Object}
 */
export const getItemQuestions = state => {
    return state.itemQuestions;
};

/**
 * Проверка что пользователь выбрал этот вариант ответа
 *
 * @param state
 * @return {function(*)}
 */
export const isChecked = state => params => {
    let idQuestions = params.idQuestions;
    let answer = params.answer;
    let result = _.filter(state.listQuestions, function  (item) {
        if(item.id === idQuestions){
            if(item.answer_user!==null){
                let answerUser = JSON.parse(item.answer_user.answer);
                return answerUser.indexOf(answer) !== -1;
            }
        }
        return false;
    });
    return result.length > 0;
};

/**
 * Вывести ответ на вопрос
 *
 * @param state
 * @return {function(*)}
 */
export const getAnswer = state => idQuestions => {
    let result = _.find(state.listQuestions, function (item) {
        return item.id === idQuestions;
    });
    return result.answer_user!==null ? JSON.parse(result.answer_user.answer)[0] : '';
};
/**
 * Вывести название направления
 *
 * @param state
 * @returns {string}
 */
export const getDirectionName = state => {
    return state.directionName;
};

/**
 * Вывести данные теста
 *
 * @param state
 * @return {Object}
 */
export const getTesting = state => {
    return state.testing;
};


/**
 * Вывести массив начала пагинации
 *
 * @param state
 * @return {{}}
 */
export const getPagesStartList = (state) => {
    let pagesStart = [];

    let end = state.pagination.current_page > 6 ?
        ((state.pagination.current_page - 3) > 3 ? 3 : state.pagination.current_page - 3) :
        (state.pagination.last_page >= 5 ? 5 : state.pagination.last_page);
    for (let i = 1; i <= end; i++) {
        pagesStart.push({
            number: i,
            active: state.pagination.current_page === i,
        });
    }
    return pagesStart;
};

/**
 * Вывести массив середины пагинации
 *
 * @param state
 * @return {{}}
 */
export const getPagesMiddleList = (state) => {
    let pagesMiddle = [];
    if (state.pagination.current_page > 5 && state.pagination.current_page < state.pagination.last_page - 6) {

        for (let i = state.pagination.current_page - 1; i <= state.pagination.current_page + 1; i++) {
            pagesMiddle.push({
                number: i,
                active: state.pagination.current_page === i,
            });
        }
    }
    return pagesMiddle;
};


/**
 * Вывести массив последней части пагинации
 *
 * @param state
 * @return {{}}
 */
export const getPagesEndList = (state) => {
    let pagesEnd = [];
    if (state.pagination.last_page > 6) {
        let start = state.pagination.current_page >= state.pagination.last_page - 6 ? state.pagination.last_page - 6 : state.pagination.last_page - 5;
        for (let i = start; i <= state.pagination.last_page; i++) {
            pagesEnd.push({
                number: i,
                active: state.pagination.current_page === i,
            });
        }
    }
    return pagesEnd;
};

/**
 * Вывести данные пагинации
 *
 * @param state
 * @return {Object}
 */
export const dataForPagination = (state) => {
    return state.pagination;
};

/**
 * Вывести кол-во неотвеченых вопросов
 *
 * @param state
 * @return {Number}
 */
export const getCountAnswered = (state) => {
    return state.countAnswered;
};

/**
 * Вывести данные о тесте
 *
 * @param state
 * @return {Object}
 */
export const getTestingData = (state) => {
    return state.testing;
};

/**
 * Вывести первоначальные параметры для создание нового вопроса
 *
 * @param state
 * @return {{type: string, text: string, options: Array}}
 */
export const getParamsForNewQuestions = (state) => (type) =>  {
    return {
        type: type !== 'testing' ? 'text': 'testing',
        text:'',
        options:[]
    };
};

/**
 * Получить данные об прохождении теста
 *
 * @param state
 * @return {Object}
 */
export const getTraining = (state) => {
    return state.training;
};