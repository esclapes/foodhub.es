<style>

</style>

<template>
    <div class="list-group basket">
        <p>
            Total: {{total}} &euro;
        </p>
        <basket-item v-for="product in products" :product="product" @update-amount="updateAmount" v-ref:product.id>
    </div>

</template>

<script>
    var BasketItem = require('./basketItem.vue');
    var _ = require('lodash');

    module.exports = {
        data: function() {
            return {
                selected: []
            };
        },
        props: ['products'],
        computed: {
            total: function() {
                return this.selected.reduce(function(total, item) {
                   return total + item.product.pivot.price_value * (item.amount / item.product.pivot.price_amount) ;
                }, 0);
            }
        },
        methods: {
            updateAmount: function (product, amount) {
                this.selected = _.reject(this.selected, { id : product.id });
                if (amount > 0) this.selected.push({id: product.id, product: product, amount: amount});
            }
        },
        components: {
            basketItem: BasketItem
        }
    }
</script>