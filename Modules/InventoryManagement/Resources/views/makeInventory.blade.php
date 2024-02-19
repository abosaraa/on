@extends('layouts.master')
@section('title', __('inventorymanagement::inventory.inventory'))
@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/> --}}
    
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}

    <link rel="stylesheet" type="text/css" href="{{ url('css/inventory.css') }}"/>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"> --}}
@endsection
@section('content')

    {{-- <section class="content-header">
        <h1>@lang('inventorymanagement::inventory.stock_inventory')</h1>
    </section> --}}

    <section class="content">
        <div class="card card-primary">
            <div class="card-header text-center" style="font-size: 30px;">
                @lang("inventorymanagement::inventory.products_inventory")
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <div class="input-group">
							{{-- <span class="input-group-addon">
								<i class="fa fa-search"></i>
							</span> --}}
                            {!! Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_inventory', 'placeholder' => __('stock_adjustment.search_products'), 'enabled']); !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <input type="hidden" id="product_row_index" value="0">
                    <input type="hidden" id="total_amount" name="final_total" value="0">
                    <div class="table-responsive">

                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>

        <table id="purchase_entry_table" class="display nowrap table  table-bordered table-hover " style="width:100%">
            <thead class="bg-green text-white text-center">
            <tr>
                <th  style="text-align: right">@lang("inventorymanagement::inventory.product_name")</th>
                <th  style="text-align: right">@lang("inventorymanagement::inventory.product_barcode")</th>
                <th  style="text-align: right">@lang("inventorymanagement::inventory.current_amount")</th>
                <th  style="text-align: right">@lang("inventorymanagement::inventory.amount_after_inventory")</th>
                <th  style="text-align: right">@lang("inventorymanagement::inventory.amount_difference")</th>
                <th  style="text-align: right">@lang("inventorymanagement::inventory.options")</th>

            </tr>
            </thead>
           <tbody>

          @include("inventorymanagement::partials.tableRowForListing" , [$inventories , $quantityProductsArray,$products])
           </tbody>

        </table>
            <div class="p-10 text-center"><button type="button" id="saveProducts" class="btn btn-dark rounded">
                @lang('inventorymanagement::inventory.save')
            </button></div>
    </section>

@endsection
@include("inventorymanagement::partials.modals.editProductInventoryModal")
@section('javascript')
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#inv').DataTable({
                columnDefs: [
                    {
                        targets: [0],
                        orderData: [0, 1],
                    },
                    {
                        targets: [1],
                        orderData: [1, 0],
                    },
                    {
                        targets: [4],
                        orderData: [4, 0],
                    },
                ],
            });
        });
    </script>
    <script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>

    @include('inventorymanagement::partials.mainscript')

    <script src="{{ asset('js/vendor.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">__page_leave_confirmation('#purchase_return_form');</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

