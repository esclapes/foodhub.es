// Some Jasmine 2.0 tests
describe('basket', function () {
    // require source module
    var Vue    = require('vue');
    var basket = require('../components/basket.vue');

    it('should have no items when initialized', function () {
        expect(typeof basket.data).toBe('function');
        var defaultData = basket.data();
        expect(defaultData.items).toEqual([]);
    });

    it('should have a on update amount listener', function () {
        expect(typeof basket.events['update-amount']).toBe('function');
    });

    it('should add a new item when update-amount is fired', function () {
        var basketInstance = new Vue(basket);
        basketInstance.$emit('update-amount', 10, 2);
        expect(basketInstance.items).toEqual([{id: 10, amount: 2}]);
    });
});