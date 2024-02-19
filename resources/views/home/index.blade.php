@extends('layouts.master')
@section('title', __('home.home'))




@section('content')

<!-- Content Header (Page header) -->
{{-- <section class="content-header content-header-custom">
    <h1>{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}</h1>
</section>
 --}}

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}

<style>
    .io {
        margin: 10px !important;
        border-radius: 8px;
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        z-index: 1;
        background: linear-gradient(135deg, #ff9d6c, #ffa03f);
        padding: 15px;
        transition: background 0.3s ease, transform 0.2s ease;
        font-size: 18px;
        color: #ffffff;
        border: 2px solid #ff9f57;
  
    }

    .io:hover {
        background: linear-gradient(135deg, #e74c3c, #e82d0e);
        transform: scale(1.05);
    }

    .io p {
        margin-bottom: 10px;
        font-weight: bold;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: none !important;
    }
   
.my-auto {
   
    width: 70% !important;
}
</style>



@endsection
<!-- Main content -->
<section class="content content-custom no-print">
    <br>
    @if(auth()->user()->can('dashboard.data'))
        @if($is_admin)
        <div class="breadcrumb-header justify-content-between">
            
            <div class="my-auto">
                @if(count($all_locations) > 1)
                    {!! Form::select('dashboard_location', $all_locations, null, [
                        'class' => 'form-control nice-select custom-select',
                        'placeholder' => __('lang_v1.select_location'),
                        'id' => 'dashboard_location'
                    ]); !!}
                @endif
            </div>


            <div class="d-flex my-xl-auto right-content filter">
                <div class="mb-3 mb-xl-0">
                    <button type="button" class="btn"  style="background-color: #ffffff;" id="dashboard_date_filter">
                        <img src="https://demo.bardpos.com/img/icons/filter.svg" alt="">

                        {{-- <span>
                         {{ __('messages.filter_by_date') }}
                        </span>
                        <i class="fa fa-caret-down"></i> --}}
                    </button>
                </div>
            </div>
        </div>
        
        
        
           <br>
  


          


           {{-- <div class="overview-filter">
            <div class="title">
                <h1>Awesome Shop</h1>
                <p>Welcome Super,</p>
            </div>



                                                <div class="">
                        <div class="form-box">
                                                    </div>

                        <button id="dashboard_date_filter">
                            <span>Filter</span>
                        </button>
                    </div>
                                    </div>
 --}}







            {{-- <div class="row row-sm">
                <div class="col-md-6">
                
                        
                    
                </div>


                <div class="col-md-6">

                 
                   
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">

             
            </div>




            <div class="col-md-6">

                
                    
                
            </div>
            </div>

             
      



















            <div class="row row-sm">
                <div class="col-md-6">

                
                        <div class="card-body io  i">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center">
                                        <img src="{{asset('img/return-svgrepo-com.svg')}}" alt="" style="    max-width: 100%;
                                        height: 50px;
                                        margin-bottom: 10px;">
        
                                        
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">{{ __('lang_v1.total_sell_return_paid') }}</span>
                                        <h2 class="text-white mb-0 total_srp "><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>


                <div class="col-md-6">

                 
                        <div class="card-body io  i">
                            <div class="row">
                                <div class="col-6">
                                    <div class="icon1 mt-2 text-center">
                                        <img src="{{asset('img/saco.svg')}}" alt="" style="    max-width: 100%;
                                        height: 50px;
                                        margin-bottom: 10px;">
        
                                        
                                    </div>
                               
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span class="text-white ">{{ __('lang_v1.expense') }}</span>
                                        <h2 class="text-white mb-0 total_expense"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                </div>


            </div>

            <div class="row">
                <div class="col-md-6">

             
                    <div class="card-body io i">
                        <div class="row">
                            <div class="col-6">
                                
                        <div class="icon1 mt-2 text-center">
                            <img src="{{asset('img/money-cash-svgrepo-com.svg')}}" alt="" style="    max-width: 100%;
                            height: 50px;
                            margin-bottom: 10px;">

                            
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white  ">
                                        {{ __('lang_v1.total_purchase_return_paid')}}
                                    </span>
                                    <h2 class="text-white mb-0 net"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h2>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                
            </div>




            <div class="col-md-6">

                
                    <div class="card-body io i">
                        <div class="row">
                            <div class="col-6">
                                
                        <div class="icon1 mt-2 text-center">
                            <img src="{{asset('img/money-commerce-and-shopping-svgrepo-com.svg')}}" alt="" style="    max-width: 100%;
                            height: 50px;
                            margin-bottom: 10px;">

                            
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">{{ __('lang_v1.total_purchase_return') }}</span>
                                    <h2 class="text-white mb-0 total_purchase_return"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
            </div>
                --}}




























            
                











<div class="quick-data">

                    <!-- Sales -->
                    <div class="item">
                        <div class="head">
                            <img src="{{asset('img/sales.svg')}}" alt=""  style="    max-width: 100%;
                            height: 50px;
                            margin-bottom: 10px;">
                        </div>

                        <div class="body">
                            <div class="data-name">
                                <h5>{{ __('home.total_sell') }}</h5>
                                <h3>
                                    <span class="info-box-number total_sell"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                                </h3>
                            </div>


                        </div>

               
                    </div>

                    <!-- Sales -->
                    <div class="item">
                        <div class="head">
                            <img src="{{asset('img/Pending-payment.svg')}}" alt="" style="    max-width: 100%;
                            height: 50px;
                            margin-bottom: 10px;">
             
                        </div>

                        <div class="body">
                            <div class="data-name">
                                <h5>       {{ __('home.invoice_due') }}</h5>
                                <h3>
                                    <span class="info-box-number invoice_due"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                                </h3>
                            </div>


                        </div>
                    </div>

                   

















                    <!-- Sales -->
                    <div class="item">
                        <div class="head">
                            <img src="{{asset('img/Expenses-icon.svg')}}" alt="" >
                        </div>

                        <div class="body">
                            <div class="data-name">
                                <h5>{{ __('home.total_purchase') }}</h5>
                                <h3>
                                    <span class="info-box-number total_purchase"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                                </h3>
                            </div>


                        </div>
                    </div>




                   
                   











                    <!-- Sales -->
                    <div class="item">
                        <div class="head">
                            <img src="{{asset('img/Purchase.svg')}}" alt="">
                     
                          
                        </div>

                        <div class="body">
                            <div class="data-name">
                                <h5>{{ __('lang_v1.total_costs') }}</h5>
                                <h3><span class="info-box-number net"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span></h3>
                            </div>


                        </div>
                    </div>



               

                    

                </div>



         
             
                
               
                    <!-- Info box for total_purchase_return -->
               
                    <!-- Info box for total_purchase_return_paid -->
               



















           
{{-- 
                
                    <!-- Info box for total_sell_return -->
                    <div class="col-md-4 col-sm-6 col-xs-12 col-custom">
                        <div class="info-box info-box-new-style">
                            <span class="info-box-icon bg-yellow i">
                                <i class="fas fa-exchange-alt"></i>
                            </span>
                
                            <div class="info-box-content">
                                <span class="info-box-text">{{ __('lang_v1.total_sell_return') }}</span>
                                <span class="info-box-number total_sell_return"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                 --}}
                    <!-- Info box for total_sell_return_paid -->
                    




            
            @if(!empty($widgets['after_sale_purchase_totals']))
                @foreach($widgets['after_sale_purchase_totals'] as $widget)
                    {!! $widget !!}
                @endforeach
            @endif
       
       
       
       
       
       
       
       
       
       
       
       
       
       
            @endif 
        <!-- end is_admin check -->
         @if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
            @if(!empty($all_locations))
                <!-- sales chart start -->
                <div class="row">
                    <div class="col-sm-6">
                        @component('components.widget', ['class' => 'box-primary', 'title' => __('home.sells_last_30_days')])
                          {!! $sells_chart_1->container() !!}
                        @endcomponent
                    </div>
              
            @endif
            @if(!empty($widgets['after_sales_last_30_days']))
                @foreach($widgets['after_sales_last_30_days'] as $widget)
                    {!! $widget !!}
                @endforeach
            @endif
            @if(!empty($all_locations))
                
                    <div class="col-sm-6">
                        @component('components.widget', ['class' => 'box-primary', 'title' => __('home.sells_current_fy')])
                          {!! $sells_chart_2->container() !!}
                        @endcomponent
                    </div>
              
            @endif
                </div>
        @endif
        <!-- sales chart end -->
        @if(!empty($widgets['after_sales_current_fy']))
            @foreach($widgets['after_sales_current_fy'] as $widget)
                {!! $widget !!}
            @endforeach
        @endif


 
          
          
          



        
        <!-- products less than alert quntity -->
        <div class="row">
            @if(auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
    <div class="col-sm-6">
        @component('components.widget', ['class' => 'box-warning'])
            {{-- @slot('icon')
                <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
            @endslot --}}
            @slot('title')
                {{ __('lang_v1.sales_payment_dues') }} @show_tooltip(__('lang_v1.tooltip_sales_payment_dues'))
            @endslot
            <div class="row mb-5">
                @if(count($all_locations) > 1)
                    <div class="col-md-6 ">
                        {!! Form::select('sales_payment_dues_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'sales_payment_dues_location']); !!}
                    </div>
                @endif
                <div class="col-md-12">
                   
                    <table class="table table-bordered" id="sales_payment_dues_table"  style="width:100% !important;">
                        <thead >
                            <tr>
                                <th>@lang( 'contact.customer' )</th>
                                <th>@lang( 'sale.invoice_no' )</th>
                                <th>@lang( 'home.due_amount' )</th>
                                <th>@lang( 'messages.action' )</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        @endcomponent
    </div>
@endif

            @can('purchase.view')
                <div class="col-sm-6">
                    @component('components.widget', ['class' => 'box-warning'])
                    {{-- @slot('icon')
                    <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                    @endslot --}}
                    @slot('title')
                    {{ __('lang_v1.purchase_payment_dues') }} @show_tooltip(__('tooltip.payment_dues'))
                    @endslot
                    <div class="row mb-5">
                        @if(count($all_locations) > 1)
                            <div class="col-md-6">
                                {!! Form::select('purchase_payment_dues_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'purchase_payment_dues_location']); !!}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <table class="table table-bordered  " id="purchase_payment_dues_table" style="width: 100%;">
                                <thead >
                                  <tr>
                                    <th>@lang( 'purchase.supplier' )</th>
                                    <th>@lang( 'purchase.ref_no' )</th>
                                    <th>@lang( 'home.due_amount' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                  </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    @endcomponent
                </div>
            @endcan
        </div> 



        @if((auth()->user()->can('so.view_all') || auth()->user()->can('so.view_own')) && (auth()->user()->can('access_pending_shipments_only') || auth()->user()->can('access_shipping') || auth()->user()->can('access_own_shipping')))
        <!-- Your code goes here -->

    
     

{{-- 

            <div class="row">
                <div class="col-md-12">
                    @component('components.widget', ['class' => 'box-warning'])
               
                    @slot('title')
                        @lang('lang_v1.pending_shipments')
                    @endslot
                      <div class="row">
                          @if(count($all_locations) > 1)
                              <div class="col-md-6">
                                  {!! Form::select('pending_shipments_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'pending_shipments_location']); !!}
                              </div>
                          @endif
                          <div class="col-md-12">  
                              <div class="table-responsive">
                                  <table class="table table-bordered  " id="shipments_table">
                                      <thead >
                                          <tr>
                                              <th>@lang('messages.action')</th>
                                              <th>@lang('messages.date')</th>
                                              <th>@lang('sale.invoice_no')</th>
                                              <th>@lang('sale.customer_name')</th>
                                              <th>@lang('lang_v1.contact_no')</th>
                                              <th>@lang('sale.location')</th>
                                              <th>@lang('lang_v1.shipping_status')</th>
                                              @if(!empty($custom_labels['shipping']['custom_field_1']))
                                                  <th>
                                                      {{$custom_labels['shipping']['custom_field_1']}}
                                                  </th>
                                              @endif
                                              @if(!empty($custom_labels['shipping']['custom_field_2']))
                                                  <th>
                                                      {{$custom_labels['shipping']['custom_field_2']}}
                                                  </th>
                                              @endif
                                              @if(!empty($custom_labels['shipping']['custom_field_3']))
                                                  <th>
                                                      {{$custom_labels['shipping']['custom_field_3']}}
                                                  </th>
                                              @endif
                                              @if(!empty($custom_labels['shipping']['custom_field_4']))
                                                  <th>
                                                      {{$custom_labels['shipping']['custom_field_4']}}
                                                  </th>
                                              @endif
                                              @if(!empty($custom_labels['shipping']['custom_field_5']))
                                                  <th>
                                                      {{$custom_labels['shipping']['custom_field_5']}}
                                                  </th>
                                              @endif
                                              <th>@lang('sale.payment_status')</th>
                                              <th>@lang('restaurant.service_staff')</th>
                                          </tr>
                                      </thead>
                                  </table>
                              </div>
                          </div> 
                      </div>
                  @endcomponent
                </div>


                <div class="col-md-12">
           

                    @component('components.widget', ['class' => 'box-warning'])
                     
                    @slot('title')
                        {{__('lang_v1.sales_order')}}
                    @endslot
                    <div class="row">
                    @if(count($all_locations) > 1)
                        <div class="col-md-6">
                            {!! Form::select('so_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'so_location']); !!}
                        </div>
                    @endif
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered   " id="sales_order_table">
                                    <thead >
                                        <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('restaurant.order_no')</th>
                                            <th>@lang('sale.customer_name')</th>
                                            <th>@lang('lang_v1.contact_no')</th>
                                            <th>@lang('sale.location')</th>
                                            <th>@lang('sale.status')</th>
                                            <th>@lang('lang_v1.shipping_status')</th>
                                            <th>@lang('lang_v1.quantity_remaining')</th>
                                            <th>@lang('lang_v1.added_by')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                @endcomponent
                </div>
            </div>

        --}}


             @endif
     
        @can('stock_report.view')
            <div class="row">
                <div class="@if((session('business.enable_product_expiry') != 1) && auth()->user()->can('stock_report.view')) col-sm-12 @else col-sm-6 @endif">
                    @component('components.widget', ['class' => 'box-warning'])
                    
                      @slot('title')
                        {{ __('home.product_stock_alert') }} @show_tooltip(__('tooltip.product_stock_alert'))
                      @endslot
                      <div class="row">
                            @if(count($all_locations) > 1)
                                <div class="col-md-12 col-sm-12 col-md-offset-12 mb-10">
                                    {!! Form::select('stock_alert_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'stock_alert_location']); !!}
                                </div>
                            @endif
                            <div class="col-md-12">
                                <table class="table table-bordered " id="stock_alert_table" style="width: 100%;">
                                    <thead >
                                      <tr>
                                        <th>@lang( 'sale.product' )</th>
                                        <th>@lang( 'business.location' )</th>
                                        <th>@lang( 'report.current_stock' )</th>
                                      </tr>
                                    </thead>
                                </table>
                            </div>
                      </div>
                    @endcomponent
                </div>
                @if(session('business.enable_product_expiry') == 1)
                    <div class="col-sm-12">
                        @component('components.widget', ['class' => 'box-warning'])
                          {{-- @slot('icon')
                            <i class="fa fa-exclamation-triangle text-yellow" aria-hidden="true"></i>
                          @endslot --}}
                          @slot('title')
                            {{ __('home.stock_expiry_alert') }} @show_tooltip( __('tooltip.stock_expiry_alert', [ 'days' =>session('business.stock_expiry_alert_days', 30) ]) )
                          @endslot
                          <input type="hidden" id="stock_expiry_alert_days" value="{{ \Carbon::now()->addDays(session('business.stock_expiry_alert_days', 30))->format('Y-m-d') }}">
                          <table class="table table-bordered  " id="stock_expiry_alert_table" style="width: 100%">
                            <thead class="bg-dark">
                              <tr>
                                  <th>@lang('business.product')</th>
                                  <th>@lang('business.location')</th>
                                  <th>@lang('report.stock_left')</th>
                                  <th>@lang('product.expires_in')</th>
                              </tr>
                            </thead>
                          </table>
                        @endcomponent
                    </div>
                @endif
            </div>
        @endcan
      

        @if(!empty($common_settings['enable_purchase_requisition']) && (auth()->user()->can('purchase_requisition.view_all') || auth()->user()->can('purchase_requisition.view_own')) )
            <div class="row" @if(!auth()->user()->can('dashboard.data'))style="margin-top: 190px !important;"@endif>
                <div class="col-sm-6">
                    @component('components.widget', ['class' => 'box-warning'])
                      @slot('icon')
                          <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                          @lang('lang_v1.purchase_requisition')
                      @endslot
                        <div class="row">
                        @if(count($all_locations) > 1)
                            <div class="col-md-6">
                                {!! Form::select('pr_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'pr_location']); !!}
                            </div>
                        @endif
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered   ajax_view" id="purchase_requisition_table" style="width: 100%;">
                                      <thead class="bg-danger">
                                          <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('purchase.ref_no')</th>
                                            <th>@lang('purchase.location')</th>
                                            <th>@lang('sale.status')</th>
                                            <th>@lang('lang_v1.required_by_date')</th>
                                            <th>@lang('lang_v1.added_by')</th>
                                          </tr>
                                      </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcomponent
                </div>
            </div>
        @endif

        @if(!empty($common_settings['enable_purchase_order']) && (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')) )
            <div class="row" @if(!auth()->user()->can('dashboard.data'))style="margin-top: 190px !important;"@endif>
                <div class="col-sm-6">
                    @component('components.widget', ['class' => 'box-warning'])
                      @slot('icon')
                          <i class="fas fa-list-alt text-yellow fa-lg" aria-hidden="true"></i>
                      @endslot
                      @slot('title')
                          @lang('lang_v1.purchase_order')
                      @endslot
                        <div class="row">
                        @if(count($all_locations) > 1)
                            <div class="col-md-6">
                                {!! Form::select('po_location', $all_locations, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_location'), 'id' => 'po_location']); !!}
                            </div>
                        @endif
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered   ajax_view" id="purchase_order_table" style="width: 100%;">
                                      <thead class="bg-red">
                                          <tr>
                                              <th>@lang('messages.action')</th>
                                              <th>@lang('messages.date')</th>
                                              <th>@lang('purchase.ref_no')</th>
                                              <th>@lang('purchase.location')</th>
                                              <th>@lang('purchase.supplier')</th>
                                              <th>@lang('sale.status')</th>
                                              <th>@lang('lang_v1.quantity_remaining')</th>
                                              <th>@lang('lang_v1.added_by')</th>
                                          </tr>
                                      </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endcomponent
                </div>
            </div>
        @endif

      
        @if(auth()->user()->can('account.access') && config('constants.show_payments_recovered_today') == true)
            @component('components.widget', ['class' => 'box-warning'])
              @slot('icon')
                  <i class="fas fa-money-bill-alt text-yellow fa-lg" aria-hidden="true"></i>
              @endslot
              @slot('title')
                  @lang('lang_v1.payment_recovered_today')
              @endslot
                <div class="table-responsive">
                    <table class="table table-bordered  " id="cash_flow_table">
                        <thead class="bg-info">
                            <tr>
                                <th>@lang( 'messages.date' )</th>
                                <th>@lang( 'account.account' )</th>
                                <th>@lang( 'lang_v1.description' )</th>
                                <th>@lang( 'lang_v1.payment_method' )</th>
                                <th>@lang( 'lang_v1.payment_details' )</th>
                                <th>@lang('account.credit')</th>
                                <th>@lang( 'lang_v1.account_balance' ) @show_tooltip(__('lang_v1.account_balance_tooltip'))</th>
                                <th>@lang( 'lang_v1.total_balance' ) @show_tooltip(__('lang_v1.total_balance_tooltip'))</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                <td class="footer_total_credit"></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
        @endif

        @if(!empty($widgets['after_dashboard_reports']))
          @foreach($widgets['after_dashboard_reports'] as $widget)
            {!! $widget !!}
          @endforeach
        @endif

    @endif
   <!-- can('dashboard.data') end -->
</section>
<!-- /.content -->
<div class="modal  payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal  edit_pso_status_modal" tabindex="-1" role="dialog"></div>
<div class="modal  edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')

    <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    @includeIf('sales_order.common_js')
    @includeIf('purchase_order.common_js')
    @if(!empty($all_locations))
        {!! $sells_chart_1->script() !!}
        {!! $sells_chart_2->script() !!}
    @endif
    <script type="text/javascript">
        $(document).ready( function(){
        sales_order_table = $('#sales_order_table').DataTable({
          processing: true,
          serverSide: true,
     
          aaSorting: [[1, 'desc']],
          "ajax": {
              "url": '{{action([\App\Http\Controllers\SellController::class, 'index'])}}?sale_type=sales_order',
              "data": function ( d ) {
                    d.for_dashboard_sales_order = true;

                    if ($('#so_location').length > 0) {
                        d.location_id = $('#so_location').val();
                    }
                }
          },
          columnDefs: [ {
              "targets": 7,
              "orderable": false,
              "searchable": false
          } ],
         
          columns: [
              { data: 'action', name: 'action'},
              { data: 'transaction_date', name: 'transaction_date'  },
              { data: 'invoice_no', name: 'invoice_no'},
              { data: 'conatct_name', name: 'conatct_name'},
              { data: 'mobile', name: 'contacts.mobile'},
              { data: 'business_location', name: 'bl.name'},
              { data: 'status', name: 'status'},
              { data: 'shipping_status', name: 'shipping_status'},
              { data: 'so_qty_remaining', name: 'so_qty_remaining', "searchable": false},
              { data: 'added_by', name: 'u.first_name'},
          ]
          responsive:true
        });

        @if(auth()->user()->can('account.access') && config('constants.show_payments_recovered_today') == true)

            // Cash Flow Table
            cash_flow_table = $('#cash_flow_table').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                        "url": "{{action([\App\Http\Controllers\AccountController::class, 'cashFlow'])}}",
                        "data": function ( d ) {
                            d.type = 'credit';
                            d.only_payment_recovered = true;
                        }
                    },
                "ordering": false,
                "searching": false,
                columns: [
                    {data: 'operation_date', name: 'operation_date'},
                    {data: 'account_name', name: 'account_name'},
                    {data: 'sub_type', name: 'sub_type'},
                    {data: 'method', name: 'TP.method'},
                    {data: 'payment_details', name: 'payment_details', searchable: false},
                    {data: 'credit', name: 'amount'},
                    {data: 'balance', name: 'balance'},
                    {data: 'total_balance', name: 'total_balance'},
                ],
                "fnDrawCallback": function (oSettings) {
                    __currency_convert_recursively($('#cash_flow_table'));
                },
                "footerCallback": function ( row, data, start, end, display ) {
                    var footer_total_credit = 0;

                    for (var r in data){
                        footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(data[r].credit).data('orig-value')) : 0;
                    }
                    $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
                }
            });
        @endif

        $('#so_location').change( function(){
            sales_order_table.ajax.reload();
        });
        @if(!empty($common_settings['enable_purchase_order']))
          //Purchase table
          purchase_order_table = $('#purchase_order_table').DataTable({
              processing: true,
              serverSide: true,
     
              ajax: {
                  url: '{{action([\App\Http\Controllers\PurchaseOrderController::class, 'index'])}}',
                  data: function(d) {
                      d.from_dashboard = true;

                        if ($('#po_location').length > 0) {
                            d.location_id = $('#po_location').val();
                        }
                  },
              },
              columns: [
                  { data: 'action', name: 'action', orderable: false, searchable: false },
                  { data: 'transaction_date', name: 'transaction_date' },
                  { data: 'ref_no', name: 'ref_no' },
                  { data: 'location_name', name: 'BS.name' },
                  { data: 'name', name: 'contacts.name' },
                  { data: 'status', name: 'transactions.status' },
                  { data: 'po_qty_remaining', name: 'po_qty_remaining', "searchable": false},
                  { data: 'added_by', name: 'u.first_name' }
              ]
              responsive:true
            })

            $('#po_location').change( function(){
                purchase_order_table.ajax.reload();
            });
        @endif

        @if(!empty($common_settings['enable_purchase_requisition']))
          //Purchase table
          purchase_requisition_table = $('#purchase_requisition_table').DataTable({
              processing: true,
              serverSide: true,
       
              ajax: {
                  url: '{{action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index'])}}',
                  data: function(d) {
                      d.from_dashboard = true;

                        if ($('#pr_location').length > 0) {
                            d.location_id = $('#pr_location').val();
                        }
                  },
              },
              columns: [
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                    { data: 'transaction_date', name: 'transaction_date' },
                    { data: 'ref_no', name: 'ref_no' },
                    { data: 'location_name', name: 'BS.name' },
                    { data: 'status', name: 'status' },
                    { data: 'delivery_date', name: 'delivery_date' },
                    { data: 'added_by', name: 'u.first_name' },
              ]
              responsive:true
            })

            $('#pr_location').change( function(){
                purchase_requisition_table.ajax.reload();
            });

            $(document).on('click', 'a.delete-purchase-requisition', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(willDelete => {
                    if (willDelete) {
                        var href = $(this).attr('href');
                        $.ajax({
                            method: 'DELETE',
                            url: href,
                            dataType: 'json',
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    purchase_requisition_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                        });
                    }
                });
            });
        @endif

        sell_table = $('#shipments_table').DataTable({
            processing: true,
            serverSide: true,
    
            "ajax": {
                "url": '{{action([\App\Http\Controllers\SellController::class, 'index'])}}',
                "data": function ( d ) {
                    d.only_pending_shipments = true;
                    if ($('#pending_shipments_location').length > 0) {
                        d.location_id = $('#pending_shipments_location').val();
                    }
                }
            },
            columns: [
                { data: 'action', name: 'action', searchable: false, orderable: false},
                { data: 'transaction_date', name: 'transaction_date'  },
                { data: 'invoice_no', name: 'invoice_no'},
                { data: 'conatct_name', name: 'conatct_name'},
                { data: 'mobile', name: 'contacts.mobile'},
                { data: 'business_location', name: 'bl.name'},
                { data: 'shipping_status', name: 'shipping_status'},
                @if(!empty($custom_labels['shipping']['custom_field_1']))
                    { data: 'shipping_custom_field_1', name: 'shipping_custom_field_1'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_2']))
                    { data: 'shipping_custom_field_2', name: 'shipping_custom_field_2'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_3']))
                    { data: 'shipping_custom_field_3', name: 'shipping_custom_field_3'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_4']))
                    { data: 'shipping_custom_field_4', name: 'shipping_custom_field_4'},
                @endif
                @if(!empty($custom_labels['shipping']['custom_field_5']))
                    { data: 'shipping_custom_field_5', name: 'shipping_custom_field_5'},
                @endif
                { data: 'payment_status', name: 'payment_status'},
                { data: 'waiter', name: 'ss.first_name', @if(empty($is_service_staff_enabled)) visible: false @endif }
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#sell_table'));
            },
            createdRow: function( row, data, dataIndex ) {
                $( row ).find('td:eq(4)').attr('class', 'clickable_td');
            }
        });

        $('#pending_shipments_location').change( function(){
            sell_table.ajax.reload();
        });
    });
    <!-- Example initialization for nice-select -->

    $(document).ready(function() {
        $('select').niceSelect();
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

