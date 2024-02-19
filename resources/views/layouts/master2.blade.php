@inject('request', 'Illuminate\Http\Request')

@if($request->segment(1) == 'pos' && ($request->segment(2) == 'create' || $request->segment(3) == 'edit' || $request->segment(2) == 'payment'))
    @php
        $pos_layout = true;
    @endphp
@else
    @php
        $pos_layout = false;
    @endphp
@endif

@php
    $whitelist = ['127.0.0.1', '::1'];
@endphp

<!DOCTYPE html>

<html  lang="{{ app()->getLocale() }}" dir="{{in_array(session()->get('user.language', config('app.locale')), config('constants.langs_rtl')) ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - GPT ERP</title>
  

    @include('layouts.partials.css')
    @yield('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&display=swap');
        * {
            font-family: 'Almarai', sans-serif;
        }

		.card {
			margin-top: 4em!important;
		}
		.main-footer {
			margin-top: 44vh !important;

		}


        span.dtr-data {
    padding: 0px;
    display: flex;
}

    /* .dataTables_scroll {
        display: contents !important;
    } */
.form-inline {
    display: inline !important;

}
.btn-sm {
        min-width: auto; /* تعيين عرض أقصر للأزرار */
    }


/*/* Style the dropdown menu with Flexbox */


/* Style each button in the dropdown */


/* Style the anchor (link) inside each button */


/* Hover effect for the buttons */


/* .select2-container--default .select2-selection--single {
    display: none !important;
} */
.fa-lock:before {
    content: unset !important;
}

/* table.dataTable thead .sorting::after {
    font-family: 'Ionicons';
    font-size: 11px;
    position: absolute;
    line-height: 0;
    left: 10px;
    right: auto !important;
    display: none !important;
} 
table.dataTable thead .sorting_desc::after {
    font-family: 'Ionicons';
    font-size: 11px;
    position: absolute;
    line-height: 0;
    top: 50%;
    left: 10px;
    right: auto !important;
    display: none !important;
} */
.modal-backdrop {
    display: none !important;
}
.hide {
    display: none !important;
}
img.product-thumbnail-small {
    width: 100px !important;
    height: 100px !important;
}
/* 
table.dataTable thead .sorting_asc::after {
    display: none !important;
} */

/* .table-responsive {
    min-height: 100vh !important;
} */
/* table#product_table {
    min-height: 20vh !important;
} */

/* 
.select2-container--default .select2-selection--multiple:before {content: ' ';display: block;position: absolute;border-color: #888 transparent transparent transparent;border-style: solid;border-width: 5px 4px 0 4px;height: 0;right: 6px;margin-left: -4px;margin-top: -2px;top: 50%;width: 0;cursor: pointer} */

/* .select2-selection__placeholder {
    display: none !important;
} */
.app-sidebar {
        overflow-y: auto; /* Enable vertical scrolling */
        max-height: 100vh; /* Set a maximum height to limit the sidebar height */
    }


    table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable td:last-child, table.table-bordered.dataTable td:last-child {
    border-right-width: 1px !important;
}


.custom-close-icon {
  font-size: 20px; /* Adjust the font size as needed */
/* Optional: Add spacing between icon and text */
}
.custom-close-btn {
    background-color: #000000;
    color: #fff;
    border: none;
    padding: 0px 10px;
    border-radius: 5px;
    cursor: pointer;
}
 .pos {
    background: #011530;
    height: 48px;
    width: 115px;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    justify-content: center;
    color: #FFB600;
    font-weight: 400;
    text-transform: uppercase;
}
:is([dir=rtl]) select:not([size]) {
    background-position: left 0.75rem center;
    padding-left: 29px;
    padding-right: 0.75rem;
}
.main-body, .main-dashboard {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    background: white;
    position: relative;
    direction: rtl;
}
    </style>
</head>

<body class="main-body app sidebar-mini">
   

    @if(in_array($_SERVER['REMOTE_ADDR'], $whitelist))
        <input type="hidden" id="__is_localhost" value="true">
    @endif
 
    <div class="main-content app-content">
        {{-- <div id="global-loader">
			<img src="{{URL::asset('/img/flag-lybia.jpg')}}" class="loader-img" alt="Loader" style="width:10%">
     
		</div> --}}
        @if(!$pos_layout)
        @include('layouts.main-sidebar')    
        @include('layouts.main-header')            
    
    @else
        @include('layouts.partials.header-pos')
       {{-- @include('sale_pos.partials.head') --}}

    @endif
        {{-- @include('layouts.main-header')             --}}

        <div class="container-fluid">
            @yield('page-header')
            @yield('content')

            <div id="app">
                @yield('vue')
            </div>

            <input type="hidden" id="__code" value="{{session('currency')['code']}}">
            <input type="hidden" id="__symbol" value="{{session('currency')['symbol']}}">
            <input type="hidden" id="__thousand" value="{{session('currency')['thousand_separator']}}">
            <input type="hidden" id="__decimal" value="{{session('currency')['decimal_separator']}}">
            <input type="hidden" id="__symbol_placement" value="{{session('business.currency_symbol_placement')}}">
            <input type="hidden" id="__precision" value="{{session('business.currency_precision', 2)}}">
            <input type="hidden" id="__quantity_precision" value="{{session('business.quantity_precision', 2)}}">
            
            @can('view_export_buttons')
                <input type="hidden" id="view_export_buttons">
            @endcan

            @if(isMobile())
                <input type="hidden" id="__is_mobile">
            @endif

            @if (session('status'))
                <input type="hidden" id="status_span" data-status="{{ session('status.success') }}" data-msg="{{ session('status.msg') }}">
            @endif
        </div>

        @if(config('constants.iraqi_selling_price_adjustment'))
            <input type="hidden" id="iraqi_selling_price_adjustment">
        @endif

     
   
        <div class="modal  invoice print_section"  id="receipt_section" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
        @include('home.todays_profit_modal')
    
        <!-- /.content-wrapper -->
        @include('layouts.partials.footer_pos')
        @include('layouts.footer-scripts')

        @include('layouts.partials.javascripts')
       
        @if(!empty($__additional_html))
            {!! $__additional_html !!}
        @endif

        <div class="modal  view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>


        @if(!empty($__additional_views) && is_array($__additional_views))
            @foreach($__additional_views as $additional_view)
                @includeIf($additional_view)
            @endforeach
        @endif
    </div>
  
 
</body>
</html>








