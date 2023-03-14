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
 * Получить роль пользователя
 *
 * @param state
 * @param getters
 * @returns {string|null}
 */
export const getRole = (state, getters) => {
    return getters.getUser !== null ? getters.getUser['role_id'] : null
};

/**
 * Проверка на администратора
 *
 * @param state
 * @param getters
 */
export const isAdmin = (state, getters) => {
    return getters.getUser !== null && getters.getUser['role_id'] === 1
};

/**
 * Получить идентификатор пользователя
 *
 * @param state
 * @param getters
 * @returns {Number|Null}
 */
export const getUserId = (state, getters) => {
    return getters.getUser !== null ? getters.getUser['id'] : null
};

/**
 * Получить имя пльзователя
 *
 * @param state
 * @param getters
 * @return {string|null}
 */
export const getUserName = (state, getters) => {
    return getters.getUser !== null ? getters.getUser['name'] : null
};

/**
 * Получить имя пльзователя
 *
 * @param state
 * @param getters
 * @return {string|null}
 */
export const getUserEmail = (state, getters) => {
    return getters.getUser !== null ? getters.getUser['email'] : null
};


/**
 * Получить данные пользователя
 *
 * @param state
 * @return {object}
 */
export const getUser = state => {
    return Object.keys(state.user).length !== 0 ? state.user : JSON.parse(localStorage.getItem('userData'));
};

/**
 * Получить данные пользователя
 *
 * @param state
 * @param getters
 * @return {object}
 */
export const getUserForRequest = (state, getters) => {
    return _.cloneDeep(getters.getUser);
};


/**
 * Права доступа на страницу
 *
 * @param state
 * @return {boolean}
 */
export const isAccess = state => {
    return state.access
};

/**
 * Проверка того, что пользователь автризован
 *
 * @return {boolean}
 */
export const isAuthenticated = () => {

    return !!localStorage['userToken'];
};





/**
 * Вывести название направления
 *
 * @param state
 * @return {string}
 */
export const getDirectName = state => type => {
    switch (type){
        case 'NOKDO':
            return 'НОК ДО';
        case 'ECERS':
            return 'ECERS';
    }
};

/**
 * Выдать модальноо сообщение
 *
 * @param state
 * @return {string}
 */
export const getMessageModal = state => {
    return state.messageModal;
};

