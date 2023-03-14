export const setError = (state, payload) => {
    state.dataError = payload;
};



/**
 * Запись списка вопросов
 *
 * @param state
 * @param payload
 */
export const setQuestions = (state, payload) => {
    state.listQuestions = payload;
};

/**
 * Запись описания текста
 *
 * @param state
 * @param payload
 */
export const setTesting = (state, payload) => {
    state.testing = payload;
};


/**
 * Задать стартовые занчения для нового вопроса
 *
 * @param state
 * @param payload
 */
export const setItemQuestions = (state, payload) => {
    state.itemQuestions = payload;
};

/**
 * Запись пагинации
 *
 * @param state
 * @param payload
 */
export const setPagination = async (state, payload) => {
    await delete payload['data'];
    state.pagination = payload;
};

/**
 * Запись названия направления
 *
 * @param state
 * @param payload
 */
export const setDirectionName = (state, payload) => {
    state.directionName = payload;
};


/**
 * Запись названия направления
 *
 * @param state
 * @param payload
 */
export const setPage = (state, payload) => {
    state.page = payload;
};


/**
 * Запись неотвеченных вопросов
 *
 * @param state
 * @param payload
 */
export const setCountAnswered = (state, payload) => {
    state.countAnswered = payload;
};


/**
 * Добавить в вопрос вариант ответа
 *
 * @param state
 * @param payload
 */
export const setOptionsQuestions = (state, payload) => {
    state.itemQuestions.options.push(payload);
};

/**
 * Записать данные о прохождении теста
 *
 * @param state
 * @param payload
 */
export const setTraining = (state, payload) => {
    state.training = payload;
};