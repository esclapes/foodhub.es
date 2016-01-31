<style>

</style>

<template>
    <div class="row">
        <div class="list-group basket col-sm-6">
            <basket-item v-for="product in products" :product="product" @update-amount="updateAmount" v-ref:product.id>
        </div>
        <div class="col-sm-6">
            <p>
                Total: {{total}} &euro; | Items: {{items}}
            </p>
        </div>
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
            },
            items: function() {
                return this.selected.length;
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