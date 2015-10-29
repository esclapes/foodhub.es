describe('basket', function(){

    beforeEach(angular.mock.module('foodHub.basket'));

    var controller;

    describe('BasketCtrl', function() {
        beforeEach(inject(function($controller){
            controller = $controller('BasketCtrl', { });
        }));

        it('test BasketCtrl', function() {
            
            expect(controller.title).toEqual('Customers');
        });
    });


    // critical
    it('should show all available products', function() {

    });
    
    it('should enable a confirm button when basket has selected products', function() {
        
    });
    
    it('should show each product with the defined price per unit', function() {
        
    });

    it('should ensure that selectio nincrements in the defined ammount', function() {
        
    });

    it('should prevent negative quantities added to the basket', function() {
        
    });

});