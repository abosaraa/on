@extends('layouts.master')

@section('title', __('accounting::lang.budget'))

@section('css')



<style>
.table-sticky thead,
.table-sticky tfoot {
  position: sticky;
}
.table-sticky thead {
  inset-block-start: 0; /* "top" */
}
.table-sticky tfoot {
  inset-block-end: 0; /* "bottom" */
}
.collapsed .collapse-tr {
    display: none;
}


.my-custom-tabs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px; /* Adjust the margin as needed */
        background-color: #f8f9fa; /* Optional: Set a background color */
        padding: 10px; /* Optional: Add padding to the container */
    }

    .my-custom-tabs li {
        flex-grow: 1;
        text-align: center;
    }

    .my-custom-tabs a {
        display: block;
        padding: 10px; /* Adjust the padding as needed */
        text-decoration: none;
        color: #495057; /* Optional: Set the text color */
        background-color: #ffffff; /* Optional: Set the background color */
        border: 1px solid #dee2e6; /* Optional: Set the border color */
        border-radius: 5px; /* Optional: Set border radius */
    }

    /*  */
</style>
@endsection

@section('content')

@include('accounting::layouts.nav')

<!-- Content Header (Page header) -->
{{-- <section class="content-header">
    <h1>@lang( 'accounting::lang.budget' )</h1>
</section> --}}
<section class="content">
	@component('components.widget', ['class' => 'box-solid'])
        @slot('tool')
            <div class="card-body">
                <button type="button" class="btn btn-default btn-dark" data-toggle="modal"  
                    data-target="#add_budget_modal">
                   @lang( 'messages.add' )</button>
            </div>
        @endslot
        <div class="card-body">
            <div class="row mb-10">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fiscal_year_picker">@lang( 'accounting::lang.financial_year_for_the_budget' )</label>
                        <input type="text" class="form-control" id="fiscal_year_picker" value="{{$fy_year}}" readonly>
                    </div>
                </div>
            </div>
            @if(count($budget)!=0)
                @include('accounting::budget.budget_table')
            @else
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4>@lang( 'accounting::lang.select_a_financial_year' )</h4>
                    </div>
                </div>
            @endif
        </div>
    @endcomponent
</section>
<div class="modal " id="add_budget_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        {!! Form::open(['url' => action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'create']), 
            'method' => 'get', 'id' => 'add_budget_form' ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" 
                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang( 'accounting::lang.financial_year_for_the_budget' )</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::number('financial_year', null, ['class' => 'form-control', 
                                'required', 'placeholder' => 
                                __( 'accounting::lang.financial_year_for_the_budget' ), 'id' => 'financial_year' ]); !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">@lang( 'accounting::lang.continue' )</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang( 'messages.close' )</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
	$(document).ready( function(){
        $('#fiscal_year_picker').datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        }).on('changeDate', function(e){
            window.location.href = 
            "{{action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index'])}}?financial_year=" + $('#fiscal_year_picker').val();
        });

        $('#financial_year').datepicker({
            format: "yyyy",
            viewMode: "years", 
            minViewMode: "years"
        })
	});
    $(document).on('click', '.toggle-tr', function(){
        $(this).closest('tbody').toggleClass('collapsed');
        var html = $(this).closest('tbody').hasClass('collapsed') ? 
        '<i class="fas fa-arrow-circle-right"></i>' : '<i class="fas fa-arrow-circle-down"></i>';
        $(this).find('.collapse-icon').html(html);
    })
</script>
@endsection