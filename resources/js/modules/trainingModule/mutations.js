export const setError = (state, payload) => {
    state.dataError = payload;
};


/**
 * Запись списка сертификаты
 *
 * @param state
 * @param payload
 */
export const setCertificate = (state, payload) => {
    state.listCertificate = payload;
};

/**
 * Записать прогресс по обучению
 *
 * @param state
 * @param payload
 */
export const setAvailableLevel = (state, payload) => {
    payload.forEach(function (item) {
        if(typeof state.progressUser[item.level_number] === 'undefined'){
            state.progressUser[item.level_number] = {}
        }
        state.progressUser[item.level_number][item.stage_number] = true;
    });
};

/**
 * Запись списка уровней
 *
 * @param state
 * @param payload
 */
export const setAvailableLevelAll = (state, payload) => {
    state.level = payload;
};