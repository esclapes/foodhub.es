import Vue from 'vue';
import Vuex from 'vuex';
import Basket from './components/basket.vue';
import store from './vuex/store';

Vue.use(Vuex);

new Vue({
    el: '#app',
    store,
    components: {
        basket: Basket
    }
});