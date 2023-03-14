export const getError = state => type => {
    if(state.dataError !== undefined && state.dataError[type] !== undefined){
        if(typeof state.dataError[type] === "object"){
            return state.dataError[type][0];
        }
        return state.dataError[type];
    }
    return '';
};

/**
 * Вывести меню
 *
 * @param state
 * @returns {string}
 */
export const listPlatforms = state => {
    return _.filter(state.listPlatforms,function (item) {
        return item.active;
    });
};


/**
 * Вывести меню
 *
 * @param state
 * @returns {string}
 */
export const listPlatformsAll = state => {
    return state.listPlatforms;
};