export const updateAmount = makeAction('UPDATE_AMOUNT');

function makeAction (type) {
    return ({ dispatch }, ...args) => dispatch(type, ...args);
}