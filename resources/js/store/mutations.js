export const setError = (state, payload) => {
    state.dataError = payload;
};

/**
 * Записать данные пользователя
 *
 * @param state
 * @param payload
 */
export const setUserData = (state, payload) => {
    state.user = payload
};

/**
 * Записать токен для приложения
 *
 * @param state
 * @param payload
 */
export const setClientToken = (state, payload) => {
    state.clientToken = payload;
};

/**
 * Записать права доступа к странице
 *
 * @param state
 * @param payload
 */
export const setAccess = (state, payload) => {
    state.access = payload;
};

/**
 * Запись кол-во выводимых записей на странице
 *
 * @param state
 * @param payload
 */
export const setCountPage = (state, payload) => {
    state.pagination.count = payload;
};

/**
 * Перейти на определенную страницу
 *
 * @param state
 * @param payload
 */
export const setPage = (state, payload) => {
    state.page = payload;
};

/**
 * Запись общего количества элементов, для пагинации
 *
 * @param state
 * @param payload
 */
export const setAllPagination = (state, payload) => {
    state.pagination.all = payload;
};

/**
 * Запись общего количества элементов, для пагинации
 *
 * @param state
 */
export const clearPagination = (state) => {
    state.pagination = {
        all: 0,
        page: 1,
        count: 10
    };
};

/**
 * Записать выбранное направление
 *
 * @param state
 * @param payload
 */
export const setDirection = (state, payload) => {
    state.selectDirection = payload;
};

/**
 * Записать уровень
 *
 * @param state
 * @param payload
 */
export const setLevel = (state, payload) => {
    state.selectLevel = payload
};

/**
 * Записать модальное сообщение
 *
 * @param state
 * @param payload
 */
export const setMessageModal = (state, payload) => {
    state.messageModal = payload
};
