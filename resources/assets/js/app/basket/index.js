'use strict';

module.exports = angular.module('foodHub.basket', [])
    .controller(
        'BasketCtrl',
        require('./basket.controller.js'));