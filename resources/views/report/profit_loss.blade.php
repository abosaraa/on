@extends('layouts.master')
@section('title', __( 'report.profit_loss' ))
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}
<style>
    @media print {
        /* Show the div with the id 'pl_data_div' when printing */
        #pl_data_div {
            display: block !important;
        }

        /* Show the widget component when printing */
        .widget {
            display: block !important;
        }

        /* Optionally, hide the no-print class elements when printing */
        .no-print {
            display: none !important;
        }
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

<!-- Content Header (Page header) -->
{{-- <section class="content-header ">    <h1>@lang( 'report.profit_loss' )
    </h1>
</section> --}}

<!-- Main content -->
<section class="content">
    <div class="print_section"><h2>{{session()->get('business.name')}} - @lang( 'report.profit_loss' )</h2></div>
    
    <div class="row no-print">
        <div class="col-md-6">
            <div class="input-group">
                {{-- <span class="input-group-addon bg-light-blue"><i class="fa fa-map-marker"></i></span> --}}
                 <select class="form-control select2" id="profit_loss_location_filter">
                    @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group pull-right">
                <div class="input-group">
                  <button type="button" class="btn btn-primary" id="profit_loss_date_filter">
                    <span>
                     {{ __('messages.filter_by_date') }}
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
                </div>
            </div>
        </div>
    </div>

    @component('components.widget')
    <div>
        <div id="pl_data_div">
            <!-- Your data to be printed goes here -->
        </div>

    </div>
@endcomponent

<!-- CSS for printing -->

<div class="row no-print">
    <div class="col-sm-12 text-center">
        {{-- <button type="button" class="btn btn-dark rounded mb-5" aria-label="Print" onclick="window.print();"> --}}
      
        {{-- </button> --}}
        <button id="printButton" class="btn btn-primary">      <i class="fa fa-print"></i> @lang( 'messages.print' )</button>

    </div>
</div>

   
    <div class="row no-print">
        <div class="col-md-12">
           <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs nav-justified my-custom-tabs">
                    <li class="active">
                        <a href="#profit_by_products" data-toggle="tab" aria-expanded="true"><i class="fa fa-cubes" aria-hidden="true"></i> @lang('lang_v1.profit_by_products')</a>
                    </li>

                    <li>
                        <a href="#profit_by_categories" data-toggle="tab" aria-expanded="true"><i class="fa fa-tags" aria-hidden="true"></i> @lang('lang_v1.profit_by_categories')</a>
                    </li>

                    <li>
                        <a href="#profit_by_brands" data-toggle="tab" aria-expanded="true"><i class="fa fa-diamond" aria-hidden="true"></i> @lang('lang_v1.profit_by_brands')</a>
                    </li>

                    <li>
                        <a href="#profit_by_locations" data-toggle="tab" aria-expanded="true"><i class="fa fa-map-marker" aria-hidden="true"></i> @lang('lang_v1.profit_by_locations')</a>
                    </li>

                    <li>
                        <a href="#profit_by_invoice" data-toggle="tab" aria-expanded="true"><i class="fa fa-file-alt" aria-hidden="true"></i> @lang('lang_v1.profit_by_invoice')</a>
                    </li>

                    <li>
                        <a href="#profit_by_date" data-toggle="tab" aria-expanded="true"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang_v1.profit_by_date')</a>
                    </li>
                    <li>
                        <a href="#profit_by_customer" data-toggle="tab" aria-expanded="true"><i class="fa fa-user" aria-hidden="true"></i> @lang('lang_v1.profit_by_customer')</a>
                    </li>
                    <li>
                        <a href="#profit_by_day" data-toggle="tab" aria-expanded="true"><i class="fa fa-calendar" aria-hidden="true"></i> @lang('lang_v1.profit_by_day')</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="profit_by_products"> 
                        @include('report.partials.profit_by_products')
                    </div>

                    <div class="tab-pane" id="profit_by_categories">
                        @include('report.partials.profit_by_categories')
                    </div>

                    <div class="tab-pane" id="profit_by_brands">
                        @include('report.partials.profit_by_brands')
                    </div>

                    <div class="tab-pane" id="profit_by_locations">
                        @include('report.partials.profit_by_locations')
                    </div>

                    <div class="tab-pane" id="profit_by_invoice">
                        @include('report.partials.profit_by_invoice')
                    </div>

                    <div class="tab-pane" id="profit_by_date">
                        @include('report.partials.profit_by_date')
                    </div>

                    <div class="tab-pane" id="profit_by_customer">
                        @include('report.partials.profit_by_customer')
                    </div>

                    <div class="tab-pane" id="profit_by_day">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	

</section>
<!-- /.content -->
@stop
@section('javascript')
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>


