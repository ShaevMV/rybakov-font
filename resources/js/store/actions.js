import axios from 'axios'

/**
 * Получение токена клиента
 *
 * /@param context
 */
export const initSecretApi = () => {
    return axios.get('/api/v1/getClientToken')
};

/**
 * Получение данных о пользователе
 *
 * @param context
 */
export const initDataUser = async (context) => {
    let promise = axios.get('/api/v1/user/getUserData');
    await promise.then(async response => {
        localStorage.setItem('userData',JSON.stringify(response.data.user));
        context.commit('setUserData', await response.data.user);
    });
    promise.catch(error => {
        if(error.response.status === 401){
            localStorage.setItem('userToken','');
            //location.reload();
            console.log(error.response.status);
        }

    });
};

/**
 * Проверка доступа к странице
 *
 * @param context
 * @param payload
 */
export const isAccess = (context, payload) => {
    let params = {
        url: payload.name,
    };
    if (params.url !== '/lk') {
        let promise = axios.post('/api/v1/isAccess', params);
        promise.then(response => {
            if (response.data['access'] === false) {
                payload.next({name: '/lk/NotAccess'});
            } else {
                payload.next();
            }
        });

    } else {
        payload.next();
    }
};

/**
 * Изменить кол-во выводимых записей на странице
 *
 * @param context
 * @param payload
 */
export const changeCountInPage = (context, payload) => {
    context.commit('setCountPage', payload);
};

/**
 * Изменить текущую страницу
 *
 * @param context
 * @param payload
 */
export const changePage = (context, payload) => {
    context.commit('setPage', payload);
};


/**
 * Обнулить пагинацию
 *
 * @param context
 */
export const clearPagination = (context) => {
    context.commit('clearPagination');
};


/**
 * Записать направление
 *
 * @param context
 * @param payload
 */
export const setTypeDirection = (context, payload) => {
    context.commit('setDirection', payload);
};


/**
 * Записать уровень
 *
 * @param context
 * @param payload
 */
export const setLevel = (context, payload) => {
    context.commit('setLevel', payload);
};

/**
 * очистить глобальное сообщение
 *
 * @param context
 */
export const clearGlobalMessage = (context) => {
    context.commit('setMessageModal', '');
};

/**
 * очистить сообщение о ошибках
 *
 * @param context
 */
export const clearErrorMessage = (context) => {
    context.commit('setError', {});
};