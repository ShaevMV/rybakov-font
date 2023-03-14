import axios from 'axios';


/**
 * Отправить заявку
 *
 * @param context
 * @param payload
 */
export const requestGroupTraining = (context, payload,) => {
    let promise = axios.post('/api/v1/group/addRequest/' + payload.type + '/' + payload.level, payload.user);
    promise.then(function (response) {
        context.commit('setMessageModal', response.data.message,{
            root: true
        });
        context.dispatch('loadGroupList', {
            type: payload.type
        });
        if(typeof payload.callback !== 'undefined'){
            payload.callback();
        }
        let modal = UIkit.modal("#modalRequest");
        modal.hide();
    }).catch(function (error) {
        context.commit('setError', error.response.data.errors,{root: true});
    });
};




/**
 * Загрузить данные о группах заявок по определённому направлению
 *
 * @param context
 * @param payload
 */
export const loadGroupList = (context, payload) => {
    let tempUrl = typeof payload.level !== 'undefined' ? '/' + payload.level : '';
    let promise = axios.get('/api/v1/group/getGroupList/' + payload.type + tempUrl);
    promise.then(function (response) {
        context.commit('setGroupList', response.data.groups);
        if (typeof payload.next !== 'undefined') {
            payload.next();
        }
    })
};

/**
 * Загрузить данные о группах заявок по определённому направлению
 *
 * @param context
 * @param payload
 */
export const loadAllGroupList = (context, payload) => {
    let promise = axios.get('/api/v1/group/getAllGroupList');
    promise.then(function (response) {
        context.commit('setGroupList', response.data.groups);
        if (typeof payload.next !== 'undefined') {
            payload.next();
        }
    })
};

/**
 * Загрузить заявках от дет садов
 *
 * @param context
 */
export const loadKindergartenRequest = (context) => {
    let promise = axios.get('/api/v1/group/getKindergartenRequest');
    promise.then(function (response) {
        context.commit('setRequestList', response.data.groups);
    });
};



/**
 * Загрузить список заявок в группе
 *
 * @param context
 * @param payload
 */
export const loadGroupRequest = (context, payload) => {
    return axios.get('/api/v1/group/loadRequestGroup/' + payload.groupId);
};

/**
 * Обновить данные для группы заявок
 *
 * @param context
 * @param payload
 */
export const updateGroupData = (context, payload) => {
    let promise = axios.post('/api/v1/group/updateRequestGroup', {
        data: payload.data,
        updateType: typeof payload.updateType !== 'undefined' ? payload.updateType : ''
    });
    promise.then(function () {
        alert('Данные обновлены');
    })
};


/**
 * Загрузить список заявок по определённому уравню
 *
 * @param context
 * @param payload
 */
export const loadRequestList = async (context, payload) => {
    let tempLevel = typeof payload.level !== 'undefined' ?  '/' + payload.level : '';
    let promise = axios.get('/api/v1/group/getList/' + payload.type + tempLevel);
    promise.then(function (response) {
        context.commit('setRequestList', response.data.request);
        if (typeof payload.next !== 'undefined') {
            payload.next();
        }
    });
};

/**
 * Создать группу заявок
 *
 * @param context
 * @param payload
 */
export const createRequestGroup = (context, payload) => {
    let promise = axios.post('/api/v1/group/createRequestGroup/' +
        payload.type + '/' + payload.level, {
        name: payload.name
    });
    promise.then(function () {
        context.dispatch('loadGroupList', {
            type: payload.type,
            level: payload.level
        });

        if (typeof payload.callback !== 'undefined') {
            payload.callback();
        }

        context.commit('setError', [],{root: true});
    }).catch(function (error) {
        context.commit('setError', error.response.data.errors,{root: true});
    });
};

/**
 * Удалить группу заявок
 *
 * @param context
 * @param payload
 */
export const deleteGroupRequest = (context, payload) => {
    let promise = axios.delete('/api/v1/group/groupRequest/' + payload.id);
    promise.then(function () {
        if (typeof payload.callback !== 'undefined') {
            payload.callback();
        }
    })
};

/**
 * Сохранить список заявок
 *
 * @param context
 * @param payload
 */
export const saveRequest = (context, payload) => {
    let promise = axios.post('/api/v1/group/update', {
        data: payload.data,
        updateType: typeof payload.updateType !== 'undefined' ? payload.updateType : '',
    });
    promise.then(function () {
        context.commit('setRequestList', payload.data);
        if(typeof payload.callback !== 'undefined'){
            payload.callback();
        }
    });
};


/**
 * Фильтрануть заявки
 *
 * @param context
 * @param payload
 */
export const filterRequest = (context, payload) => {
    let promise = axios.post('/api/v1/group/getList/' +
        payload.type + '/' + payload.level, {
        filter: payload.filter
    });
    promise.then(function (response) {
        context.commit('setRequestList', response.data.request);
    });
};