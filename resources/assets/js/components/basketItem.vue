<style>

</style>

<template>
    <div class="list-group-item basket__item">
        <div class="row basket-item">
            <div class="col-xs-7 col-sm-8">
                <h4 class="basket-item__name">{{ product.name }}</h4>

                <p class="basket-item__price">{{ product.pivot.price_value
                    }} &euro; / <span v-if="product.pivot.price_amount != 1">{{ product.pivot.price_amount }}</span>{{
                    product.pivot.price_unit }}</p>
            </div>
            <div class="col-xs-5 col-sm-4">
                <div class="input-group">
                    <input name="products[{{ product.id }}]"
                           class="basket-item__input input-small form-control"
                           type="number"
                           :value="amount"
                           number
                           readonly>
                    <span class="input-group-addon" id="basic-addon2">{{ product.pivot.step_unit }}</span>
                </div>

                <div class="basket-item__button-group btn-group">
                    <button type="button"
                            class="basket-item__button--plus btn btn-default"
                            @click="increaseAmount">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                    <button type="button"
                            class="basket-item__button--minus btn btn-default"
                            @click="decreaseAmount">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
    import { updateAmount } from '../vuex/actions';
    import { store } from '../vuex/store';
    import _ from 'lodash';

    export default {
        props: {
            product: {
                type: Object
            }
        },
        vuex: {
            actions: {
                updateAmount
            },
            getters: {
                selected: function(state) {
                    return state.selected;
                }
            }
        },
        computed: {
            amount: function() {
                const isSelected = _.find(this.selected, { 'id': this.product.id });
                return isSelected ? isSelected.amount : 0;
            }
        },
        methods: {
            increaseAmount: function () {
                const amount = this.amount + this.product.pivot.step_amount;
                this.updateAmount(this.product, amount);
            },
            decreaseAmount: function () {
                const amount = (this.amount - this.product.pivot.step_amount) > 0 ? this.amount - this.product.pivot.step_amount : 0;
                this.updateAmount(this.product, amount);
            },
            clearAmount: function () {
                const amount = 0;
                this.updateAmount(this.product, amount);
            },
        }
    }
</script>