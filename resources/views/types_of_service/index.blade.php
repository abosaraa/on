@extends('layouts.master')
@section('title', __('lang_v1.types_of_service'))

@section('content')


@section('header')
@lang( 'lang_v1.types_of_service' ) @show_tooltip(__('lang_v1.types_of_service_help_long'))
@endsection
<!-- Main content -->
<section class="content">
    @component('components.widget', ['class' => 'box-primary'])
        @slot('tool')
            <div class="box-tools">
                <button type="button" class="btn  btn-danger btn-modal" 
                    data-href="{{action([\App\Http\Controllers\TypesOfServiceController::class, 'create'])}}" 
                    data-container=".type_of_service_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
            </div>
        @endslot
        @can('brand.view')
            <div class="table-responsive">
                <table class="table table-bordered  " id="types_of_service_table">
                    <thead>
                        <tr>
                            <th>@lang( 'tax_rate.name' )</th>
                            <th>@lang( 'lang_v1.description' )</th>
                            <th>@lang( 'lang_v1.packing_charge' )</th>
                            <th>@lang( 'messages.action' )</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endcan
    @endcomponent

    <div class="modal   type_of_service_modal contains_select2" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
