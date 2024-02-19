@extends('layouts.master')
@section('title', __('invoice.invoice_settings'))
@section('css')

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

<!-- Content Header (Page header) -->
{{-- <section class="content-header ">    <h1>@lang( 'invoice.invoice_settings' )
        <small>@lang( 'invoice.manage_your_invoices' )</small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section> --}}

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs  nav-justified my-custom-tabs" >
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">@lang('invoice.invoice_schemes')</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">@lang('invoice.invoice_layouts')</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card-body">
                                    <a class="btn btn-dark text-white btn-modal " data-href="{{action([\App\Http\Controllers\InvoiceSchemeController::class, 'create'])}}" data-container=".invoice_modal" >
                                     @lang( 'messages.add' )</a>
                                </div>
                           
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered   " id="invoice_table" style="width: 100%!important;">
                                        <thead class="bg-green">
                                            <tr>
                                                <th>@lang( 'invoice.name' ) @show_tooltip(__('tooltip.invoice_scheme_name'))</th>
                                                <th>@lang( 'invoice.prefix' ) @show_tooltip(__('tooltip.invoice_scheme_prefix'))</th>
                                                <th>@lang( 'invoice.number_type' ) @show_tooltip(__('invoice.number_type_tooltip'))</th>
                                                <th>@lang( 'invoice.start_number' ) @show_tooltip(__('tooltip.invoice_scheme_start_number'))</th>
                                                <th>@lang( 'invoice.invoice_count' ) @show_tooltip(__('tooltip.invoice_scheme_count'))</th>
                                                <th>@lang( 'invoice.total_digits' ) @show_tooltip(__('tooltip.invoice_scheme_total_digits'))</th>
                                                <th>@lang( 'messages.action' )</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane " id="tab_2">
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-dark text-white" href="{{action([\App\Http\Controllers\InvoiceLayoutController::class, 'create'])}}">
                                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                            </div>
                            <div class="col-md-12  nav-justified my-custom-tabs">
                                @foreach( $invoice_layouts as $layout)
                                <div class="col-md-3">
                                    <div class="icon-link">
                                        <a href="{{action([\App\Http\Controllers\InvoiceLayoutController::class, 'edit'], [$layout->id])}}">
                                            <i class="fa fa-file-alt fa-4x"></i>
                                            {{ $layout->name }}
                                        </a>
                                        @if( $layout->is_default )
                                        <span class="badge bg-green">@lang("barcode.default")</span>
                                        @endif
                                        @if($layout->locations->count())
                                        <span class="link-des">
                                            <b>@lang('invoice.used_in_locations'): </b><br>
                                            @foreach($layout->locations as $location)
                                            {{ $location->name }}
                                            @if (!$loop->last)
                                            ,
                                            @endif
                                            &nbsp;
                                            @endforeach
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                @if( $loop->iteration % 4 == 0 )
                                <div class="clearfix"></div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <br>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
    </div>

    <div class="modal  invoice_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal  invoice_edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

@endsection
@section('javascript')

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
