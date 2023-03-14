/**
 * Записать количестко уведомлений
 *
 * @param state
 * @param payload
 */
export const setCountNotifications = (state, payload) => {
    state.countNotifications = payload
};

/**
 * Записать количестко уведомлений
 *
 * @param state
 * @param payload
 */
export const setNotifications = (state, payload) => {
    state.notificationsList = payload
};