<style>

</style>

<template>
    <div class="list-group-item basket__item">
        <div class="row basket-item">
            <div class="col-sm-7 col-lg-9">
                <h4 class="basket-item__name">{{ product.name }}</h4>
                <p class="basket-item__price">{{ product.pivot.price_value }} &euro; / {{ product.pivot.price_amount }}{{ product.pivot.price_unit }}</p>
            </div>
            <div class="col-sm-5 col-lg-3">
                <div class="input-group">
                    <div class="basket-item__button-group input-group-btn">
                        <button type="button"
                                @click="this.amount = 0"
                                class="basket-item__button--trash btn btn-default">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </div>
                    <input name="products[{{ product.id }}]"
                           class="basket-item__input form-control"
                           type="number"
                           v-model="amount"
                           number
                           readonly>
                    <span class="input-group-addon" id="basic-addon2">{{ product.pivot.step_unit }}</span>
                    <div class="basket-item__button-group input-group-btn">
                        <button type="button" class="basket-item__button--plus btn btn-default" @click="increaseAmount">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <button type="button" class="basket-item__button--minus btn btn-default" @click="decreaseAmount">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    module.exports = {
        props: {
            product: {
                type: Object
            }
        },
        data: function() {
            return {
                amount: 0
            };
        },
        methods: {
            increaseAmount: function() {
                console.log('up');
                this.amount = this.amount + this.product.step_amount;
                this.$dispatch('update-amount', this.product, this.amount);
            },
            decreaseAmount: function() {
                console.log('down');
                this.amount = (this.amount - this.product.step_amount) > 0 ? this.amount - this.product.step_amount : 0;
                this.$dispatch('update-amount', this.product, this.amount);
            }
        }
    }
</script>