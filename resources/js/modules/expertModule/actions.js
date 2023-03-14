import axios from 'axios';


/**
 * Загрузить список экпертов
 *
 * @param context
 */
export const loadExpertsList = (context) => {
    let promise = axios.get('/api/v1/expert/getExpertsList');
    promise.then(function (response) {
        context.commit('setExperts', response.data.experts);
    })
};



/**
 * Добавить эксперта
 *
 * @param context
 * @param payload
 */
export const addExpert = (context, payload) => {
    let promise = axios.post('/api/v1/expert/add', payload.user);
    promise.then(function () {
        context.dispatch('loadExpertsList');
        payload.callback();
    }).catch(function (error) {
        context.commit('setError',  error.response.data.errors,{root: true});
    });
};

/**
 * Удалить пользователя
 *
 * @param context
 * @param payload
 */
export const deleteUser = (context, payload) => {
    let promise = axios.delete('/api/v1/user/' + payload);
    promise.then(function () {
        context.dispatch('loadExpertsList');
    })
};

/**
 * Записать мнение эксперта
 *
 * @param context
 * @param payload
 */
export const setExpertOpinion = (context, payload) => {
    return axios.post(`/api/v1/group/setExpertOpinion/${payload.training_id}`, payload.data);
};

/**
 * Открыть доступ к тестированию
 *
 * @return {Promise<AxiosResponse<T>>}
 */
export const openTestingForUser = (context, payload) => {

    let promise = axios.post('/api/v1/group/openTestingForUser', {
        id: payload.request.id,
        updateType: typeof payload.updateType !== 'undefined' ? payload.updateType : ''
    });
    promise.then(function () {
        payload.request.check = true;
    })
};
