@extends('layouts.master')
@section('title', __('inventorymanagement::inventory.inventory'))
@section('css')

<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}

@endsection
@section('content')

    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
        <h1>@lang('inventorymanagement::inventory.stock_inventory')</h1>
    </section> --}}

    <!-- Main content -->
    <section class="content">

        <div class="card card-primary">
            <div class="card-header text-center" >
                @lang("inventorymanagement::inventory.show_stock_inventory")
            </div>
        </div>

        <table class="table-responsive table ">
                  <tbody>

               </tbody></table>
           <table id="inv" class="display nowrap table-bordered " style="width:100%;">
                  <thead class="bg-green">
                <tr>
                       <th  style="text-align: right">@lang("inventorymanagement::inventory.operation_number")</th>
                       <th  style="text-align: right">@lang("inventorymanagement::inventory.inventory_start_date")</th>
                       <th  style="text-align: right">@lang("inventorymanagement::inventory.inventory_end_date")</th>
                       <th  style="text-align: right">@lang("inventorymanagement::inventory.status")</th>
                       <th  style="text-align: right">@lang("inventorymanagement::inventory.branch")</th>
                       <th  style="text-align: right">@lang("inventorymanagement::inventory.options")</th>

                    </tr>
                  </thead>
                  <tbody>

                  @foreach ($inventories as $inventory)
                     <tr>
                        <td>{{$inventory->id}}</td>
                        <td>{{$inventory->created_at}}</td>
                        <td>{{$inventory->end_date}}</td>
                        <td>
                            @if($inventory->status == 1)
                                <span class="badge bg-green p-5-5"><span class="mx-2"><i class="fa fa-lock-open"></i></span>  @lang("inventorymanagement::inventory.opened")</span>
                            @else
                                <span class="badge bg-red p-5-5"><i class="fa fa-lock"></i>  @lang("inventorymanagement::inventory.closed")</span>
                            @endif
                        </td>
                        <td>{{$inventory->branch->name}} ( {{$inventory->branch->location_id}} )</td>
                        <td>
                            @if($inventory->status == 1)
                                <a href="{{url('inventorymanagement/makeInventory')."/".$inventory->id}}"><button class="btn btn-primary" >@lang("inventorymanagement::inventory.inve")</button></a>
                            @endif
                            <a href="{{url("inventorymanagement/showInventoryReports")."/".$inventory->id."/".$inventory->branch_id}}" >
                                <button class="btn btn-primary">@lang('inventorymanagement::inventory.reports')</button>
                            </a>
                            <a href="{{url("inventorymanagement/inventoryIncreaseReports")."/".$inventory->id."/".$inventory->branch_id}}" >
                            <button class="btn btn-primary">@lang("inventorymanagement::inventory.products_reports_increase")</button>
                            </a>
                            <a href="{{url("inventorymanagement/inventoryDisabilityReports")."/".$inventory->id."/".$inventory->branch_id}}" >
                            <button class="btn btn-primary">@lang("inventorymanagement::inventory.products_reports_decrease")</button>
                            </a>
                            @if($inventory->status == 1)
                                <button class="btn btn-danger inventory_change_status_btn" data-status="0" data-inventory-id="{{$inventory->id}}">@lang("inventorymanagement::inventory.inv_btn_close")</button>
                            @else
                                    <button class="btn btn-success inventory_change_status_btn" data-status="1" data-inventory-id="{{$inventory->id}}">@lang("inventorymanagement::inventory.inv_btn_open")</button>
                            @endif
                         </td>
                     </tr>
                  @endforeach
                  </tbody>
                  <tfoot>

                  </tfoot>
               </table>
    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    {{-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script> --}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#inv').DataTable({
                responsive: true, // Enable responsiveness

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
                // order: [[0, 'desc']]
            });
            
            $('.inventory_change_status_btn').click(function (e){
    e.preventDefault();
    let status = $(this).data('status');
    let invenetory_id = $(this).data('inventory-id');
    console.log(status,invenetory_id);
    $.ajax({
        url:`{{ url('/inventorymanagement/update/status') }}/${invenetory_id}`,
        data:{'new_status':status},
        method:'PUT',
        success:function(res){
            if(res.status){
                location.reload()
            }
        },
        error:function (errs){
            console.error(errs);
        }
    });
})
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
