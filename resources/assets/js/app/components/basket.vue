<style>

</style>

<template>
    <basket-item v-for="product in order.products" :product="product"></basket-item>
</template>

<script>
    var BasketItem = require('./basketItem.vue');

    module.exports = {
        props: ['order'],
        data: function() {
            return {
                items: []
            };
        },
        computed: {
            total: function() {
                return this.items.reduce(function(total, item) {
                   return total + item['amount'];
                }, 0);
            }
        },
        events: {
            'update-amount': function (id, amount) {
                this.items.push({id: id, amount: amount});
            }
        },
        components: {
            basketItem: BasketItem
        }
    }
</script>