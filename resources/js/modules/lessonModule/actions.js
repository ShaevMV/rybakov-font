import axios from 'axios';

/**
 * Загрузить список уроков для определённого направления
 *
 * @param context
 * @param payload
 * @return {Promise<void>}
 */
export const loadLesson = async (context, payload) => {
    let promise = axios.get('/api/v1/lesson/load/' + payload.type);
    await promise.then(function (response) {
        context.commit('setLessonList', response.data.listLesson);
        context.commit('setTask', response.data.selectTask);
        context.commit('setQuestions', response.data.questions);
        if (typeof payload.selectTask !== 'undefined' && payload.selectTask === true) {
            context.dispatch('selectEnd');
        }
        if (typeof payload.next !== 'undefined') {
            payload.next()
        }
    });
};


/**
 * Выбрать задание из урока
 *
 * @param context
 * @param payload
 * @return {Promise<void>}
 */
export const selectTask = (context, payload) => {
    axios.post('/api/v1/lesson/selectTask/' + context.rootState.selectDirection, {
        taskId: payload.task.id,
        lessonSort: payload.lessonSort
    }).then(function (response) {
        context.commit('setTask', response.data.selectTask);
        context.commit('setQuestions', response.data.questions);
        context.dispatch('selectEnd');
        context.commit('setShowRight', false);
    }).catch(function (error) {
        context.commit('setTask', error.response.data.selectTask);
        context.commit('setQuestions', error.response.data.questions);
        context.dispatch('selectEnd');
        context.commit('setShowRight', false);
        let modal = UIkit.modal("#modalErrorLesson");
        modal.show();
    });
};

/**
 * Проверить что данный урок последний
 *
 * @param context
 */
export const selectEnd = (context) => {
    if (context.state.selectTask !== null) {
        let lessonList = context.state.lessonList;
        let endTasks = lessonList[lessonList.length - 1].tasks;
        let endTaskId = endTasks[endTasks.length - 1].id;

        if (endTaskId === context.state.selectTask.id) {
            context.commit('setEnd', true);
        } else {
            context.commit('setEnd', false);
        }
    }
};


/**
 * Следующее задание
 *
 * @param context
 */
export const nextTask = (context) => {
    let task = null;
    if (context.state.selectTask === null) {
        task = context.state.lessonList[0].tasks[0];
        // выдилить задания задания
        context.dispatch('selectTask', {
            task: task,
            lessonSort: context.state.lessonList[0].sort,
        });
    } else {
        context.state.lessonList.forEach(function (lesson, indexLesson, lessons) {

            if (context.state.selectTask.lesson_id === lesson.id) {
                lesson.tasks.forEach(function (task, index, tasks) {
                    if (task.id === context.state.selectTask.id) {
                        // перейти к другому заданию
                        if (tasks.length > index + 1) {
                            task = tasks[index + 1];
                            // выделить задание
                            context.dispatch('selectTask', {
                                task: task,
                                lessonSort: lessons[indexLesson].sort,
                            });
                        }
                        // перейти к другому уроку
                        else if (lessons.length > indexLesson + 1) {
                            task = lessons[indexLesson + 1].tasks[0];
                            UIkit.accordion('.acc_block').toggle(indexLesson + 1, true);
                            context.dispatch('selectTask', {
                                task: task,
                                lessonSort: lessons[indexLesson + 1].sort,
                            });
                        } else {
                            // завершение урока
                            context.dispatch('endLesson',{
                                lessonSort: lessons[indexLesson].sort
                            });
                        }

                    }
                });
            }
        });
    }
};


/**
 * Предыдущее задание
 *
 * @param context
 */
export const backTask = (context) => {

    if (context.state.selectTask !== null) {
        context.state.lessonList.forEach(function (lesson, indexLesson, lessons) {
            if (context.state.selectTask.lesson_id === lesson.id) {
                lesson.tasks.forEach(function (task, index, tasks) {
                    if (task.id === context.state.selectTask.id) {

                        // перейти к другому заданию
                        if (index - 1 >= 0) {
                            task = tasks[index - 1];
                        }
                        // перейти к другому уроку
                        else if (indexLesson - 1 >= 0) {
                            let taskIndex = lessons[indexLesson - 1].tasks.length;

                            task = lessons[indexLesson - 1].tasks[taskIndex - 1];
                            UIkit.accordion('.acc_block').toggle(indexLesson - 1, true);
                        }
                        let sort = typeof lessons[indexLesson - 1] !== 'undefined' ?
                            lessons[indexLesson - 1].sort :
                            lessons[indexLesson].sort;

                        context.dispatch('selectTask', {
                            task: task,
                            lessonSort: sort,
                        });
                    }
                });
            }
        });
    }
};


