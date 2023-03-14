export const setError = (state, payload) => {
    state.dataError = payload;
};




/**
 * Запись списка экспертов
 *
 * @param state
 * @param payload
 */
export const setExperts = (state, payload) => {
    state.expertList = payload;
};


/**
 * Запись списка пользователей
 *
 * @param state
 * @param payload
 */
export const setUsers = (state, payload) => {
    state.userList = payload;
};

/**
 * Записать списка заявок
 *
 * @param state
 * @param payload
 */
export const setRequestList = (state, payload) => {
    state.requestList = payload;
};

/**
 * Записать списка групп для заявок
 *
 * @param state
 * @param payload
 */
export const setGroupRequest = (state,payload) => {
    state.groupRequestList = payload;
};