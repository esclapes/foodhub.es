import Vue from 'vue';
import Vuex from 'vuex';
import _ from 'lodash';

import middleware from './middleware';

Vue.use(Vuex);
Vue.config.debug = true;

const debug = process.env.NODE_ENV !== 'production';

export const STORAGE_KEY = 'foodhub_basket';

const state = {
    products: window.vueData.products,
    selected: []
}

const mutations = {
    UPDATE_AMOUNT (state, product, amount) {

        const match = _.find(state.selected, { 'id': product.id });
        const item = {
            id: product.id,
            product: product,
            amount: amount
        };

        if (amount == 0) {
            state.selected = _.reject(state.selected, { 'id': product.id });
        }
        else if (match) {
            const index = _.indexOf(state.selected, match);
            state.selected.splice(index, 1, item);
        }
        else {
            state.selected.push(item);
        }
    }
}

export default new Vuex.Store({
    state,
    mutations,
    middleware,
    strict: debug,
});