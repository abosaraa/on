@extends('layouts.master')
@section('title', __('sale.discount'))
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
{{-- <section class="content-header ">    <h1>@lang( 'sale.discount' )
    </h1>
    
</section> --}}

<!-- Main content -->
<section class="content">

	<div class="box">
        <div class="box-header">
        	{{-- <h3 class="box-title">@lang('lang_v1.all_your_discounts')</h3> --}}
            @can('brand.create')
            	<div class="box-tools">
                 

                    <button type="button" class="btn  btn-dark btn-modal" 
                    data-href="{{action([\App\Http\Controllers\DiscountController::class, 'create'])}}" 
                    data-container=".discount_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
                </div>
            @endcan
        </div>
        <div class="card-body">
            @can('brand.view')
                <div class="table-responsive">
            	<table class="table table-bordered table-striped " id="discounts_table" style="width: 100% !important;">
            		<thead>
            			<tr>
                            <th><input type="checkbox" id="select-all-row" data-table-id="discounts_table"></th>
            				<th>@lang( 'unit.name' )</th>
            				<th>@lang( 'lang_v1.starts_at' )</th>
            				<th>@lang( 'lang_v1.ends_at' )</th>
                            <th>@lang( 'sale.discount_amount' )</th>
                            <th>@lang( 'lang_v1.priority' )</th>
                            <th>@lang( 'product.brand' )</th>
                            <th>@lang( 'product.category' )</th>
                            <th>@lang( 'report.products' )</th>
                            <th>@lang( 'sale.   location' )</th>
                            <th>@lang( 'messages.action' )</th>
            			</tr>
            		</thead>
                    <tfoot>
                    {{-- <tr>
                        <td colspan="11">
                        <div style="display: flex; width: 100%;">
                            {!! Form::open(['url' => action([\App\Http\Controllers\DiscountController::class, 'massDeactivate']), 'method' => 'post', 'id' => 'mass_deactivate_form' ]) !!}
                            {!! Form::hidden('selected_discounts', null, ['id' => 'selected_discounts']); !!}
                            {!! Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn btn-xs btn-warning', 'id' => 'deactivate-selected')) !!}
                            {!! Form::close() !!}
                            </div>
                        </td>
                    </tr> --}}
                </tfoot>
            	</table>
                </div>
            @endcan
        </div>
    </div>

    <div class="modal  discount_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
@stop
@section('javascript')
<script type="text/javascript">
    $(document).on('click', '#deactivate-selected', function(e){
        e.preventDefault();
        var selected_rows = [];
        var i = 0;
        $('.row-select:checked').each(function () {
            selected_rows[i++] = $(this).val();
        }); 
        
        if(selected_rows.length > 0){
            $('input#selected_discounts').val(selected_rows);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('form#mass_deactivate_form').submit();
                }
            });
        } else{
            $('input#selected_discounts').val('');
            swal('@lang("lang_v1.no_row_selected")');
        }    
    });

    $(document).on('click', '.activate-discount', function(e){
        e.preventDefault();
        var href = $(this).data('href');
        $.ajax({
            method: "get",
            url: href,
            dataType: "json",
            success: function(result){
                if(result.success == true){
                    toastr.success(result.msg);
                    discounts_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    $(document).on('shown.bs.modal', '.discount_modal', function(){
        $('#variation_ids').select2({
            ajax: {
                url: '/purchases/get_products?check_enable_stock=false&only_variations=true',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    var results = [];
                    for (var item in data) {
                        results.push(
                            {
                                id: data[item].variation_id,
                                text: data[item].text,
                            }
                        );
                    }
                    return {
                        results: results,
                    };
                },
            },
            minimumInputLength: 1,
            closeOnSelect: false
        });
    });

    $(document).on('change', '#variation_ids', function(){
        if ($(this).val().length) {
            $('#brand_input').addClass('hide');
            $('#category_input').addClass('hide');
        } else {
            $('#brand_input').removeClass('hide');
            $('#category_input').removeClass('hide');
        }
    });

    $(document).on('hidden.bs.modal', '.discount_modal', function(){
        $("#variation_ids").select2('destroy'); 
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