<script>
    document.getElementById("printButton").addEventListener("click", function() {
        // Determine the direction of the text (RTL or LTR)
        var dir = document.getElementById("printTable").style.direction;

        // Print the table
        printJS({
            printable: "printTable",
            type: "html",
            // header: "Printed Table",
            documentTitle: "Printed Table",
            style: ".table {border-collapse: collapse; width: 100%;} .table, th, td {border: 1px solid black; padding: 8px;}",
            css: ".rtl .table, .rtl th, .rtl td { text-align: right; } .ltr .table, .ltr th, .ltr td { text-align: left; }"
        });
    });
</script>

<script type="text/javascript">
    $(document).ready( function() {
        profit_by_products_table = $('#profit_by_products_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "/reports/get-profit/product",
                    "data": function ( d ) {
                        d.start_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        d.end_date = $('#profit_loss_date_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                        d.location_id = $('#profit_loss_location_filter').val();
                    }
                },
                columns: [
                    { data: 'product', name: 'product'  },
                    { data: 'gross_profit', "searchable": false},
                ],
                footerCallback: function ( row, data, start, end, display ) {
                    var total_profit = 0;
                    for (var r in data){
                        total_profit += $(data[r].gross_profit).data('orig-value') ? 
                        parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                    }

                    $('#profit_by_products_table .footer_total').html(__currency_trans_from_en(total_profit));
                }
            });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr('href');
            if ( target == '#profit_by_categories') {
                if(typeof profit_by_categories_datatable == 'undefined') {
                    profit_by_categories_datatable = $('#profit_by_categories_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/category",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'category', name: 'C.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_categories_table .footer_total').html(__currency_trans_from_en(total_profit));
                        },
                    });
                } else {
                    profit_by_categories_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_brands') {
                if(typeof profit_by_brands_datatable == 'undefined') {
                    profit_by_brands_datatable = $('#profit_by_brands_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/brand",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'brand', name: 'B.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_brands_table .footer_total').html(__currency_trans_from_en(total_profit));
                        },
                    });
                } else {
                    profit_by_brands_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_locations') {
                if(typeof profit_by_locations_datatable == 'undefined') {
                    profit_by_locations_datatable = $('#profit_by_locations_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/location",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'location', name: 'L.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_locations_table .footer_total').html(__currency_trans_from_en(total_profit));
                        },
                    });
                } else {
                    profit_by_locations_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_invoice') {
                if(typeof profit_by_invoice_datatable == 'undefined') {
                    profit_by_invoice_datatable = $('#profit_by_invoice_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/invoice",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'invoice_no', name: 'sale.invoice_no'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_invoice_table .footer_total').html(__currency_trans_from_en(total_profit));
                        },
                    });
                } else {
                    profit_by_invoice_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_date') {
                if(typeof profit_by_date_datatable == 'undefined') {
                    profit_by_date_datatable = $('#profit_by_date_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/date",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'transaction_date', name: 'sale.transaction_date'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_date_table .footer_total').html(__currency_trans_from_en(total_profit));
                        },
                    });
                } else {
                    profit_by_date_datatable.ajax.reload();
                }
            } else if (target == '#profit_by_customer') {
                if(typeof profit_by_customers_table == 'undefined') {
                    profit_by_customers_table = $('#profit_by_customer_table').DataTable({
                        processing: true,
                        serverSide: true,
                        "ajax": {
                            "url": "/reports/get-profit/customer",
                            "data": function ( d ) {
                                d.start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                d.end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.location_id = $('#profit_loss_location_filter').val();
                            }
                        },
                        columns: [
                            { data: 'customer', name: 'CU.name'  },
                            { data: 'gross_profit', "searchable": false},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var total_profit = 0;
                            for (var r in data){
                                total_profit += $(data[r].gross_profit).data('orig-value') ? 
                                parseFloat($(data[r].gross_profit).data('orig-value')) : 0;
                            }

                            $('#profit_by_customer_table .footer_total').html(__currency_trans_from_en(total_profit));
                        },
                    });
                } else {
                    profit_by_customers_table.ajax.reload();
                }
            } else if (target == '#profit_by_day') {
                var start_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');

                var end_date = $('#profit_loss_date_filter')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                var location_id = $('#profit_loss_location_filter').val();

                var url = '/reports/get-profit/day?start_date=' + start_date + '&end_date=' + end_date + '&location_id=' + location_id;
                $.ajax({
                        url: url,
                        dataType: 'html',
                        success: function(result) {
                           $('#profit_by_day').html(result); 
                            profit_by_days_table = $('#profit_by_day_table').DataTable({
                                    "searching": false,
                                    'paging': false,
                                    'ordering': false,
                            });
                            var total_profit = sum_table_col($('#profit_by_day_table'), 'gross-profit');
                           $('#profit_by_day_table .footer_total').text(total_profit);
                            __currency_convert_recursively($('#profit_by_day_table'));
                        },
                    });
            } else if (target == '#profit_by_products') {
                profit_by_products_table.ajax.reload();
            }
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
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

@endsection
