import axios from 'axios'

/**
 * Получение меню для пользователя
 *
 * @param context
 */
export const getListPlatform = (context) => {
    new Promise(function () {
        axios.get('/api/v1/platform/getList')
            .then(response => {
                context.commit('setListPlatform', {
                    list: response.data,
                });
            });
    });
};

/**
 * Удалить платформу
 *
 * @param context
 * @param payload
 */
export const deletePlatforms = (context, payload) => {
    axios.delete(`/api/v1/platform/${payload.id}`)
        .then(response => {
            context.dispatch('getListPlatform');
        });
};

/**
 * Добавить платформу
 *
 * @param context
 * @param payload
 */
export const addPlatforms = (context, payload) => {
    axios.post('/api/v1/platform/addPlatforms', payload.platforms)
        .then(response => {
            context.dispatch('getListPlatform');
            if(typeof payload.callback !== 'undefined'){
                payload.callback();
            }
        }).catch(function (error) {
            context.commit('setError', error.response.data.errors,{root: true});
        });
};