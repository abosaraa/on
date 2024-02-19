@extends('layouts.master')
@section('title', __('cash_register.cash_register'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header ">    <h1>@lang( 'cash_register.cash_register' )
        <small>@lang( 'cash_register.manage_your_cash_register' )</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">

	<div class="box">
        <div class="box-header">
        	<h3 class="box-title">@lang( 'cash_register.all_your_cash_register' )</h3>
        	<div class="box-tools">
                <button type="button" class="btn  btn-danger btn-modal" 
                	data-href="{{action([\App\Http\Controllers\CashRegisterController::class, 'create'])}}" 
                	data-container=".location_add_modal">
                	<i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
            </div>
        </div>
        <div class="card-body">
        	<table class="table table-bordered  " id="cash_registers_table">
        		<thead>
        			<tr>
        				<th>@lang( 'invoice.name' )</th>
                        <th>@lang( 'messages.action' )</th>
        			</tr>
        		</thead>
        	</table>
        </div>
    </div>

    <div class="modal  location_add_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal  location_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
