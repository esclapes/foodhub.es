var Vue = require('vue');
var Basket = require('./components/basket.vue');

new Vue({
    el: '#app',
    data: window.vueData,
    components: {
        basket: Basket
    }
});