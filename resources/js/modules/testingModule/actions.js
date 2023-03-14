import axios from 'axios';
import _ from 'lodash';

/**
 * Загрузить список вопросов
 *
 * @param context
 * @param payload
 */
export const loadListQuestions = (context, payload) => {
    let promise = axios.get('/api/v1/testing/loadQuestions/' + payload.type + '/' + payload.level + '/' + context.rootState.page);
    promise.then(async function (response) {
        await context.commit('setQuestions', response.data.questions.data);
        context.commit('setTesting', response.data.testing);
        context.commit('setDirectionName', response.data.directionName);
        await context.commit('setPagination', response.data.questions);

        context.commit('setItemQuestions', context.getters.getParamsForNewQuestions(response.data.testing.type));
        if (typeof payload.next !== 'undefined') {
            payload.next();
        }

    });
};


/**
 * Загурзить тест с ответами пользователя
 *
 * @param context
 * @param payload
 */
export const loadUserAnswer = (context, payload) => {
    let promise = axios.get(`/api/v1/testing/loadUserAnswer/${payload.trainingId}`);
    promise.then(async function (response) {
        await context.commit('setQuestions', response.data.questions);
        context.commit('setTesting', response.data.testing);
        context.commit('setDirectionName', response.data.directionName);
        await context.commit('setPagination', response.data.questions);
        context.commit('setTraining', response.data.training);

    })
};

/**
 * Очистить пользовательский прогресс
 *
 * @param context
 */
export const clearUserAnswer = (context) => {
    context.commit('setQuestions', []);
    context.commit('setTesting', {});
    context.commit('setTraining', {});
};

/**
 * Выбрать страницу
 *
 * @param context
 * @param payload
 */
export const changePage = async (context, payload) => {
    await context.commit('setPage', payload,{root:true});
    context.dispatch('loadListQuestions', {
        type: context.rootState.selectDirection,
        level: context.rootState.selectLevel
    });
};


/**
 * Следующая страница
 *
 * @param context
 */
export const nextPage = (context) => {
    if (context.state.pagination.current_page < context.state.pagination.last_page) {
        context.dispatch('changePage', context.state.pagination.current_page + 1);
    }
};


/**
 * Предыдущая страница
 *
 * @param context
 */
export const backPage = (context) => {
    if (context.state.pagination.current_page > 1) {
        context.dispatch('changePage', context.state.pagination.current_page - 1);
    }
};

/**
 * Предыдущая страница
 *
 * @param context
 */
export const clearAnswered = (context) => {
    context.commit('setCountAnswered', 0);
};

/**
 * Записать ответ на вопрос
 *
 * @param context
 * @param payload
 */
export const setAnswerOptions = (context, payload) => {
    payload['testId'] = context.state.testing.id;
    let promise = axios.post('/api/v1/testing/setAnswerOptions', payload);
    promise.then(async function (response) {
        let listQuestions = _.filter(context.state.listQuestions, function (item) {
            if (item.id === payload.idQuestions) {
                item.answer_user = response.data.answer
            }
            return true;
        });

        await context.commit('setQuestions', listQuestions);
    });
};

/**
 * Отправить тест на проверку
 *
 * @param context
 */
export const submitTesting = (context) => {
    if (typeof context.state.testing['id'] !== undefined) {
        let promise = axios.post('/api/v1/testing/submit', {testId: context.state.testing.id});
        promise.then(function (response) {
            context.commit('setMessageModal', response.data.message,{
                root: true
            });
            UIkit.modal("#ModalCompleted").show();
        }).catch(function (error) {
            context.commit('setCountAnswered', error.response.data.countNotAnswered);
            UIkit.modal("#modalErrorTesting").show();
        });
    }
};

/**
 * Удалить вопрос
 *
 * @param context
 * @param payload
 */
export const questionsDelete = (context, payload) => {
    let promise = axios.delete(`/api/v1/testing/delete/${payload.id}`);
    promise.then(function () {
        if(typeof payload.callback!=='undefined'){
            payload.callback();
        }
    });

};
/**
 * Обновить описание теста
 *
 * @param context
 * @param payload
 */
export const updateTestingDescription = (context, payload) => {
    let promise = axios.post(`/api/v1/testing/update/${payload.id}`,payload.data);
    promise.then(function () {
        if(typeof payload.callback!=='undefined'){
            payload.callback();
        }
    }).catch(function (error) {
        if (typeof error.response.data.errors !== 'undefined') {
            context.commit('setError', error.response.data.errors,{root: true});
        } else {
            console.error(error.response.data)
        }
    });
};
/**
 * Сохранить вопрос в тесте
 *
 * @param context
 * @param payload
 */
export const saveQuestions = (context, payload) => {
    let promise = axios.post(`/api/v1/testing/saveQuestions/${payload.type}/${payload.id}`, {
        data:payload.data,
        typeQuestion: payload.typeQuestion
    });
    promise.then(function () {

        if(typeof payload.callback !== 'undefined') {
            payload.callback();
        }
    }).catch(function (error) {
        if (typeof error.response !== 'undefined') {
            context.commit('setError', error.response.data.errors,{root: true});
        } else {
            console.error(error)
        }

    });
};

/**
 * Отправить результаты теста на почту
 *
 * @param context
 * @param payload
 */
export const pushTestingInEmail = (context, payload) => {
    let promise = axios.post(`/api/v1/testing/pushInEmail/${payload.type}/${payload.idTesting}`);
    promise.then(function (response) {
        context.commit('setMessageModal', response.data.message,{
            root: true
        });
        if(typeof payload.callback !== 'undefined'){
            payload.callback();
        }
    }).catch(function (error) {
        if(typeof payload.errorCallback !== 'undefined'){
            payload.errorCallback();
        }
    });;
};

/**
 * Выбрать вопрос для редактирования
 *
 * @param context
 * @param payload
 */
export const selectQuestions = (context, payload) => {
    let result = _.cloneDeep(payload.question);
    result.options = typeof result.options !== 'undefined' ? JSON.parse(result.options): context.detters.getItemQuestions;
    context.commit('setItemQuestions', result);
};

/**
 * Добавить вариант ответа
 *
 * @param context
 */
export const addPossibleAnswer = (context) => {
    context.commit('setOptionsQuestions', {
        answer: '',
        isRight: "false",
    });
};

export const validateTesting = (context, payload) => {
    let promise = axios.get(`/api/v1/testing/validUserAnswer/${payload.idTesting}`);
    promise.then(function () {
        if(typeof payload.callback !== 'undefined'){
            payload.callback();
        }
    }).catch(function (error) {
        if(typeof payload.errorCallback !== 'undefined'){
            payload.errorCallback();
        }
    });
};