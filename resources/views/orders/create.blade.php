@extends('layouts.default')

@section('content')
<div ng-controller="NewOrderController as vm">
	<h1>Crear nueva compra</h1>

	<form action="" method="POST" role="form">

		<div class="form-group">
			<input type="text" ng-model="vm.title" class="form-control" id="" placeholder="Nombre">
		</div>
		
		<div class="form-group">
			<textarea name="" id="" class="form-control" rows="3" placeholder="Descripción"></textarea>
		</div>
		
		<div class="form-group">
			<div class="input-group">
	          <input type="text" class="form-control" datepicker-popup="@{{vm.format}}" ng-model="vm.dt" is-open="vm.opened" min-date="vm.minDate" max-date="'2016-06-22'" datepicker-options="vm.dateOptions" date-disabled="vm.disabled(date, mode)" ng-required="true" close-text="Close" />
	          <span class="input-group-btn">
	            <button type="button" class="btn btn-default" ng-click="vm.open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
	          </span>
	        </div>
	    </div>
		

		<button type="submit" class="btn btn-primary">Crear compra</button>
	</form>
</div>

@stop
