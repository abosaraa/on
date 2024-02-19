@extends('layouts.master')

@section('title', __('accounting::lang.transactions'))

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}
<style>
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
    <h1>@lang( 'accounting::lang.transactions' )</h1>
</section> --}}

<!-- Main content -->
   

<section class="content">



<div class="w-2/3">
    <div class="relative right-0">
      <ul
        class="relative flex flex-wrap p-1 list-none rounded-xl bg-blue-gray-50/60"
        data-tabs="tabs"
        role="list"
      >
        <li class="z-30 flex-auto text-center">
          <a
            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
            data-tab-target=""
            active=""
            role="tab"
            aria-selected="true"
            aria-controls="app"
          >
            <span class="ml-1">@lang('sale.sale')</span>
          </a>
        </li>
        <li class="z-30 flex-auto text-center">
          <a
            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
            data-tab-target=""
            role="tab"
            aria-selected="false"
            aria-controls="message"
          >
            <span class="ml-1">@lang('accounting::lang.sales_payments')</span>
          </a>
        </li>
        <li class="z-30 flex-auto text-center">
          <a
            class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
            data-tab-target=""
            role="tab"
            aria-selected="false"
            aria-controls="settings"
          >
            <span class="ml-1">@lang('purchase.purchases')</span>
          </a>
        </li>

        <li class="z-30 flex-auto text-center">
            <a
              class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
              data-tab-target=""
              role="tab"
              aria-selected="false"
              aria-controls="a"
            >
              <span class="ml-1">@lang('accounting::lang.purchase_payments')</span>
            </a>
          </li>


          <li class="z-30 flex-auto text-center">
            <a
              class="z-30 flex items-center justify-center w-full px-0 py-1 mb-0 transition-all ease-in-out border-0 rounded-lg cursor-pointer text-slate-700 bg-inherit"
              data-tab-target=""
              role="tab"
              aria-selected="false"
              aria-controls="b"
            >
              <span class="ml-1">@lang('accounting::lang.expenses')</span>
            </a>
          </li>
      </ul>
      <div data-tab-content="" class="p-5">
        <div class="block opacity-100" id="app" role="tabpanel">
            @include('accounting::transactions.partials.sales')

        </div>
        <div class="hidden opacity-0" id="message" role="tabpanel">
            @include('accounting::transactions.partials.payments', ['id' => "sell_payment_table"])

        </div>
        <div class="hidden opacity-0" id="settings" role="tabpanel">
            @include('accounting::transactions.partials.purchases')
        </div>


        <div class="hidden opacity-0" id="a" role="tabpanel">
            @include('accounting::transactions.partials.payments', ['id' => "purchase_payment_table"])

        </div>

        <div class="hidden opacity-0" id="b" role="tabpanel">
            @include('accounting::transactions.partials.expenses')


        </div>
      </div>
    </div>
  </div>


</section>




<!-- /.content -->
@stop

