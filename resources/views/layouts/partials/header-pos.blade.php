<!-- default value -->
@php


        //Check if subscribed or not
 
    $go_back_url = action([\App\Http\Controllers\SellPosController::class, 'index']);
    $transaction_sub_type = '';
    $view_suspended_sell_url = action([\App\Http\Controllers\SellController::class, 'index']).'?suspended=1';

    $view_expensive =  action([\App\Http\Controllers\ExpenseController::class, 'create']);
    $pos_redirect_url = action([\App\Http\Controllers\SellPosController::class, 'create']);
   $view_sell_return = action([\App\Http\Controllers\SellReturnController::class, 'create'], 

);

@endphp

@if(!empty($pos_module_data))
    @foreach($pos_module_data as $key => $value)
        @php
            if(!empty($value['go_back_url'])) {
                $go_back_url = $value['go_back_url'];
            }

            if(!empty($value['transaction_sub_type'])) {
                $transaction_sub_type = $value['transaction_sub_type'];
                $view_suspended_sell_url .= '&transaction_sub_type='.$transaction_sub_type;
                $pos_redirect_url .= '?sub_type='.$transaction_sub_type;
            }
        @endphp
    @endforeach
@endif
<input type="hidden" name="transaction_sub_type" id="transaction_sub_type" value="{{$transaction_sub_type}}">
@inject('request', 'Illuminate\Http\Request')

<div class="pos-heading no-print w-100 ">








  <div class="col-md-12 pos-heading no-print border">
    <input type="hidden" id="pos_redirect_url" value="{{$pos_redirect_url}}">
    <div class="row">
      <div class="col-md-8">
        <div class="m-6 mt-5" style="display: flex;">
          <p><strong>@lang('sale.location'): &nbsp;</strong> 
            @if(empty($transaction->location_id))
              @if(count($business_locations) > 1)
                <div>
                   {!! Form::select('select_location_id', $business_locations, $default_location->id ?? null , ['class' => 'form-control input-sm',
                    'id' => 'select_location_id', 
                    'required', 'autofocus'], $bl_attributes); !!}
                </div>
              @else
                {{$default_location->name}}
              @endif
            @endif
            @if(!empty($transaction->location_id)) {{$transaction->location->name}} @endif &nbsp; <span class="curr_datetime">{{ @format_datetime('now') }}</span> <i class="fa fa-keyboard hover-q text-muted" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')" data-html="true" data-trigger="hover" data-original-title="" title=""></i>
          </p>
        </div>
      </div>
  
  
      <div class="col-md-3"> <!-- Changed col-md-8 to col-md-4 to properly align buttons -->
        <div class="m-6 mt-5" style="display: flex; justify-content: flex-end;"> <!-- Added justify-content: flex-end; to align buttons to the right -->
          <a href="{{$go_back_url}}" title="{{ __('lang_v1.go_back') }}" class="btn btn-info btn-flat m-1 btn-xs pull-right btn-sm"> <!-- Adjusted margin class to m-1 for proper spacing -->
            <strong><i class="fa fa-backward fa-lg"></i></strong>
          </a>
  
          {{--  زر الرجوع  --}}
          <!-- Adjusted button classes for responsiveness -->
  
          @if(!empty($pos_settings['inline_service_staff']))
            <button type="button" id="show_service_staff_availability" title="{{ __('lang_v1.service_staff_availability') }}" class="btn btn-primary btn-flat m-1 btn-xs btn-sm" data-container=".view_modal" 
              data-href="{{ action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility'])}}">
                <strong><i class="fa fa-users fa-lg"></i></strong>
            </button>
          @endif
  {{-- اغلاق الورديه --}}
          @can('close_cash_register')
      
          <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="add-user-modal-btn btn-modal pull-right" data-container=".view_modal"  data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister'])}}" data-original-title="Close Register">
            <img src="https://demo.bardpos.com/img/icons/close-register.svg" alt="">
      </button>
          @endcan
          {{-- فتح الورديه --}}
          @can('view_cash_register')
          <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" class="btn btn-success btn-flat m-1 btn-xs btn-modal btn-sm" data-container=".view_modal"
              data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails'])}}">
                <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
          </button>
          @endcan
  
     
  
         
  {{--  اله الحاسبه --}}
          {{-- <button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button" class="btn btn-success btn-flat m-1 btn-xs btn-sm popover-default" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
                <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
          </button> --}}
  {{-- مرتجع مبيعات --}}
          {{-- <button type="button" class="btn btn-danger btn-flat m-1 btn-xs btn-sm popover-default" id="return_sale" title="@lang('lang_v1.sell_return')" data-toggle="popover" data-trigger="click" data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang("sale.invoice_no")" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="btn btn-danger" id="send_for_sell_return">@lang("lang_v1.send")</button></div>' data-html="true" data-placement="bottom">
                <strong><i class="fas fa-undo fa-lg"></i></strong>
          </button> --}}
  
  
  {{-- <button type="button" class="btn btn-danger btn-flat m-1 btn-xs btn-sm" 
          id="return_sale" 
          title="Sell Return" 
          data-toggle="popover" 
          data-trigger="click" 
          data-content='<div class="m-8"><input type="text" class="form-control" placeholder="Invoice No" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="btn btn-danger" id="send_for_sell_return">Send</button></div>' 
          data-html="true" 
          data-placement="bottom" 
          data-href="{{$view_sell_return}}">
      <strong><i class="fas fa-undo fa-lg"></i></strong>
  </button> --}}
          {{-- تكبير الشاشه --}}
  {{-- 
    
          <button type="button" title="{{ __('lang_v1.full_screen') }}" class="btn btn-primary btn-flat m-1 btn-xs btn-sm" id="full_screen">
                <strong><i class="fa fa-window-maximize fa-lg"></i></strong>
          </button> --}}
  {{-- مبيعات معلقه --}}
          <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}" class="btn bg-yellow btn-flat m-1 btn-xs btn-modal btn-sm" data-container=".view_modal" 
              data-href="{{$view_suspended_sell_url}}">
                <strong><i class="fa fa-pause-circle fa-lg"></i></strong>
          </button>
          @if(empty($pos_settings['hide_product_suggestion']) && isMobile())
            <button type="button" title="{{ __('lang_v1.view_products') }}"   
              data-placement="bottom" class="btn btn-success btn-flat m-1 btn-xs btn-modal btn-sm" data-toggle="modal" data-target="#mobile_product_suggestion_modal">
                <strong><i class="fa fa-cubes fa-lg"></i></strong>
            </button>
          @endif
  {{-- الصيانه --}}
          @if(Module::has('Repair') && $transaction_sub_type != 'repair')
            @include('repair::layouts.partials.pos_header')
          @endif
  
            {{-- @if(in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type))
              @can('sell.create')
                <a href="{{action([\App\Http\Controllers\SellPosController::class, 'create'])}}" title="@lang('sale.pos_sale')" class="btn btn-success btn-flat m-1 btn-xs btn-sm"">
                  <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
                </a>
              @endcan
            @endif --}}
  
            {{-- اضافه مصاريف --}}
  
       
            @can('expense.add')
            <button type="button" id="add_expense" title="{{ __('expense.add_expense') }}"    class="btn bg-purple btn-flat m-1 btn-xs btn-modal btn-sm" data-container=".view_modal" 
            data-href="{{$view_expensive}}">
            <strong><i class="fa fas fa-minus-circle"></i> </strong>
  
        </button>
            @endcan
        </div>
      </div>
    </div>
  </div>
  
</div>
