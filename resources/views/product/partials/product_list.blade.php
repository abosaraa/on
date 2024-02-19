@php 
    $colspan = 15;
    $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
{{-- ajax_view  --}}



            <div class="table-responsive  ">
                <table class="table  table-bordered table-hover   key-buttons text-md-nowrap hide-footer" id="product_table" style="width:100% !important;">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all-row" data-table-id="product_table"></th>
                            {{-- <th>صورة المنتج</th> --}}
                            <th>@lang('messages.action')</th>
                            <th>@lang('sale.product')</th>
                            <th>@lang('purchase.business_location') @show_tooltip(__('lang_v1.product_business_location_tooltip'))</th>
                
                            @can('view_purchase_price')
                                @php $colspan++; @endphp
                                <th>@lang('lang_v1.unit_perchase_price')</th>
                            @endcan
                
                            @can('access_default_selling_price')
                                @php $colspan++; @endphp
                                <th>@lang('lang_v1.selling_price')</th>
                            @endcan
                
                            <th>@lang('report.current_stock')</th>
                            <th>@lang('product.product_type')</th>
                            <th>@lang('product.category')</th>
                            <th>@lang('product.brand')</th>
                            <th>@lang('product.tax')</th>
                            <th>@lang('product.sku')</th>
                
                            @for ($i = 1; $i <= 7; $i++)
                                <th id="cf_{{$i}}">{{ $custom_labels['product']['custom_field_'.$i] ?? '' }}</th>
                            @endfor
                        </tr>
                    </thead>
                
                    <tfoot>
                        {{-- <tr> --}}
                            {{-- <td colspan="{{$colspan}}"> --}}
                                {{-- <div style="display: flex; width: 100%;"> --}}
                                    {{-- @can('product.delete')
                                        {!! Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'massDestroy']), 'method' => 'post', 'id' => 'mass_delete_form' ]) !!}
                                        {!! Form::hidden('selected_rows', null, ['id' => 'selected_rows']); !!}
                                        {!! Form::submit(__('lang_v1.delete_selected'), array('class' => 'btn btn-xs btn-danger', 'id' => 'delete-selected')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                 --}}
                                    {{-- @if($is_woocommerce)
                                        <button type="button" class="btn btn-xs btn-warning toggle_woocomerce_sync">
                                            @lang('lang_v1.woocommerce_sync')
                                        </button>
                                    @endif --}}
                                {{-- </div> --}}
                            {{-- </td> --}}
                        {{-- </tr> --}}
                    </tfoot>
                </table>
            </div>
 



{{--                 
                    @can('product.update')
                    
                        @if(config('constants.enable_product_bulk_edit'))
                            &nbsp;
                            {!! Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'bulkEdit']), 'method' => 'post', 'id' => 'bulk_edit_form' ]) !!}
                            {!! Form::hidden('selected_products', null, ['id' => 'selected_products_for_edit']); !!}
                            <button type="submit" class="btn btn-xs btn-primary" id="edit-selected"> <i class="fa fa-edit"></i>{{__('lang_v1.bulk_edit')}}</button>
                            {!! Form::close() !!}
                        @endif
                        &nbsp;
                        <button type="button" class="btn btn-xs btn-success update_product_location" data-type="add">@lang('lang_v1.add_to_location')</button>
                        &nbsp;
                        <button type="button" class="btn btn-xs bg-navy update_product_location" data-type="remove">@lang('lang_v1.remove_from_location')</button>
                    @endcan
                
                &nbsp;
                {!! Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'massDeactivate']), 'method' => 'post', 'id' => 'mass_deactivate_form' ]) !!}
                {!! Form::hidden('selected_products', null, ['id' => 'selected_products']); !!}
                {!! Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn btn-xs btn-warning', 'id' => 'deactivate-selected')) !!}
                {!! Form::close() !!} @show_tooltip(__('lang_v1.deactive_product_tooltip'))
                &nbsp; --}}