

@section('css')
{{-- 
<style>
     .select2-container--default .select2-selection--multiple .select2-selection__choice  {
        display: none;
    }
   /* Custom styles for 100% width and centering */
   .lead_additional_div {
        display: flex;
        justify-content: center;
    }

    /* Adjusting styles for the 'assigned_to' select */
    .select2-search__field {
        width: 100% !important; /* Force 100% width */
    }
    span.select2-container.select2-container--default.select2-container--open {
    display: none !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    padding: 0 4px;
    display: none !important;
}
    
</style> --}}
<!-- Internal Select2 css -->
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet"> --}}
@endsection
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
  @php
    $form_id = 'contact_add_form';
    if(isset($quick_add)){
      $form_id = 'quick_add_contact';
    }

    if(isset($store_action)) {
      $url = $store_action;
      $type = 'lead';
      $customer_groups = [];
    } else {
      $url = action([\App\Http\Controllers\ContactController::class, 'store']);
      $type = isset($selected_type) ? $selected_type : '';
      $sources = [];
      $life_stages = [];
    }
  @endphp
    {!! Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id ]) !!}

    <div class="card-header">
      
          <button type="button" class="btn custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="custom-close-icon">&times;</span>
          </button>
      <h4 class="modal-title">@lang('contact.add_contact')</h4>
    </div>

    <div class="card-body">
        <div class="row">            
            <div class=" col-md-12  contact_type_div">
                <div class="form-group">
                    {!! Form::label('type', __('contact.contact_type') . ':*' ) !!}
                    {!! Form::select('type', $types, $type , ['class' => 'form-control nice-select custom-select', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']); !!}
                </div>
            </div>
            
            {{-- <div class="col-md-12 ">
                <div class="form-group">
                    {!! Form::label('contact_id', __('lang_v1.contact_id') . ':') !!}
                    {!! Form::text('contact_id', null, ['class' => 'form-control nice-select custom-select','placeholder' => __('lang_v1.contact_id')]); !!}
                    <p class="help-block">
                        @lang('lang_v1.leave_empty_to_autogenerate')
                    </p>
                </div>
            </div> --}}
            
            <div class="col-md-12 ">
                <div class="form-group">
                    {!! Form::label('first_name', __('business.first_name') . ':*') !!}
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); !!}
                </div>
            </div>
            
    
            
            <div class="col-md-12 ">
                <div class="form-group">
                    {!! Form::label('mobile', __('contact.mobile') . ':*') !!}
                    {!! Form::text('mobile', null, ['class' => 'form-control', 'required', 'placeholder' => __('contact.mobile')]); !!}
                </div>
            </div>
            
            <div class="col-md-12 " >
                <div class="form-group">
                    {!! Form::label('email', __('business.email') . ':') !!}
                    {!! Form::email('email', null, ['class' => 'form-control','placeholder' => __('business.email')]); !!}
                </div>
            </div>
      
        
<!-- lead additional field -->
<div class="col-md-12 lead_additional_div">
    <div class="form-group">
        {!! Form::label('crm_source', __('lang_v1.source') . ':' ) !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fas fa fa-search"></i>
            </span>
            {!! Form::select('crm_source', $sources, null , ['class' => 'form-control select2', 'id' => 'crm_source', 'placeholder' => __('messages.please_select')]); !!}
        </div>
    </div>
</div>

<div class="col-md-12 lead_additional_div">
    <div class="form-group">
        {!! Form::label('crm_life_stage', __('lang_v1.life_stage') . ':' ) !!}
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fas fa fa-life-ring"></i>
            </span>
            {!! Form::select('crm_life_stage', $life_stages, null , ['class' => 'form-control select2', 'id' => 'crm_life_stage', 'placeholder' => __('messages.please_select')]); !!}
        </div>
    </div>
</div>

{{-- 
<!-- User in create leads -->
<div class="col-md-12 lead_additional_div">
    <div class="form-group">
        {!! Form::label('user_id', __('lang_v1.assigned_to') . ':*' ) !!}
        <div class="row">
            <div class="col-md-12">
                {!! Form::select('user_id[]', $users ?? [], null, [
                    'class' => 'form-control select2',
                    'id' => 'user_id',
                    'placeholder' => __('messages.please_select'),
                    'required'
                ]); !!}
            </div>
        </div>
    </div>
</div>

<!-- User in create customer & supplier -->
@if(config('constants.enable_contact_assign') && $type !== 'lead')
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('assigned_to_users', __('lang_v1.assigned_to') . ':' ) !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-user"></i>
                </span>
                {!! Form::select('assigned_to_users[]', $users ?? [], null, [
                    'class' => 'form-control select2 nice-select custom-select',
                    'id' => 'assigned_to_users',
                    'multiple' => 'multiple' // Add the 'multiple' attribute here
                ]); !!}
            </div>
        </div>
    </div>
@endif
 --}}


            

            <div class="clearfix"></div>
        </div>
        <div class="row">
       
        
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                 
                    <div>
                        <a class="btn ripple btn-primary" data-toggle="collapse" href="#more_div" role="button" aria-expanded="false" aria-controls="more_div">
                            @lang('lang_v1.more_info')
                        </a>
                        <div class="collapse" id="more_div">
                            {!! Form::hidden('position', null, ['id' => 'position']); !!}
                            <div class="col-md-12 "><hr/></div>
        
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    {!! Form::label('tax_number', __('contact.tax_no') . ':') !!}
                                    <div class="input-group" style="width: 100%;">
                                        <span class="input-group-addon">
                                            <i class="fa fa-info"></i>
                                        </span>
                                        {!! Form::text('tax_number', null, ['class' => 'form-control', 'placeholder' => __('contact.tax_no')]); !!}
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-12 opening_balance">
                                <div class="form-group">
                                    {!! Form::label('opening_balance', __('lang_v1.opening_balance') . ':') !!}
                                    <div class="input-group" style="width: 100%;">
                                        <span class="input-group-addon">
                                            <i class="fas fa-money-bill-alt"></i>
                                        </span>
                                        {!! Form::text('opening_balance', 0, ['class' => 'form-control input_number']); !!}
                                    </div>
                                </div>
                            </div>
                            
                <div class="col-md-12 pay_term">
                    <div class="form-group">
                        <div class="multi-input">
                            {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} @show_tooltip(__('tooltip.pay_term'))
                            <br/>
                            {!! Form::number('pay_term_number', null, ['class' => 'form-control width-40 pull-left', 'placeholder' => __('contact.pay_term')]); !!}
        
                            {!! Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], '', ['class' => 'form-control width-60 pull-left','placeholder' => __('messages.please_select')]); !!}
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
        
                @php
                $common_settings = session()->get('business.common_settings');
                $default_credit_limit = !empty($common_settings['default_credit_limit']) ? $common_settings['default_credit_limit'] : null;
                @endphp
        
                <div class="col-md-12 customer_fields">
                    <div class="form-group">
                        {!! Form::label('credit_limit', __('lang_v1.credit_limit') . ':') !!}
                        <div class="input-group" style="width: 100%;">
                            <span class="input-group-addon">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            {!! Form::text('credit_limit', $default_credit_limit ?? null, ['class' => 'form-control input_number']); !!}
                        </div>
                        <p class="help-block">@lang('lang_v1.credit_limit_help')</p>
                    </div>
                </div>
        
                <div class="col-md-12 "><hr/></div>
                <div class="clearfix"></div>
                            <!-- Add similar Bootstrap-styled collapse sections for other form elements -->
        
                            <div class="col-md-12 shipping_addr_div"><hr></div>
                            <div class="col-md-8 col-md-offset-2 shipping_addr_div mb-10">
                                <strong>{{__('lang_v1.shipping_address')}}</strong><br>
                                {!! Form::text('shipping_address', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); !!}
                                <div class="mb-10" id="map"></div>
        
                                @if(!empty($common_settings['is_enabled_export']))
                                    <div class="col-md-12 mb-12">
                                        <div class="form-check">
                                            <input type="checkbox" name="is_export" class="form-check-input" id="is_customer_export">
                                            <label class="form-check-label" for="is_customer_export">@lang('lang_v1.is_export')</label>
                                        </div>
                                    </div>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @for($i; $i <= 6 ; $i++)
                                        <div class="col-md-12 export_div">
                                            <div class="form-group">
                                                {!! Form::label('export_custom_field_'.$i, __('lang_v1.export_custom_field'.$i).':' ) !!}
                                                {!! Form::text('export_custom_field_'.$i, null, ['class' => 'form-control','placeholder' => __('lang_v1.export_custom_field'.$i)]); !!}
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.partials.module_form_part')
    </div>
    
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.save' )</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}
  
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
