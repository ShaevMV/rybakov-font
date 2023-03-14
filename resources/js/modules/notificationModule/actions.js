import axios from 'axios'

/**
 * Загрузить список уведомлений
 *
 */
export const loadNotification = (context, payload) => {
    let promise = axios.get('/api/v1/user/getNotification');
    promise.then(function (response) {
        context.commit('setNotifications', response.data.notificationList);
    })
};


/**
 * Загрузить список уведомлений
 *
 */
export const loadCountNotification = (context, payload) => {
    let promise = axios.get('/api/v1/user/getCountNotification');
    promise.then(function (response) {
        context.commit('setCountNotifications', response.data);
    })
};
