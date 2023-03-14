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
 * Запись списка уровней
 *
 * @param state
 * @param payload
 */
export const setAvailableLevel = (state, payload) => {
    state.arrlevel = payload;
};

/**
 * Записать списка уроков
 *
 * @param state
 * @param payload
 */
export const setLessonList = (state, payload) => {
    state.lessonList = payload;
};


/**
 * Записать выбранную задачу
 *
 * @param state
 * @param payload
 */
export const setTask = (state, payload) => {
    state.selectTask = payload;
};


/**
 * Записать что урок последний
 *
 * @param state
 * @param payload
 */
export const setEnd = (state, payload) => {
    state.endLesson = payload;
};

/**
 * Записать данные о заявке на офлайн обучение
 *
 * @param state
 * @param payload
 */
export const setGroupTraining = (state, payload) => {
    state.groupTraining.push(payload);
};

/**
 * Записать данные о заявке на офлайн обучение
 *
 * @param state
 * @param payload
 */
export const setRe = (state, payload) => {
    state.groupTraining.push(payload);
};


/**
 * Получить данные задачи для редактирования
 *
 * @param state
 * @param payload
 */
export const setEditLesson = (state, payload) => {
    state.itemLesson = payload;
};

/**
 * Добавить задачу в урок
 *
 * @param state
 * @param payload
 */
export const addTaskForLesson = (state, payload) => {
    state.itemLesson.tasks.push(payload);
};

/**
 * Получить задачу для редактирования
 *
 * @param state
 * @param payload
 */
export const setTaskEdit = (state, payload) => {
    state.editableTask = payload;
};

/**
 * Записать список вопросов в задании
 *
 * @param state
 * @param payload
 */
export const setQuestions = (state, payload) => {
    state.questions = payload;
};

/**
 * Установить флаг показа правильного ответа
 *
 * @param state
 * @param payload
 */
export const setShowRight = (state,payload) => {
    state.showRight = payload;
};


