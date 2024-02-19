@extends('layouts.master')
@section('title', 'Brands')

@section('content')

<!-- Content Header (Page header) -->

@section('header')
@lang( 'brand.brands' )
@endsection
<!-- Main content -->
<section class="content">

	<div class="box">
        <div class="box-header">
        	<h3 class="box-title">@lang( 'brand.all_your_brands' )</h3>
            @can('brand.create')
            	<div class="box-tools">
                    <button type="button" class="btn  btn-danger btn-modal" 
                    	data-href="{{action([\App\Http\Controllers\BrandController::class, 'create'])}}" 
                    	data-container=".brands_modal">
                    	<i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                </div>
            @endcan
        </div>
        <div class="card-body">
            @can('brand.view')
            	<table class="table table-bordered  " id="brands_table">
            		<thead>
            			<tr>
            				<th>@lang( 'brand.brands' )</th>
            				<th>@lang( 'brand.note' )</th>
            				<th>@lang( 'messages.action' )</th>
            			</tr>
            		</thead>
            	</table>
            @endcan
        </div>
    </div>

    <div class="modal   brands_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
