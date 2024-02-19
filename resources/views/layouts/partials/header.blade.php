{{-- 
<!-- Main Header -->
  <header class="main-header no-print">
    <a href="{{route('home')}}" class="logo">
      
      <span class="logo-lg">{{ Session::get('business.name') }} <i class="fa fa-circle text-success" id="online_indicator"></i></span> 

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        &#9776;
        <span class="sr-only">Toggle navigation</span>
      </a>

    
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">

        @if(Module::has('Essentials'))
          @includeIf('essentials::layouts.partials.header_part')
        @endif

        <div class="btn-group">
          <button id="header_shortcut_dropdown" type="button" class="btn btn-success dropdown-toggle btn-flat pull-left m-8 btn-sm mt-10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-plus-circle fa-lg"></i>
          </button>
          <ul class="dropdown-menu">
            @if(config('app.env') != 'demo')
              <li><a href="{{route('calendar')}}">
                  <i class="fas fa-calendar-alt" aria-hidden="true"></i> @lang('lang_v1.calendar')
              </a></li>
            @endif
            @if(Module::has('Essentials'))
              <li><a href="#" class="btn-modal" data-href="{{action([\Modules\Essentials\Http\Controllers\ToDoController::class, 'create'])}}" data-container="#task_modal">
                  <i class="fas fa-clipboard-check" aria-hidden="true"></i> @lang( 'essentials::lang.add_to_do' )
              </a></li>
            @endif
            <!-- Help Button -->
            @if(auth()->user()->hasRole('Admin#' . auth()->user()->business_id))
              <li><a id="start_tour" href="#">
                  <i class="fas fa-question-circle" aria-hidden="true"></i> @lang('lang_v1.application_tour')
              </a></li>
            @endif
          </ul>
        </div>
        <button id="btnCalculator" title="@lang('lang_v1.calculator')" type="button" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 popover-default hidden-xs" data-toggle="popover" data-trigger="click" data-content='@include("layouts.partials.calculator")' data-html="true" data-placement="bottom">
            <strong><i class="fa fa-calculator fa-lg" aria-hidden="true"></i></strong>
        </button>
        
        @if($request->segment(1) == 'pos')
          @can('view_cash_register')
          <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".register_details_modal" 
          data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails'])}}">
            <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
          </button>
          @endcan
          @can('close_cash_register')
          <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-flat pull-left m-8 btn-sm mt-10 btn-modal" data-container=".close_register_modal" 
          data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister'])}}">
            <strong><i class="fa fa-window-close fa-lg"></i></strong>
          </button>
          @endcan
        @endif

        @if(in_array('pos_sale', $enabled_modules))
          @can('sell.create')
            <a href="{{action([\App\Http\Controllers\SellPosController::class, 'create'])}}" title="@lang('sale.pos_sale')" data-toggle="tooltip" data-placement="bottom" class="btn btn-flat pull-left m-8 btn-sm mt-10 btn-success">
              <strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
            </a>
          @endcan
        @endif

        @if(Module::has('Repair'))
          @includeIf('repair::layouts.partials.header')
        @endif

        @can('profit_loss_report.view')
          <button type="button" id="view_todays_profit" title="{{ __('home.todays_profit') }}" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10">
            <strong><i class="fas fa-money-bill-alt fa-lg"></i></strong>
          </button>
        @endcan

        <div class="m-8 pull-left mt-15 hidden-xs" style="color: #fff;"><strong>{{ @format_date('now') }}</strong></div>

        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @php
                $profile_photo = auth()->user()->media;
              @endphp
              @if(!empty($profile_photo))
                <img src="{{$profile_photo->display_url}}" class="user-image" alt="User Image">
              @endif
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>{{ Auth::User()->first_name }} {{ Auth::User()->last_name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                @if(!empty(Session::get('business.logo')))
                  <img src="{{ asset( 'uploads/business_logos/' . Session::get('business.logo') ) }}" alt="Logo">
                @endif
                <p>
                  {{ Auth::User()->first_name }} {{ Auth::User()->last_name }}
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{action([\App\Http\Controllers\UserController::class, 'getProfile'])}}" class="btn btn-default btn-flat">@lang('lang_v1.profile')</a>
                </div>
                <div class="pull-right">
                  <a href="{{action([\App\Http\Controllers\Auth\LoginController::class, 'logout'])}}" class="btn btn-default btn-flat">@lang('lang_v1.sign_out')</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
{{--   @inject('request', 'Illuminate\Http\Request') --}}
  <!-- Navbar -->

{{--   <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      
      <li class="nav-item">
        <a class="nav-link click-collapse" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    
    </ul>


    <ul class="navbar-nav mx-auto">
      <li class="nav-item dropdown d-none d-sm-block">
        <a class="nav-link" data-toggle="dropdown">
          <div class="money-bar">
          </div>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('web')}}" class="nav-link">
            الموقع التعريفي 
        </a>
    </li>

      <li class="nav-item">
        <div class="theme-switch-wrapper nav-link">
          <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox">
            <span class="slider round"></span>
          </label>
        </div>
      </li>
      <li>
        <div class="btn-group">
          <button type="button" class="click-btn-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Admin
          </button>
          <div class="dropdown-menu menu-box-2">
            <a href="{{action([\App\Http\Controllers\UserController::class, 'getProfile'])}}" class="dropdown-item"><i class="fa fa-user"></i>@lang('lang_v1.profile')</a>
            <a href="{{action([\App\Http\Controllers\Auth\LoginController::class, 'logout'])}}" class="dropdown-item"><i class="fa fa-sign-out-alt"></i>@lang('lang_v1.sign_out')</a>
          </div>
        </div>
      </li>
    </ul>
</nav>
 --}} 











       
{{--  <header id="page-topbar">
  <div class="navbar-header">
      <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box">
              <a href="index.html" class="logo logo-dark">
                  <span class="logo-sm">
                      <img src="assets/images/logo-sm.png" alt="logo-sm" height="22">
                  </span>
                  <span class="logo-lg">
                      <img src="assets/images/logo-dark.png" alt="logo-dark" height="20">
                  </span>
              </a>

              <a href="index.html" class="logo logo-light">
                  <span class="logo-sm">
                      <img src="assets/images/logo-sm.png" alt="logo-sm-light" height="22">
                  </span>
                  <span class="logo-lg">
                      <img src="assets/images/logo-light.png" alt="logo-light" height="20">
                  </span>
              </a>
          </div>

          <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
              <i class="ri-menu-2-line align-middle"></i>
          </button>

          <!-- App Search-->
          <form class="app-search d-none d-lg-block">
              <div class="position-relative">
                  <input type="text" class="form-control" placeholder="Search...">
                  <span class="ri-search-line"></span>
              </div>
          </form>

      </div>

      <div class="d-flex">



 
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                  aria-labelledby="page-header-notifications-dropdown">
                  <div class="p-3">
                      <div class="row align-items-center">
                          <div class="col">
                              <h6 class="m-0"> Notifications </h6>
                          </div>
                          <div class="col-auto">
                              <a href="#!" class="small"> View All</a>
                          </div>
                      </div>
                  </div>
                  <div data-simplebar style="max-height: 230px;">
                      <a href="" class="text-reset notification-item">
                          <div class="d-flex">
                              <div class="avatar-xs me-3">
                                  <span class="avatar-title bg-primary rounded-circle font-size-16">
                                      <i class="ri-shopping-cart-line"></i>
                                  </span>
                              </div>
                              <div class="flex-1">
                                  <h6 class="mb-1">Your order is placed</h6>
                                  <div class="font-size-12 text-muted">
                                      <p class="mb-1">If several languages coalesce the grammar</p>
                                      <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                  </div>
                              </div>
                          </div>
                      </a>
                      <a href="" class="text-reset notification-item">
                          <div class="d-flex">
                              <img src="assets/images/users/avatar-3.jpg"
                                  class="me-3 rounded-circle avatar-xs" alt="user-pic">
                              <div class="flex-1">
                                  <h6 class="mb-1">James Lemire</h6>
                                  <div class="font-size-12 text-muted">
                                      <p class="mb-1">It will seem like simplified English.</p>
                                      <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                  </div>
                              </div>
                          </div>
                      </a>
                      <a href="" class="text-reset notification-item">
                          <div class="d-flex">
                              <div class="avatar-xs me-3">
                                  <span class="avatar-title bg-success rounded-circle font-size-16">
                                      <i class="ri-checkbox-circle-line"></i>
                                  </span>
                              </div>
                              <div class="flex-1">
                                  <h6 class="mb-1">Your item is shipped</h6>
                                  <div class="font-size-12 text-muted">
                                      <p class="mb-1">If several languages coalesce the grammar</p>
                                      <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                  </div>
                              </div>
                          </div>
                      </a>

                      <a href="" class="text-reset notification-item">
                          <div class="d-flex">
                              <img src="assets/images/users/avatar-4.jpg"
                                  class="me-3 rounded-circle avatar-xs" alt="user-pic">
                              <div class="flex-1">
                                  <h6 class="mb-1">Salena Layfield</h6>
                                  <div class="font-size-12 text-muted">
                                      <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                      <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                  </div>
                              </div>
                          </div>
                      </a>
                  </div>
             
              </div>
          </div>

          <div class="dropdown d-inline-block user-dropdown">
              <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg"
                      alt="Header Avatar">
                  <span class="d-none d-xl-inline-block ms-1">Julia</span>
                  <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                  <!-- item-->
                  <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                  <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                  <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                  <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="#"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
              </div>
          </div>

          <div class="dropdown d-inline-block">
              <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                  <i class="ri-settings-2-line"></i>
              </button>
          </div>

      </div>
 
</header>
 --}}