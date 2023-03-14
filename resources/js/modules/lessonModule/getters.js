import _ from 'lodash';

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
 * Вывести список уроков с заданиями
 *
 * @param state
 * @return {Array}
 */
export const getListLesson = state => {
    return state.lessonList;
};


/**
 * Проверить что это выбранная задача
 *
 * @param state
 * @return {function(*)}
 */
export const isSelectTask = state => task => {
    if (state.selectTask !== null) {
        return state.selectTask.id === task;
    }
};


/**
 * Проверить что это выбранный урок
 *
 * @param state
 * @return {function(*)}
 */
export const isSelectTaskInLesson = state => lesson => {

    if (state.selectTask !== null) {
        let task = _.filter(lesson.tasks, function (item) {
            return item.id === state.selectTask.id;
        });
        return task.length > 0;
    }
};


/**
 * Вывести имя выбранного урока
 *
 * @param state
 * @return {function(*)}
 */
export const getNameSelectLesson = state => {
    if (state.selectTask !== null && typeof state.selectTask.lesson_id !=='undefined') {
        let lesson = _.filter(state.lessonList, function (lessons) {
            return lessons.id === state.selectTask.lesson_id
        });
        return lesson[0].title;
    }
};

/**
 * Вывести имя выбранного урока
 *
 * @param state
 * @return {function(*)}
 */
export const getNameSelectTask = state => {
    if (state.selectTask !== null) {
        return state.selectTask.title;
    }
};

/**
 * Вывести тип выбранной задачи
 *
 * @param state
 * @return {function(*)}
 */
export const getTypeSelectTask = state => {
    if (state.selectTask !== null) {
        switch (state.selectTask.type) {
            case 'text':
                return 'конспект';
            case 'video':
                return 'видео';
            case 'testing':
                return 'тестирование'
        }
    }
};

/**
 * Вывести содержимое задачи
 *
 * @param state
 * @return {function(*)}
 */
export const getContentInSelectTask = state => {
    if (state.selectTask !== null) {
        return state.selectTask['content'];
    }
};

/**
 * Вывести вопросы к заданию
 *
 * @param state
 * @return {*}
 */
export const getQuestionsInSelectTask = state => {
    if (state.selectTask !== null) {
        return state.questions;
    }
};

/**
 * Вывести тип задачи
 *
 * @param state
 * @return {function(*)}
 */
export const getTypeInSelectTask = state => {
    if (state.selectTask !== null) {
        return state.selectTask['type'];
    }
};


/**
 * Вывести описание задачи
 *
 * @param state
 * @return {function(*)}
 */
export const getDescriptionInSelectTask = state => {
    if (state.selectTask !== null) {
        return state.selectTask['description'];
    }
};

/**
 * Вывести кол-во уроков
 *
 * @param state
 * @return {number}
 */
export const getCountLesson = state => {
    return state.lessonList.length;
};

/**
 * Вывести номер выбранного урока
 *
 * @param state
 * @param getters
 * @return {number}
 */
export const getSelectCountLesson = (state, getters) => {
    let counter = 1;
    for (let item of state.lessonList) {
        if (!getters.isSelectTaskInLesson(item)) {
            counter++;
        } else {
            break;
        }
    }
    if (counter > state.lessonList.length) {
        counter = 1;
    }
    return counter;
};


/**
 * проверка на последнее задание в уроке
 *
 * @param state
 * @return {number}
 */
export const isEndLesson = state => {
    return state.endLesson;
};


/**
 * Вывод урока
 *
 * @param state
 * @return {{}|state.itemLesson}
 */
export const itemLesson = state => {
    return state.itemLesson;
};


/**
 *  Задача для редактирования
 * @param state
 * @returns {default.state.editableTask|{description, id, poll, title, type, content}}
 */
export const editableTask = state => {
    return state.editableTask;
};

/**
 * Вывести ответ на вопрос
 *
 * @param state
 * @return {function(*)}
 */
export const getAnswer = state => idQuestions => {
    let result = _.find(state.questions, function (item) {
        return item.id === idQuestions;
    });
    return result.answer_user!==null ? JSON.parse(result.answer_user.answer)[0] : '';
};

/**
 * Проверка что пользователь выбрал этот вариант ответа
 *
 * @param state
 * @return {function(*)}
 */
export const isChecked = state => params => {
    let idQuestions = params.idQuestions;
    let answer = params.answer;
    let result = _.filter(state.questions, function  (item) {
        if(item.id === idQuestions){
            if(item.answer_user!==null){
                let answerUser = JSON.parse(item.answer_user.answer);
                return answerUser.indexOf(answer) !== -1;
            }
        }
        return false;
    });
    return result.length > 0;
};

/**
 * Вывести флаг показа правильного ответа
 *
 * @param state
 * @return {boolean}
 */
export const getShowRight = state => {
    return state.showRight;
};
