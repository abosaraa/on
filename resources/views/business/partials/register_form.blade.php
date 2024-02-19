@if(empty($is_admin))
    <h3></h3>
@endif
{!! Form::hidden('language', request()->lang); !!}

<fieldset>
{{-- <legend>@lang('business.business_details'):</legend> --}}
<!-- Owner Information -->
@if(empty($is_admin))
<h3></h3>
@endif


{{-- <legend>@lang('business.owner_info')</legend> --}}

        {!! Form::text('surname', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('اللقب')]); !!}


        {!! Form::text('first_name', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('الاسم الاول'), 'required']); !!}


        {!! Form::text('last_name', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' =>  __('الاسم الثاني')]); !!}

        {!! Form::text('username', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('اسم المستخدم'), 'required']); !!}

        {!! Form::text('email', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('البريد الالكتروني'), 'required']); !!}

        {!! Form::password('password', ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('كلمه المرور'), 'required']); !!}


        {!! Form::password('confirm_password', ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('تاكيد كلمه المرور  '), 'required']); !!}

{{-- @if(!empty($system_settings['superadmin_enable_register_tc']))
<div class="form-group">
    <label>
        {!! Form::checkbox('accept_tc', 0, false, ['required', 'class' => 'input-icheck']); !!}
        <u><a class="terms_condition cursor-pointer" data-toggle="modal" data-target="#tc_modal">
            @lang('lang_v1.accept_terms_and_conditions') <i></i>
        </a></u>
    </label>
</div>
@include('business.partials.terms_conditions')
@endif --}}
  
        {!! Form::  text('name', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker', 'placeholder' => __('اسم النشاط'), 'required']); !!}
 

        {{-- {!! Form::text('start_date', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker start-date-picker', 'placeholder' => __('business.start_date'), 'readonly']); !!} --}}

     
{{-- 
    {!! Form::label('business_logo', __('business.upload_logo') . ':') !!}
    {!! Form::file('business_logo', ['accept' => 'image/*']); !!} --}}


        {{-- {!! Form::text('website', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker', 'placeholder' => __('lang_v1.website')]); !!} --}}

        {!! Form::text('mobile', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker', 'placeholder' => __('رقم الهاتف')]); !!}


{{-- 
                {!! Form::text('alternate_number', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('business.alternate_number')]); !!}
  

   --}}
  
            {!! Form::text('country', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('الدوله'), 'required']); !!}
       


            {!! Form::text('state', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('المنطقه'), 'required']); !!}
       

            {!! Form::text('city', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('المدينه'), 'required']); !!}
    
  
            {!! Form::text('zip_code', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('business.zip_code_placeholder'), 'required']); !!}
      
    
            {!! Form::text('landmark', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('العنوان'), 'required']); !!}
     
            {!! Form::select('currency_id', $currencies, '', ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker select2_register', 'placeholder' => __('اختر العمله'), 'required']); !!}

                {!! Form::select('time_zone', $timezone_list, config('app.timezone'), ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker select2_register','placeholder' => __('التوقيت العالمي'), 'required']); !!}
       
    


    <!-- tax details -->
    @if(empty($is_admin))
        <h3></h3>

        
        {{-- <legend>@lang('business.business_settings'):</legend> --}}
      
                    {!! Form::text('tax_label_1', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('الاسم الضريبي')]); !!}
  

     
                    {!! Form::text('tax_number_1', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('الرقم الضريبي')]); !!}

                    {!! Form::text('tax_label_2', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('الاسم الضريبي 2')]); !!}
    

                    {!! Form::text('tax_number_2', null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker','placeholder' => __('الرقم الضريبي 2 ')]); !!}
     
       
                  
                    {!! Form::select('fy_start_month', $months, null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker select2_register', 'required', 'style' => 'width:100%;']); !!}
          
       
                    {!! Form::select('accounting_method', $accounting_methods, null, ['class' => 'w-full px-4 py-2 border rounded-md dark:bg-darker dark:border-gray-700 focus:outline-none focus:ring focus:ring-primary-100 dark:focus:ring-primary-darker select2_register', 'required', 'style' => 'width:100%;' ]); !!}
       
        
    @endif

    
    
</fieldset>


    