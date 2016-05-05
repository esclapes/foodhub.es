<style>

</style>

<template>
    <div class="row">

        <div class="list-group basket col-sm-8">
            <basket-item v-for="product in products" :product="product">
        </div>
        <div class="col-sm-4">
            <p v-show="!selected.length">
                Selecciona productos de la lista para hacer tu pedido.
            </p>
            <p v-else>
                Aquí puedes revisar tu pedido.
            </p>

            <table class="table table-striped">
                <tr>
                <th>Articulo</th>
                <th>Cantidad</th>
                <th>Precio</th>
                </tr>
                <tr v-show="!selected.length">
                    <td colspan="3">-------------</td>
                </tr>
                <tr v-for="item in selected">
                    <td class="col-xs-8">
                        {{ item.product.name }}
                    </td>
                    <td class="col-xs-2">
                        {{ item.amount }}&nbsp;{{ item.product.pivot.step_unit
                        }}
                    </td>
                    <td class="col-xs-2">
                        {{ getSubtotal(item) }}&euro;
                    </td>
                </tr>
                <tr>
                    <th>
                        Total
                    </th>
                    <th></th>
                    <th>{{ total }}&euro;</th>
                </tr>
            </table>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="tel" class="form-control" name="phone" placeholder="Teléfono" required>
            </div>
            <div class="form-group">
                <label for="comments">Comentarios</label>
                <textarea class="form-control" name="comments" id="" rows="3"></textarea>
            </div>
            <button class="btn btn-success btn-lg" type="submit">Confirmar pedido</button>
        </div>

    </div>

</template>

<script>
    import BasketItem from './basketItem.vue'
    import { updateAmount } from '../vuex/actions'
    import _ from 'lodash';

    export default {
        vuex: {
            getters: {
                products: state => state.products,
                selected: state => state.selected
            },
            actions: {
                updateAmount
            }
        },
        computed: {
            total: function () {
                return this.selected.reduce(function (total, item) {
                    return total + item.product.pivot.price_value * (item.amount / item.product.pivot.price_amount);;
                }, 0);
            },
            items: function () {
                return this.selected.length;
            }
        },
        methods: {
            getSubtotal: function (item) {
                return item.product.pivot.price_value * (item.amount / item.product.pivot.price_amount);
            }
        },
        components: {
            basketItem: BasketItem
        }
    }
</script>