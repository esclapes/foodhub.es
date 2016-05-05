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
        state.selected = _.reject(state.selected, {id: product.id});
        if (amount > 0) state.selected.push({
            id: product.id,
            product: product,
            amount: amount
        });
    }
}

export default new Vuex.Store({
    state,
    mutations,
    middleware,
    strict: debug,
});