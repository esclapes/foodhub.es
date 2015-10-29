/*jshint browserify: true */
'use strict';

require('angular');
require('angular-ui-bootstrap');
 
angular
    .module('foodHub', [
        //'ui.bootstrap',
        require('./basket').name
    ]);