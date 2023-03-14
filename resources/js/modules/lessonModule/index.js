import * as getters from './getters';
import * as actions from './actions';
import * as mutations from './mutations';

export default {
    namespaced: true,
    state: {
        dataError: {},
        lessonList: [], // Список уроков
        selectTask: null, // Выбранное задание
        endLesson: false, // показатель конца урока
        startLesson: true, // показатель начала урока
        itemLesson: {}, // выбраный урок
        editableTask: {}, //Урок для редактирования
        questions: [], // список вопросов в задании
        showRight: false, // показать модальное окно
    },
    getters,
    actions,
    mutations
};