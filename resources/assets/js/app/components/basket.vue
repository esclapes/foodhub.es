<style>

</style>

<template>
    <basket-item v-for="product in products" :product="product" @update-amount="updateAmount" v-ref:product.id>
</template>

<script>
    var BasketItem = require('./basketItem.vue');

    module.exports = {
        data: function() {
            return {
                products: window.vueData.products,
                order: {
                    items: []
                }
            };
        },
        computed: {
            total: function() {
                return this.order.items.reduce(function(total, item) {
                   return total + item['amount'];
                }, 0);
            }
        },
        methods: {
            updateAmount: function (product, amount) {
                this.order.items[product.id] = {product: product, amount: amount};
            }
        },
        components: {
            basketItem: BasketItem
        }
    }
</script>