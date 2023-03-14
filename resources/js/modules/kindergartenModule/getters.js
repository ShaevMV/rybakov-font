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
 * Вывести список детских садов
 *
 * @param state
 * @returns {Array}
 */
export const getKindergartenList = state => {
    return state.kindergartenList;
};



