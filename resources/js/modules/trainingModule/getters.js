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
 * Вывести список сертификатов
 *
 * @param state
 * @returns {string}
 */
export const getListCertificats = state => {
    return state.listCertificate;
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


/**
 * Вывести список доступных уровней у определенного направления
 *
 * @param state
 * @returns {string}
 */
export const getListLevelsType = state => type => {
    return state.level[type];
};

/**
 * Проверить наличие начатого направления
 *
 * @param state
 * @return {function(*)}
 */
export const isListLevels = state => type => {
    return typeof state.level[type] !== 'undefined' && state.level[type].length > 0;
};

/**
 * Вывести список уровней
 *
 * @param state
 * @return {{}|state.level}
 */
export const getLevelsList = state => {
    return state.level;
};

/**
 * Вывести детальную информацию по уровню
 *
 * @param state
 */
export const getMoreDetailsForLevel = state => level => {
    let result = _.find(state.level,function (item) {
        return item.number === level
    })['more_details'];
    return result !== null ? result['text'] : '';
};