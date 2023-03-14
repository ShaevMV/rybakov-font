export const setError = (state, payload) => {
    state.dataError = payload;
};

/**
 * Записать данные о заявке на офлайн обучение
 *
 * @param state
 * @param payload
 */
export const setGroupList = (state, payload) => {
    state.groupList = payload;
};


/**
 * Записать данные о заявке на офлайн обучение
 *
 * @param state
 * @param payload
 */
export const setGroupTraining = (state, payload) => {
    state.groupTraining = payload;
};

/**
 * Записать список заявок
 *
 * @param state
 * @param payload
 */
export const setRequestList = (state, payload) => {
    state.requestList = payload;
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