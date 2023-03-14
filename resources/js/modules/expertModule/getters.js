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
 * Вывести список экспертов
 *
 * @param state
 * @returns {Array}
 */
export const getExpertList = state => {
    return state.expertList;
};


/**
 * Вывести список пользователей
 *
 * @param state
 * @returns {Array}
 */
export const getUserList = state => {
    return state.userList;
};

