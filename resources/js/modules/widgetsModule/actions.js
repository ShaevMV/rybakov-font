import axios from 'axios'

/**
 * Получение списка виджетов
 *
 */
export const getListWidget = () => {
    return axios.get('/api/v1/widget')
};

/**
 * Получение списка виджетов для редактирования
 *
 * @return {Promise<AxiosResponse<T>>}
 */
export const getListWidgetForAdmin = () => {
   return axios.get('/api/v1/widget/editList');
};