@section('javascript')
@include('accounting::accounting.common_js')
<script type="text/javascript">
    $(document).ready( function(){
        sell_table = $('#sell_table').DataTable({
            processing: true,
            serverSide: true,

            // aaSorting: [[1, 'desc']],
            "ajax": {
                "url": base_path + "/accounting/transactions?type=sell&datatable=sell",
                "data": function ( d ) {
                    if($('#sell_list_filter_date_range').val()) {
                        var start = $('#sell_list_filter_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                        var end = $('#sell_list_filter_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        d.start_date = start;
                        d.end_date = end;
                    }
                    d.is_direct_sale = 1;

                    d.location_id = $('#sell_list_filter_location_id').val();
                    d.customer_id = $('#sell_list_filter_customer_id').val();
                    d.payment_status = $('#sell_list_filter_payment_status').val();
                    d.created_by = $('#created_by').val();
                    d.sales_cmsn_agnt = $('#sales_cmsn_agnt').val();
                    d.service_staffs = $('#service_staffs').val();

                    if($('#shipping_status').length) {
                        d.shipping_status = $('#shipping_status').val();
                    }

                    if($('#sell_list_filter_source').length) {
                        d.source = $('#sell_list_filter_source').val();
                    }

                    if($('#only_subscriptions').is(':checked')) {
                        d.only_subscriptions = 1;
                    }

                    d = __datatable_ajax_callback(d);
                }
            },
            scrollY:        "75vh",
            scrollX:        true,
            scrollCollapse: true,
            columns: [
                { data: 'action', name: 'action', orderable: false, "searchable": false},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'conatct_name', name: 'conatct_name'},
                { data: 'mobile', name: 'contacts.mobile'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'payment_status', name: 'payment_status'},
                { data: 'payment_methods', orderable: false, "searchable": false},
                { data: 'final_total', name: 'final_total'},
                { data: 'total_paid', name: 'total_paid', "searchable": false},
                { data: 'added_by', name: 'u.first_name'},
                { data: 'additional_notes', name: 'additional_notes'},
                { data: 'staff_note', name: 'staff_note'}
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sell_table'));
            }
        });

        sell_payment_table = $('#sell_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": base_path + "/accounting/transactions?transaction_type=sell&datatable=payment",
                                "data": function ( d ) {
                                    // d.account_id = $('#account_id').val();
                                    // var start_date = '';
                                    // var endDate = '';
                                    // if($('#date_filter').val()){
                                    //     var start_date = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                    //     var endDate = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                    // }
                                    // d.start_date = start_date;
                                    // d.end_date = endDate;
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                __currency_convert_recursively($('#sell_payment_table'));
                            }
                        });
        purchase_payment_table = $('#purchase_payment_table').DataTable({
                            processing: true,
                            serverSide: true,
                            "ajax": {
                                "url": base_path + "/accounting/transactions?transaction_type=purchase&datatable=payment",
                                "data": function ( d ) {
                                    // d.account_id = $('#account_id').val();
                                    // var start_date = '';
                                    // var endDate = '';
                                    // if($('#date_filter').val()){
                                    //     var start_date = $('#date_filter').data('daterangepicker').startDate.format('YYYY-MM-DD');
                                    //     var endDate = $('#date_filter').data('daterangepicker').endDate.format('YYYY-MM-DD');
                                    // }
                                    // d.start_date = start_date;
                                    // d.end_date = endDate;
                                }
                            },
                            columnDefs:[{
                                "targets": 0,
                                "orderable": false,
                                "searchable": false
                            }],
                            columns: [
                                {data: 'action', name: 'action'},
                                {data: 'paid_on', name: 'paid_on'},
                                {data: 'payment_ref_no', name: 'payment_ref_no'},
                                {data: 'transaction_number', name: 'transaction_number'},
                                {data: 'amount', name: 'amount'},
                                {data: 'type', name: 'T.type'},
                                {data: 'details', name: 'details', "searchable": false},
                            ],
                            "fnDrawCallback": function (oSettings) {
                                __currency_convert_recursively($('#sell_payment_table'));
                            }
                        });

        //Purchase table
        purchase_table = $('#purchase_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?datatable=purchase',
                data: function(d) {
                    if ($('#purchase_list_filter_location_id').length) {
                        d.location_id = $('#purchase_list_filter_location_id').val();
                    }
                    if ($('#purchase_list_filter_supplier_id').length) {
                        d.supplier_id = $('#purchase_list_filter_supplier_id').val();
                    }
                    if ($('#purchase_list_filter_payment_status').length) {
                        d.payment_status = $('#purchase_list_filter_payment_status').val();
                    }
                    if ($('#purchase_list_filter_status').length) {
                        d.status = $('#purchase_list_filter_status').val();
                    }

                    var start = '';
                    var end = '';
                    if ($('#purchase_list_filter_date_range').val()) {
                        start = $('input#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#purchase_list_filter_date_range')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;

                    d = __datatable_ajax_callback(d);
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'location_name', name: 'BS.name' },
                { data: 'name', name: 'contacts.name' },
                { data: 'status', name: 'status' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'final_total', name: 'final_total' },
                { data: 'payment_due', name: 'payment_due', orderable: false, searchable: false },
                { data: 'added_by', name: 'u.first_name' },
            ],
            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively($('#purchase_table'));
            }
        });

        $(document).on('submit', "form#save_accounting_map", function(e){
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            transaction_type = $('#transaction_type').val();

            $.ajax({
                method: 'POST',
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                success: function(result) {
                    if (result.success == true) {
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        if(transaction_type == 'sell'){
                            sell_table.ajax.reload();
                        } else if(transaction_type == 'sell_payment'){
                            sell_payment_table.ajax.reload();
                        } else if(transaction_type == 'purchase'){
                            purchase_table.ajax.reload();
                        } else if(transaction_type == 'purchase_payment'){
                            purchase_payment_table.ajax.reload();
                        } else if(transaction_type == 'expense'){
                            transaction_expense_table.ajax.reload();
                        }
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });


        });

        // expense_table
        transaction_expense_table = $('#transaction_expense_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/transactions?type=expense&datatable=expense',
                data: function(d) {
                },
            },
            scrollY:        "75vh",
            scrollX:        true,
            scrollCollapse: true,
            columns: [
            { data: 'action', name: 'action', orderable: false, searchable: false },
            { data: 'transaction_date', name: 'transaction_date' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'recur_details', name: 'recur_details', orderable: false, searchable: false },
            { data: 'category', name: 'ec.name' },
            { data: 'sub_category', name: 'esc.name' },
            { data: 'location_name', name: 'bl.name' },
            { data: 'payment_status', name: 'payment_status', orderable: false },
            { data: 'tax', name: 'tr.name' },
            { data: 'final_total', name: 'final_total' },
            { data: 'payment_due', name: 'payment_due' },
            { data: 'expense_for', name: 'expense_for' },
            { data: 'contact_name', name: 'c.name' },
            { data: 'additional_notes', name: 'additional_notes' },
            { data: 'added_by', name: 'usr.first_name'}
            ],
            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively($('#transaction_expense_table'));
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
<script src="node_modules/@material-tailwind/html/scripts/tabs.js"></script>
 
<!-- from cdn -->
<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script>
@stop