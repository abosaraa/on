<!-- main-header opened -->

@inject('request', 'Illuminate\Http\Request') 

@php
  $all_notifications = auth()->user()->notifications;
  $unread_notifications = $all_notifications->where('read_at', null);
  $total_unread = count($unread_notifications);
  
use App\Media;
use App\User;
use App\Utils\ModuleUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

$user_id = request()->session()->get('user.id');
        $user = User::where('id', $user_id)->with(['media'])->first();
        $config_languages = config('constants.langs');
        $languages = [];
        foreach ($config_languages as $key => $value) {
            $languages[$key] = $value['full_name'];
        }
@endphp
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						{{-- <div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div> --}}
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						{{-- <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div> --}}

					
					</div>
					
					<div class="main-header-right">

						@if(Module::has('Superadmin'))
						@includeIf('superadmin::layouts.partials.active_subscription')
					  @endif
				
						@if(!empty(session('previous_user_id')) && !empty(session('previous_username')))
							<a href="{{route('sign-in-as-user', session('previous_user_id'))}}" class="btn btn-flat btn-danger m-8 btn-sm mt-10"><i class="fas fa-undo"></i> @lang('lang_v1.back_to_username', ['username' => session('previous_username')] )</a>
						@endif
					

						<!-- Ensure you have included Bootstrap 4 CSS and JavaScript files -->

<!-- Your button with popover -->






						{{-- @if($request->segment(1) == 'pos')
          @can('view_cash_register')
          <button type="button" id="register_details" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-success btn-flat pull-left m-8 btn-sm mt-10 rounded btn-modal" data-container=".register_details_modal" 
          data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails'])}}">
            <strong>{{ __('cash_register.register_details') }}</strong>
          </button>
          @endcan
          @can('close_cash_register')
          <button type="button" id="close_register" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-danger btn-flat pull-left m-8 btn-sm mt-10 rounded btn-modal" data-container=".close_register_modal" 
          data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister'])}}">
            <strong>{{ __('cash_register.close_register') }}</strong>
          </button>
          @endcan
        @endif --}}

						@if(in_array('pos_sale', $enabled_modules))
						@can('sell.create')
						  {{-- <a href="{{action([\App\Http\Controllers\SellPosController::class, 'create'])}}" title="@lang('sale.pos_sale')" data-toggle="tooltip" data-placement="bottom" class="btn btn-flat pull-left m-8 btn-sm mt-10 btn-success">
							<strong><i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')</strong>
						  </a> --}}
						  	
					  <a href="{{ action([\App\Http\Controllers\SellPosController::class, 'create']) }}" title="" data-toggle="tooltip" data-placement="bottom" class="btn btn-dark btn-sm  rounded m-8 mt-10" data-original-title="POS">
				
						<span style="white-space: nowrap; color: #ffffff; font-weight: bold; font-size: 14px;">{{ __('sale.pos_sale') }}</span>
					</a>
						@endcan
					  @endif
					
				
					  {{-- @can('profit_loss_report.view')
					  <button type="button" id="view_todays_profit"  data-toggle="tooltip" data-placement="bottom" class="btn btn-dark   m-8 mt-10 rounded">
						<span style="white-space: nowrap; color: #ffffff; font-weight: bold; font-size: 14px;">{{ __('home.todays_profit') }}</span>
					  </button>
					@endcan --}}

					{{-- <div class="m-8 pull-left mt-15 hidden-xs" style="color: #0c0909;"><strong>{{ @format_date('now') }}</strong></div> --}}

				
						{!! Form::open(['url' => action([\App\Http\Controllers\UserController::class, 'updateProfile']), 'method' => 'post', 'id' => 'edit_user_profile_form', 'files' => true ]) !!}

						<ul class="nav">
					
							<li >
								{!! Form::select('language', $languages, $user->language, ['class' => 'form-control select ', 'id' => 'language_select', 'onchange' => 'submitFormAndChangeFlag(this.value)']) !!}
				
								
							</li>

							
						</ul>
					
					{!! Form::close() !!}
					
					<script>
						function submitFormAndChangeFlag(lang) {
							// Submit the form
							document.getElementById('edit_user_profile_form').submit();
					
							// Change flag based on language selection
							var flagImgSrc = lang === 'ar' ? '{{ URL::asset('assets/img/flag-lybia.jpg') }}' : '{{ URL::asset('assets/img/flags/us_flag.jpg') }}';
							var flagText = lang === 'ar' ? 'Libya' : 'English';
					
							// Update flag image and text
							var flagElement = document.querySelector('.nav-item .country-Flag');
							flagElement.innerHTML = ''; // Clear previous content
							var img = document.createElement('img');
							img.src = flagImgSrc;
							img.alt = flagText;
							flagElement.appendChild(img);
					
							document.querySelector('.nav-item .my-auto strong').textContent = flagText;
						}
					</script>
					
						
						
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								
							</div>

							<div class="dropdown nav-item main-header-notification">
								<a href="#" class="new nav-link load_notifications" data-toggle="dropdown" id="show_unread_notifications" data-loaded="false">
									<i class="fas fa-bell"></i>
									<span class="pulse label label-warning notifications_count">
										@if(!empty($total_unread)){{$total_unread}}@endif
									</span>
								</a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12">
											You have @if(!empty($total_unread)){{$total_unread}}@else 0 @endif unread Notifications
										</p>
									</div>
									<div class="main-notification-list Notification-scroll" id="notifications_list">
										<!-- Loop through notifications and generate list items -->
										@foreach($all_notifications as $notification)
											<a class="d-flex p-3 border-bottom" href="#">
												<div class="notifyimg bg-{{$notification->color}}">
													<i class="{{$notification->icon}} text-white"></i>
												</div>
												<div class="mr-3">
													<h5 class="notification-label mb-1">{{$notification->title}}</h5>
													<div class="notification-subtext">{{$notification->timestamp}}</div>
												</div>
												<div class="mr-auto">
													<i class="las la-angle-left text-left text-muted"></i>
												</div>
											</a>
										@endforeach
									</div>
									@if(count($all_notifications) > 10)
										<div class="dropdown-footer load_more_li">
											<a href="#" class="load_more_notifications">@lang('lang_v1.load_more')</a>
										</div>
									@endif
								</div>
							</div>
							<input type="hidden" id="notification_page" value="1">
							
			
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/11907548.png')}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/11907548.png')}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>  {{ Auth::User()->first_name }}  {{ Auth::User()->last_name }} </h6>
												
												
@if(Auth::user()->hasRole('admin'))
<span>{{ $user->username }}</span>
@endif
									
											</div>
										</div>
									</div>
									{{-- <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
									<a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
									<a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>--}}
									<a class="dropdown-item" href="{{  action([\App\Http\Controllers\SellPosController::class, 'listSubscriptions']) }}"><i class="bx bx-envelope"></i>{{  __('lang_v1.subscriptions')}}</a> 
									<a class="dropdown-item" href="{{action([\App\Http\Controllers\UserController::class, 'getProfile'])}}"><i class="bx bx-slider-alt"></i>@lang('lang_v1.profile')</a>
									<a class="dropdown-item" href="{{ url('/' . $page='logout') }}"><i class="bx bx-log-out"></i>@lang('lang_v1.sign_out')</a>
								</div>
							</div>
				
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->


















