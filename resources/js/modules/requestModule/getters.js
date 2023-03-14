export const getError = state => type => {
    if (state.dataError !== undefined && state.dataError[type] !== undefined) {
        if (typeof state.dataError[type] === "object") {
            return state.dataError[type][0];
        }
        return state.dataError[type];
    }
    return '';
};


/**
 * Вывести заявку на офлайн обучение в нужном уровне
 *
 * @param state
 * @return {function(*)}
 */
export const getRequestTrainingGroup = state => levelNumber => {
    return state.groupList[levelNumber];
};

/**
 * Вывести список групп
 *
 * @param state
 * @return {function(*)}
 */
export const getGroupList = (state) => {
    return state.groupList;
};

/**
 * Вывести список групп с экспертами
 * @param state
 * @return {Array}
 */
export const getGroupListinExpert = (state) => {
    return _.filter(state.groupList, function (item) {
        return item.expert_id !== null
    });
};

/**
 * Вывести список заявок
 *
 * @param state
 * @return {Array}
 */
export const getRequestList = state => {
    return state.requestList;
};

/**
 * Проверить наличие завершоного этапа у пользователя
 *
 * @param state
 * @return {bool}
 */
export const isTrainingLevel = state => params => {
    return typeof state.progressUser[params.level] !== 'undefined' &&
        typeof state.progressUser[params.level][params.stage] !== 'undefined';
};

