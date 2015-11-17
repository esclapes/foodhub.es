var Vue = require('vue');
var Basket = require('./components/basket.vue');

new Vue({
    el: '#basket',
    data: {
        products: window.vueData.products,
        order: {}
    },
    components: {
        basket: Basket
    },
});