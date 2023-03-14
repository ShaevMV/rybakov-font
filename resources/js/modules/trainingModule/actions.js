import axios from 'axios';


/**
 * Загрузить список сертификатов
 *
 * @param context
 */
export const loadCertificate = (context) => {
    let promise = axios.get('/api/v1/certificate');
    promise.then(function (response) {
        context.commit('setCertificate', response.data);
    });
};


/**
 * Загрузить список доступных уровней по определённому направлению
 *
 * @param context
 * @param payload
 * @return {Promise<void>}
 */
export const getAvailableLevel = async (context, payload) => {
    let promise = axios.get('/api/v1/level/getAvailable/' + payload.type);
    await promise.then(async function (response) {
        await context.commit('setAvailableLevel', response.data.progress);
        context.commit('setAvailableLevelAll', response.data.level);

    });
};

/**
 * Загрузить список доступных уровней по всем направлениям
 *
 * @param context
 */
export const getAvailableLevelAll = async (context) => {
    let promise = axios.get('/api/v1/level/getAvailableAll');
    await promise.then(function (response) {
        context.commit('setAvailableLevelAll', response.data);
    });
};

/**
 * Загрузить список всех сертификатов
 *
 * @param context
 */
export const loadCertificateAll = (context) => {
    let promise = axios.get('/api/v1/certificateAll');
    promise.then(async function (response) {
        context.commit('setCertificate', response.data);
    });
};

/**
 * Загрузить список уровней с детальной информацией
 *
 * @param context
 * @param payload
 */
export const loadDetailsList = (context, payload) => {
    let promise = axios.get(`/api/v1/level/moreDetailsList/${payload.type}`);
    promise.then(function (response) {
        context.commit('setAvailableLevelAll', response.data);
    });
};

/**
 * Обновить детальную информацию
 *
 * @param context
 * @param payload
 */
export const updateMoreDetails = (context, payload) => {
    let promise = axios.post(`/api/v1/level/updateMoreDetail/${payload.id}`,{
        text: payload.text
    });
    promise.then(function (response) {
        if(typeof payload.callback !== 'undefined'){
            payload.callback();
        }
    });
};