/**
 * Завершить онлайн обучение
 *
 * @param context
 * @param payload
 */
export const endLesson = (context,payload) => {

    let promise = axios.post('/api/v1/lesson/end/' + context.rootState.selectDirection,{
        lessonSort: payload.lessonSort
    });
    promise.then(function (response) {
        context.commit('setMessageModal', response.data.message,{
            root: true
        });

        let modal = UIkit.modal("#ModalEndLesson");
        modal.show();
    }).catch(function () {
        let modal = UIkit.modal("#modalErrorLesson");
        modal.show();
    });
};



/**
 * Сохранение урока
 *
 * @param context
 * @param payload
 */
export const addLesson = (context, payload) => {

    let promise = axios.post(`/api/v1/lesson/add`, payload.data);
    promise.then(() => {
        context.dispatch('loadLesson', {type: payload.data.type});

    }).catch(error => {
        context.commit('setError', error.response.data.errors,{root: true});
    });
};

/**
 * Удалить урок
 *
 * @param context
 * @param payload
 */
export const removeLesson = (context, payload) => {

    let promise = axios.delete(`/api/v1/lesson/remove/${payload.data.id}`);
    promise.then(() => {
        context.dispatch('loadLesson', {type: payload.type});
    });
};

/**
 * Получить данные по определёному уроку
 *
 * @param context
 * @param payload
 */
export const getLesson = (context, payload) => {
    let promise = axios.get(`/api/v1/lesson/get/${payload.id}`);
    promise.then((response) => {
        context.commit('setEditLesson', response.data);
        if (typeof payload.next !== 'undefined') {
            payload.next();
        }
    });
};

/**
 * Обновление урока
 *
 * @param context
 * @param payload
 */
export const updateLesson = (context, payload) => {

    let promise = axios.post(`/api/v1/lesson/update/${payload.id}`, {
        lesson: payload.lesson,
        tasks: payload.tasks
    });

    promise.then(() => {
        context.commit('setEditLesson', payload.lesson);
        if(typeof payload.callback!== 'undefined'){
            payload.callback();
        }
    }).catch(function (error) {
        if(typeof error.response !== 'undefined'){
            context.commit('setError', error.response.data.errors,{root: true});
        } else {
            console.error(error);
        }

    });
};


/**
 * Загрузить данные задания
 *
 * @param context
 * @param payload
 */
export const getTask = (context, payload) => {
    let promise = axios.get(`/api/v1/lesson/getTask/${payload.id}`);
    promise.then((response) => {
        context.commit('setTaskEdit', response.data);
        if(typeof payload.next!== 'undefined'){
            payload.next();
        }
    });
};

/**
 * Очистить данные для задачи
 *
 * @param context
 */
export const clearTask = (context) => {
    context.commit('setTaskEdit', {
        title: '',
        description: '',
        type: 'text',
        content: '',
    });
};

/**
 * Добавить задачу
 *
 * @param context
 * @param payload
 */
export const addTask = (context, payload) => {
    let promise = axios.post(`/api/v1/lesson/addTask`, payload.data);
    promise.then(() => {
        //context.commit('addTaskForLesson', response.data);
        if(typeof payload.callback !== 'undefined'){
            payload.callback();
        }
    }).catch(function (error) {
        if(typeof error.response !== 'undefined'){
            context.commit('setError', error.response.data.errors,{root: true});
        } else {
            console.error(error);
        }
    });
};

/**
 * Записать ответ на вопрос в онлайн обучении
 *
 * @param context
 * @param payload
 */
export const setAnswerOptions = (context, payload) => {
    let promise = axios.post(`/api/v1/lesson/setAnswer/${payload.idQuestions}`, {
        answer: payload.answer,
        task: context.state.selectTask.id,
        type: payload.type
    });
    promise.then(async function (response) {
        let listQuestions = _.filter(context.state.questions, function (item) {
            if (item.id === payload.idQuestions) {
                item.answer_user = response.data.answer
            }
            return true;
        });

        await context.commit('setQuestions', listQuestions);
    }).catch(function (error) {
        if (typeof error.response !== 'undefined') {
            context.commit('setError', error.response.data.errors,{root: true});
        } else {
            console.error(error);
        }
    });
};

/**
 * Показать правильный ответ
 *
 * @param context
 */
export const showRight = (context) => {
    context.commit('setShowRight', true);
};

