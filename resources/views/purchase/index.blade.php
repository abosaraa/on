@extends('layouts.master')
@section('title', __('purchase.purchases'))
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}
@endsection


@section('content')

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    {{-- <h1>@lang('purchase.purchases')
        <small></small>
    </h1> --}}
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content no-print">
    @component('components.filters', ['title' => __('report.filters')])
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                
                    <div class="form-group">
                        {!! Form::label('purchase_list_filter_location_id',  __('purchase.business_location') . ':') !!}
                        {!! Form::select('purchase_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('purchase_list_filter_supplier_id',  __('purchase.supplier') . ':') !!}
                        {!! Form::select('purchase_list_filter_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('purchase_list_filter_status',  __('purchase.purchase_status') . ':') !!}
                        {!! Form::select('purchase_list_filter_status', $orderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('purchase_list_filter_payment_status',  __('purchase.payment_status') . ':') !!}
                        {!! Form::select('purchase_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('purchase_list_filter_date_range', __('report.date_range') . ':') !!}
                        {!! Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                    </div>
                </div>
            </div>
           
        </div>
    </div>
       
    @endcomponent

    @component('components.widget', ['class' => 'box-primary'])
        @can('purchase.create')
            @slot('tool')
                <div class="card-body">
                    <a class="btn  btn-dark text-white btn-small  rounded" href="{{action([\App\Http\Controllers\PurchaseController::class, 'create'])}}">
                  @lang('messages.add')</a>

                </div>


                
            @endslot
        @endcan
        @include('purchase.partials.purchase_table')

    @endcomponent

    <div class="modal  product_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal  payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal  edit_payment_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

    @include('purchase.partials.update_purchase_status_modal')

</section>

<section id="receipt_section" class="print_section"></section>

<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
<script>
    //Date range as a button
    $('#purchase_list_filter_date_range').daterangepicker(
        dateRangeSettings,
        function (start, end) {
            $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
           purchase_table.ajax.reload();
        }
    );
    $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
        $('#purchase_list_filter_date_range').val('');
        purchase_table.ajax.reload();
    });

    $(document).on('click', '.update_status', function(e){
        e.preventDefault();
        $('#update_purchase_status_form').find('#status').val($(this).data('status'));
        $('#update_purchase_status_form').find('#purchase_id').val($(this).data('purchase_id'));
        $('#update_purchase_status_modal').modal('show');
    });

    $(document).on('submit', '#update_purchase_status_form', function(e){
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success == true) {
                    $('#update_purchase_status_modal').modal('hide');
                    toastr.success(result.msg);
                    purchase_table.ajax.reload();
                    $('#update_purchase_status_form')
                        .find('button[type="submit"]')
                        .attr('disabled', false);
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });
</script>





<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

	
@endsection