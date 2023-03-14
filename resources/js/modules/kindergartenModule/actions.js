import axios from 'axios';


/**
 * Загрузить список детских садов
 *
 * @param context
 * @param payload
 */
export const loadKindergartenList = (context, payload) => {
    let promise = axios.get(`/api/v1/kindergarten/getList`);
    promise.then(function (response) {
        context.commit('setKindergartensList', response.data.list);
        console.log(typeof payload.next);
        if(typeof payload.next !== 'undefined'){
            payload.next();
        }
    })
};

/**
 * Сохранить координты для детского сада
 *
 * @param context
 * @param payload
 * @return {Promise<AxiosResponse<T>>}
 */
export const saveKindergarten = (context, payload) => {
    axios.post(`/api/v1/kindergarten/saveCoordinates/${payload.id}`,{
        long: payload.long,
        width: payload.width,
    }).then(function () {
        if(typeof payload.callback !== 'undefined'){
            payload.callback()
        }
    }).catch(function (error) {
        context.commit('setError',  error.response.data.errors,{root: true});
    });
};