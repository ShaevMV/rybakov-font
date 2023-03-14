export const setError = (state, payload) => {
    state.dataError = payload;
};

/**
 * Запись меню
 * @param state
 * @param payload
 */
export const setListPlatform = (state, payload) => {
        state.listPlatforms = payload.list;
    };


