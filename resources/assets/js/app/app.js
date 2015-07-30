'use strict';

require('angular'),
require('angular-ui-bootstrap');
 
angular.module('FoodHub', ['ui.bootstrap']);

angular
    .module('FoodHub')
    .controller('NewOrderController', require('./controllers/NewOrderController.js'));
    