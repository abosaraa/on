
@if(!session('business.enable_price_tax')) 
    @php
        $default = 0;
        $class = 'hide';
    @endphp
@else
    @php
        $default = null;
        $class = '';
    @endphp
@endif

<tr class="variation_row col-sm-2">
    <td>
        {!! Form::select('product_variation[' . $row_index .'][variation_template_id]', $variation_templates, null, ['class' => 'form-control input-sm variation_template', 'required']); !!}
        <input type="hidden" class="row_index" value="{{$row_index}}">
        <div class="form-group variation_template_values_div mt-15 hide">
            <label>@lang('lang_v1.select_variation_values')</label>
            {!! Form::select('product_variation[' . $row_index .'][variation_template_values][]', [], null, ['class' => 'form-control input-sm variation_template_values', 'multiple', 'style' => 'width: 100%;']); !!}
        </div>
    </td>

    <td class="col-md-12">
        <table class="table table-condensed table-bordered blue-header variation_value_table">
            <thead>
                <tr>
                    <th class="col-sm-12">@lang('product.sku') @show_tooltip(__('tooltip.sub_sku'))</th>
                </tr>
            </thead>
        
            <tbody>
                <tr>
                    <td class="col-sm-12">
                        {!! Form::text('product_variation[' . $row_index .'][variations][0][sub_sku]', null, ['class' => 'form-control input-sm']); !!}
                    </td>
                </tr>
        
                <tr>
                    <th class="col-sm-12">@lang('product.value')</th>
                </tr>
                <tr>
                    <td class="col-sm-12">
                        {!! Form::text('product_variation[' . $row_index .'][variations][0][value]', null, ['class' => 'form-control input-sm variation_value_name', 'required']); !!}
                    </td>
                </tr>
        
                <tr>
                    <th class="col-sm-12 {{$class}}">
                        @lang('product.default_purchase_price')
                        <br/>
                        <span class="pull-left"><small><i>@lang('product.exc_of_tax')</i></small></span>
                        <span class="pull-right"><small><i>@lang('product.inc_of_tax')</i></small></span>
                    </th>
                </tr>
                <tr>
                    <td class="col-sm-12 {{$class}}">
                        <div class="width-50 f-left">
                            {!! Form::text('product_variation[' . $row_index .'][variations][0][default_purchase_price]', $default, ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']); !!}
                        </div>
        
                        <div class="width-50 f-left">
                            <div class="input-group">
                                {!! Form::text('product_variation[' . $row_index .'][variations][0][dpp_inc_tax]', $default, ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); !!}
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                                </span>
                            </div>
                        </div>
                    </td>
                </tr>
        
                <tr>
                    <th class="col-sm-12 {{$class}}">
                        @lang('product.profit_percent')
                    </th>
                </tr>
                <tr>
                    <td class="col-sm-12 {{$class}}">
                        <div class="input-group">
                            {!! Form::text('product_variation[' . $row_index .'][variations][0][profit_percent]', $profit_percent, ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']); !!}
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-toggle="tooltip" title="@lang('lang_v1.apply_all')" data-target-class=".variable_profit_percent"><i class="fas fa-check-double"></i></button>
                            </span>
                        </div>
                    </td>
                </tr>
        
                <tr>
                    <th class="col-sm-12 {{$class}}">
                        @lang('product.default_selling_price')
                        <br/>
                        <small><i><span class="dsp_label"></span></i></small>
                    </th>
                </tr>
                <tr>
                    <td class="col-sm-12 {{$class}}">
                        {!! Form::text('product_variation[' . $row_index .'][variations][0][default_sell_price]', $default, ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']); !!}
                        {!! Form::text('product_variation[' . $row_index .'][variations][0][sell_price_inc_tax]', $default, ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); !!}
                    </td>
                </tr>
        
                <tr>
                    <th class="col-sm-12">@lang('lang_v1.variation_images')</th>
                </tr>
                <tr>
                    <td class="col-sm-12">
                        {!! Form::file('variation_images_' . $row_index .'_0[]', ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']); !!}
                    </td>
                </tr>
        
                <tr>
                    <td class="col-sm-12">
                        <button type="button" class="btn btn-danger btn-xs remove_variation_value_row">-</button>
                        <input type="hidden" class="variation_row_index" value="0">
                    </td>
                </tr>
            </tbody>
        </table>
        

    </td>
</tr>
