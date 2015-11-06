<style>
    .red {
        color: #f00;
    }
</style>

<template>
    <div class="list-group-item basket__item">
        <div class="row basket-item">
            <div class="col-sm-7 col-lg-9">
                <h4 class="basket-item__name">{{ product.name }}</h4>
                <p class="basket-item__price">{{ product.pivot.price_amount }} / {{ product.pivot.price_unit }}</p>
            </div>
            <div class="col-sm-5 col-lg-3">
                <div class="input-group">
                    <div class="basket-item__button-group input-group-btn">
                        <button type="button" class="basket-item__button--trash btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                    </div>
                    <input name="products[{{ product.id }}]"
                           class="basket-item__input form-control"
                           value="0" type="number"
                           step="{{ product.pivot.order_amount }}"
                           v-model="amount"
                           @change="updateAmount">
                    <span class="input-group-addon" id="basic-addon2">{{ product.pivot.order_unit }}</span>
                    <div class="basket-item__button-group input-group-btn">
                        <button type="button" class="basket-item__button--plus btn btn-default">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <button type="button" class="basket-item__button--minus btn btn-default">
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
        props: ['product'],
        data: function() {
          return {
              amount: 0
          };
        },
        methods: {
            updateAmount: function() {
                if(this.amount) {
                    this.$dispatch('update-amount', this.product.id, this.amount);
                }
            }
        }
    }
</script>