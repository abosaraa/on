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
<div class="table-responsive">
  <table class="table table-bordered add-product-price-table table-condensed {{$class}}">
      <tr>
          <th class="col-4">@lang('product.default_purchase_price')</th>
          <th class="col-4">@lang('product.profit_percent') @show_tooltip(__('tooltip.profit_percent'))</th>
          <th class="col-4">@lang('product.default_selling_price')</th>
          {{-- @if(empty($quick_add))
              <th>@lang('lang_v1.product_image')</th>
          @endif --}}
      </tr>
      <tr>
          <td class="col-4">
              {!! Form::label('single_dpp', trans('product.exc_of_tax') . ':*') !!}
              {!! Form::text('single_dpp', $default, ['class' => 'form-control input-sm dpp input_number', 'placeholder' => __('product.exc_of_tax'), 'required']); !!}
              
              {!! Form::label('single_dpp_inc_tax', trans('product.inc_of_tax') . ':*') !!}
              {!! Form::text('single_dpp_inc_tax', $default, ['class' => 'form-control input-sm dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); !!}
          </td>

          <td class="col-4">
              {!! Form::label('profit_percent', trans('product.profit_percent') . ':*') !!}
              {!! Form::text('profit_percent', @num_format($profit_percent), ['class' => 'form-control input-sm input_number', 'id' => 'profit_percent', 'required']); !!}
          </td>

          <td class="col-4">
              {!! Form::label('single_dsp', trans('product.exc_of_tax') . ':*') !!}
              {!! Form::text('single_dsp', $default, ['class' => 'form-control input-sm dsp input_number', 'placeholder' => __('product.exc_of_tax'), 'id' => 'single_dsp', 'required']); !!}
              
              {!! Form::label('single_dsp_inc_tax', trans('product.inc_of_tax') . ':*') !!}
              {!! Form::text('single_dsp_inc_tax', $default, ['class' => 'form-control input-sm hide input_number', 'placeholder' => __('product.inc_of_tax'), 'id' => 'single_dsp_inc_tax', 'required']); !!}
          </td>
      </tr>
  </table>
</div>






  {{-- @if(empty($quick_add))
          <td>
              <div class="form-group">
                {!! Form::label('variation_images', __('lang_v1.product_image') . ':') !!}
                {!! Form::file('variation_images[]', ['class' => 'variation_images', 
                    'accept' => 'image/*', 'multiple']); !!}
                <small><p class="help-block">@lang('purchase.max_file_size', ['size' => (config('constants.document_size_limit') / 1000000)]) <br> @lang('lang_v1.aspect_ratio_should_be_1_1')</p></small>
              </div>
          </td>
          @endif --}}