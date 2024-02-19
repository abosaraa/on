<!-- main-sidebar -->

@php


use App\Utils\ModuleUtil;
use Illuminate\Routing\Controller;

               $enabled_modules = ! empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];

$common_settings = ! empty(session('business.common_settings')) ? session('business.common_settings') : [];
$pos_settings = ! empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];

$is_admin = auth()->user()->hasRole('Admin#'.session('business.id')) ? true : false;

$business_id = session()->get('user.business_id');

$module_util = new ModuleUtil();

$is_inventorymanagement_enabled = (boolean)$module_util->hasThePermissionInSubscription($business_id, 'inventorymanagement_module');


        $is_accounting_enabled = (bool) $module_util->hasThePermissionInSubscription($business_id, 'accounting_module');

        // $is_admin = $commonUtil->is_admin(auth()->user(), $business_id);
@endphp

<!-- Now you can use these variables in your Blade template as needed -->

		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">

			<div class="main-sidemenu ">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/11907548.png')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::User()->first_name }}  {{ Auth::User()->last_name }}</h4>
							<span class="mb-0 text-muted"> 

								{{ Session::get('business.name') }}



							</span>
						</div>
					</div>
				</div>
			





				<ul class="side-menu">
					{{-- <li class="side-item side-item-category">الرئيسية</li> --}}
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/' . $page='home') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">{{ __('home.home')}}</span><span class="badge badge-success side-badge"></span></a>
					</li>
	<!-- User management dropdown -->
@if (auth()->user()->can('user.view') || auth()->user()->can('user.create') || auth()->user()->can('roles.view')  || (auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own')))
					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/></svg><span class="side-menu__label">    {{ __('user.user_management') }} </span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li>  @can('user.view')
								<a class="slide-item" href="{{ action([\App\Http\Controllers\ManageUserController::class, 'index']) }}">
									{{ __('user.users') }}
								</a>
							@endcan</li>

							<li>  @can('roles.view')
								<a class="slide-item" href="{{ action([\App\Http\Controllers\RoleController::class, 'index']) }}">
									{{ __('user.roles') }}
								</a>
							@endcan</li>
							<li>       
          
								@can('user.create')
									<a class="slide-item" href="{{ action([\App\Http\Controllers\SalesCommissionAgentController::class, 'index']) }}">
										{{ __('lang_v1.sales_commission_agents') }}
									</a>
								@endcan</li>



								
 {{-- 
					@if (auth()->user()->can('supplier.view') || auth()->user()->can('supplier.view_own'))
					<li><a class="slide-item" href="{{ action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'supplier']) }}">{{__('report.supplier')}}
						['icon' => 'fa fas fa-star', 'active' => request()->input('type') == 'supplier']
					</a></li>
				@endif --}}
				@if (auth()->user()->can('supplier.view') || auth()->user()->can('supplier.view_own'))
    <li>
        <a class="slide-item" href="{{ action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'supplier']) }}"
           {!! request()->input('type') == 'supplier' ? 'class="active"' : '' !!}>
		   {{ __('report.supplier') }}
        </a>
    </li>
@endif

				@if (auth()->user()->can('customer.view') || auth()->user()->can('customer.view_own'))
					<li><a class="slide-item" href="{{ action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => 'customer']) }}">{{__('report.customer')}}</a></li>
			{{-- 		<li><a class="slide-item" href="{{ action([\App\Http\Controllers\CustomerGroupController::class, 'index']) }}">المجموعات العملاء</a></li> --}}
				@endif
				
				@if (auth()->user()->can('supplier.create') || auth()->user()->can('customer.create'))
					<li><a class="slide-item" href="{{ action([\App\Http\Controllers\ContactController::class, 'getImportContacts']) }}">{{__('lang_v1.import_contacts') }} </a></li>
				@endif
				
						{{-- 	<li><a class="slide-item" href="{{ url('/' . $page='contacts?type=supplier') }}">الموردين</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='contacts?type=customer') }}">العملاء</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='contacts/import') }}">استيراد جهات الاتصال</a></li> --}}
						</ul>
					</li>

					@endif







					@if (auth()->user()->can('product.view') || auth()->user()->can('product.create') ||
					auth()->user()->can('brand.view') || auth()->user()->can('unit.view') ||
					auth()->user()->can('category.view') || auth()->user()->can('brand.create') ||
					auth()->user()->can('unit.create') || auth()->user()->can('category.create'))

					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg><span class="side-menu__label">{{ __('sale.products')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">

							<li>
								@can('product.view')
								<a class="slide-item" href="{{ action([\App\Http\Controllers\ProductController::class, 'index']) }}"> {{ __('lang_v1.list_products')}}</a>
								@endcan
							</li>


							<li>							
							@can('product.create')
							<a class="slide-item" href="{{  action([\App\Http\Controllers\ProductController::class, 'create']) }}"> {{__('product.add_product')}}</a>
							@endcan					
							</li>




							<li>
							
							
								@can('product.view')
								<a class="slide-item" href="{{  action([\App\Http\Controllers\LabelsController::class, 'show']) }}"> {{   __('barcode.print_labels')}}</a>
								@endcan
							</li>
							
							</li>


							<li>
								
								@can('product.create')
								<a class="slide-item" href="{{   action([\App\Http\Controllers\VariationTemplateController::class, 'index']) }}"> {{   __('product.variations')}}</a>
								@endcan
							</li>


							<li>
								
								@can('product.create')
								<a class="slide-item" href="{{     action([\App\Http\Controllers\ImportProductsController::class, 'index']) }}"> {{    __('product.import_products')}}</a>
								@endcan
						
						</li>




							<li>

								@can('product.opening_stock')
								<a class="slide-item" href="{{     action([\App\Http\Controllers\ImportOpeningStockController::class, 'index']) }}"> {{   __('lang_v1.import_opening_stock')}}</a>
								@endcan
						
						
						</li>

							<li>
								
								@can('product.create')
								<a class="slide-item" href="{{    action([\App\Http\Controllers\SellingPriceGroupController::class, 'index']) }}"> {{    __('lang_v1.selling_price_group')}}</a>
								@endcan
						</li>

							<li>	
								@if (auth()->user()->can('unit.view') || auth()->user()->can('unit.create'))
								
								<a class="slide-item" href="{{     action([\App\Http\Controllers\UnitController::class, 'index']) }}"> {{     __('unit.units')}}</a>
								@endif
							</li>

							<li>
								
								@if (auth()->user()->can('category.view') || auth()->user()->can('category.create'))
								<a class="slide-item" href="{{     action([\App\Http\Controllers\TaxonomyController::class, 'index']).'?type=product' }}"> {{__('category.categories')}}</a>
								@endif
							
							
							
							</li>

							<li>
								@if (auth()->user()->can('brand.view') || auth()->user()->can('brand.create'))
								<a class="slide-item" href="{{    action([\App\Http\Controllers\BrandController::class, 'index']) }}"> {{ __('brand.brands')}}  </a>
							
							   @endif
							
							
							</li>




							<li>
								
								<a class="slide-item" href="{{  action([\App\Http\Controllers\WarrantyController::class, 'index']) }}">{{  __('lang_v1.warranties')}} </a>
							
							
							
							
							
							
							
							
							
							</li>
			


						




						</ul>
					</li>
		
@endif

@if (in_array('purchases', $enabled_modules) && (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') || auth()->user()->can('purchase.update')))
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12c0 4.08 3.06 7.44 7 7.93V4.07C7.05 4.56 4 7.92 4 12z" opacity=".3"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H13v-.93zM13 7h5.24c.25.31.48.65.68 1H13V7zm0 3h6.74c.08.33.15.66.19 1H13v-1zm0 9.93V19h2.87c-.87.48-1.84.8-2.87.93zM18.24 17H13v-1h5.92c-.2.35-.43.69-.68 1zm1.5-3H13v-1h6.93c-.04.34-.11.67-.19 1z"/></svg><span class="side-menu__label">{{ __('purchase.purchases')}}</span><i class="angle fe fe-chevron-down"></i></a>
						
						<ul class="slide-menu">



							<li>
								@if (! empty($common_settings['enable_purchase_requisition']) && (auth()->user()->can('purchase_requisition.view_all') || auth()->user()->can('purchase_requisition.view_own'))) 
								
								
								<a class="slide-item" href="{{   action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']) }}">{{  __('lang_v1.purchase_requisition')}} </a>
							
							@endif
							</li>


							<li>
								@if (! empty($common_settings['enable_purchase_order']) && (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')))
								
								<a class="slide-item" href="{{ action([\App\Http\Controllers\PurchaseOrderController::class, 'index']) }}">
								{{ __('lang_v1.purchase_order')}} </a>
							
							
							@endif
							</li>

							<li>
							@if (auth()->user()->can('purchase.view') || auth()->user()->can('view_own_purchase'))	
								<a class="slide-item" href="{{  action([\App\Http\Controllers\PurchaseController::class, 'index']) }}"> {{  __('purchase.list_purchase')}}							</a>
							@endif
							</li>

							<li>
								@if (auth()->user()->can('purchase.create'))
								<a class="slide-item" href="{{ action([\App\Http\Controllers\PurchaseController::class, 'create']) }}">{{ __('purchase.add_purchase')}} 							</a>
							@endif
							</li>

							<li>
								@if (auth()->user()->can('purchase.update'))
								<a class="slide-item" href="{{   action([\App\Http\Controllers\PurchaseReturnController::class, 'index']) }}"> {{  __('lang_v1.list_purchase_return')}}							</a>
							@endif
							</li>

					
						</ul>
					</li>

@endif




{{-- 
@if ($is_admin || auth()->user()->hasAnyPermission(['sell.view', 'sell.create', 'direct_sell.access', 'view_own_sell_only', 'view_commission_agent_sell', 'access_shipping', 'access_own_shipping', 'access_commission_agent_shipping', 'access_sell_return', 'direct_sell.view', 'direct_sell.update', 'access_own_sell_return'])) 

					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg><span class="side-menu__label">{{  __('sale.sale')}}</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='sells') }}">قائمه المبيعات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='sells/create') }}">البيع العادي</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='pos') }}">قائمة نقطة البيع</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='/pos/create') }}">نقطة البيع</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='sells/quotations') }}">عروض أسعار</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='sell-return') }}">مرتجع المبيعات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='shipments') }}">الشحنات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='sells/create?status=quotation') }}">اضافه فاتوره مرجعية</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='discount') }}">خصومات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='import-sales') }}">استيراد مبيعات</a></li>


							

			
						</ul>
					</li>


@endif --}}

@if ($is_admin || auth()->user()->hasAnyPermission(['sell.view', 'sell.create', 'direct_sell.access', 'view_own_sell_only', 'view_commission_agent_sell', 'access_shipping', 'access_own_shipping', 'access_commission_agent_shipping', 'access_sell_return', 'direct_sell.view', 'direct_sell.update', 'access_own_sell_return'])) 
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/>
                <path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/>
            </svg>
            <span class="side-menu__label">{{ __('sale.sale')}}</span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ url('/' . $page='sells') }}">{{ __('lang_v1.all_sales') }}</a></li>
            <li><a class="slide-item" href="{{ url('/' . $page='sells/create') }}">{{ __('sale.add_sale') }}</a></li>
            <li><a class="slide-item" href="{{ url('/' . $page='pos') }}">{{ __('sale.list_pos') }}</a></li>
            <li><a class="slide-item"    href="{{action([\App\Http\Controllers\SellPosController::class, 'create'])}}">{{ __('sale.pos_sale') }}</a></li>


			@if (in_array('add_sale', $enabled_modules) && ($is_admin || auth()->user()->hasAnyPermission(['quotation.view_all', 'quotation.view_own']))) 
            <li><a class="slide-item" href="{{ url('/' . $page='sells/create?status=quotation') }}">{{ __('lang_v1.add_quotation') }}</a></li>
			
				<li><a class="slide-item"    href="{{action([\App\Http\Controllers\SellController::class, 'getQuotations'])}}">{{ __('lang_v1.list_quotations')}}</a></li>
			
			
			@endif

            <li><a class="slide-item" href="{{ url('/' . $page='sell-return') }}">{{ __('lang_v1.list_sell_return') }}</a></li>
            <li><a class="slide-item" href="{{ url('/' . $page='shipments') }}">{{ __('lang_v1.shipments') }}</a></li>
            <li><a class="slide-item" href="{{ url('/' . $page='discount') }}">{{ __('lang_v1.discounts') }}</a></li>
            <li><a class="slide-item" href="{{ url('/' . $page='import-sales') }}">{{ __('lang_v1.import_sales') }}</a></li>
        </ul>
    </li>
@endif





@if (in_array('expenses', $enabled_modules) && (auth()->user()->can('all_expense.access') || auth()->user()->can('view_own_expense')))
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 4c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 10 6.5 10s1.5.67 1.5 1.5S7.33 13 6.5 13zm3-4C8.67 9 8 8.33 8 7.5S8.67 6 9.5 6s1.5.67 1.5 1.5S10.33 9 9.5 9zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 6 14.5 6s1.5.67 1.5 1.5S15.33 9 14.5 9zm4.5 2.5c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5.67-1.5 1.5-1.5 1.5.67 1.5 1.5z" opacity=".3"/>
                <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z"/>
                <circle cx="6.5" cy="11.5" r="1.5"/>
                <circle cx="9.5" cy="7.5" r="1.5"/>
                <circle cx="14.5" cy="7.5" r="1.5"/>
                <circle cx="17.5" cy="11.5" r="1.5"/>
            </svg>
            <span class="side-menu__label"> {{ __('expense.expenses')}}</span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            <li><a class="slide-item" href="{{ url('/' . $page='expenses') }}">{{__('lang_v1.list_expenses')}}</a></li>
            @can('expense.add')
                <li><a class="slide-item" href="{{ url('/' . $page='expenses/create') }}">{{ __('expense.add_expense')}} </a></li>
            @endcan
            @can('expense.add', 'expense.edit')
                <li><a class="slide-item" href="{{ url('/' . $page='expense-categories') }}"> {{__('expense.expense_categories')}}</a></li>
            @endcan
        </ul>
    </li>
@endif














					@if (
						(in_array('stock_transfers', $enabled_modules) && (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create'))) ||
						(in_array('stock_adjustment', $enabled_modules) && (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create')))
					)
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
								<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
									<path d="M0 0h24v24H0z" fill="none"/>
									<path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
									<path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
								</svg>
								<span class="side-menu__label">{{ __('lang_v1.inventory')}}</span>
								<i class="angle fe fe-chevron-down"></i>
							</a>
    <ul class="slide-menu">
        @can('purchase.view', 'purchase.create')
            <li><a class="slide-item" href="{{ url('/stock-adjustments') }}">{{ __('stock_adjustment.list')}} </a></li>
            {{-- <li><a class="slide-item" href="{{ url('/stock-adjustments/create') }}"> {{  __('stock_adjustment.add')}}</a></li> --}}
            <li><a class="slide-item" href="{{ url('/stock-transfers') }}"> {{ __('lang_v1.list_stock_transfers')}}</a></li>
            {{-- <li><a class="slide-item" href="{{ url('/stock-transfers/create') }}">{{__('lang_v1.add_stock_transfer')}} </a></li> --}}
            {{-- <li><a class="slide-item" href="{{ url('/products#product_stock_report') }}">{{__('lang_v1.Log INventory')}}</a></li> --}}
        @endcan
        @can('business_settings.access')
            <li><a class="slide-item" href="{{ action([\App\Http\Controllers\BusinessLocationController::class, 'index']) }}">{{__('business.business_locations')}} </a></li>
        @endcan
        @if((auth()->user()->can('superadmin') || auth()->user()->can('inventorymanagement.view')) && $is_inventorymanagement_enabled)
            <li><a class="slide-item" href="{{ url('/inventorymanagement') }}">{{ __('inventorymanagement::inventory.create_new_inventory') }}</a></li>
            <li><a class="slide-item" href="{{ url('/inventorymanagement/showInventoryList') }}">{{ __('inventorymanagement::inventory.stock_inventory') }}</a></li>
        @endif
    </ul>

						</li>
					@endif
					












@if (
    auth()->user()->can('purchase_n_sell_report.view') ||
    auth()->user()->can('contacts_report.view') ||
    auth()->user()->can('stock_report.view') ||
    auth()->user()->can('tax_report.view') ||
    auth()->user()->can('trending_product_report.view') ||
    auth()->user()->can('sales_representative.view') ||
    auth()->user()->can('register_report.view') ||
    auth()->user()->can('expense_report.view')
)
    <li class="slide">
        <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
            </svg>
            <span class="side-menu__label">{{__('report.reports')}} </span>
            <i class="angle fe fe-chevron-down"></i>
        </a>
        <ul class="slide-menu">
            @can('profit_loss_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getProfitLoss']) }}">{{ __('report.profit_loss')}}  </a></li>
            @endcan

            @if (config('constants.show_report_606') == true)
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'purchaseReport']) }}"> {{ 'Report 606 ('.__('lang_v1.purchase').')'}}</a></li>
            @endif

            @if (config('constants.show_report_607') == true)
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'saleReport']) }}">{{ 'Report 607 ('.__('business.sale').')'}} </a></li>
            @endif

            @can('purchase_n_sell_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getPurchaseSell']) }}">{{ __('report.purchase_sell_report')}}  </a></li>
            @endcan

            @can('tax_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getTaxReport']) }}">{{__('report.tax_report')}} </a></li>
            @endcan

            @can('contacts_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getCustomerSuppliers']) }}">{{__('report.contacts')}}  </a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getCustomerGroup']) }}">{{ __('lang_v1.customer_groups_report')}}  </a></li>
            @endcan

            @can('stock_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getStockReport']) }}">{{ __('report.stock_report')}} </a></li>
                @if (session('business.enable_product_expiry') == 1)
                    <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getStockExpiryReport']) }}">{{   __('report.stock_expiry_report')}}   </a></li>
                @endif
                @if (session('business.enable_lot_number') == 1)
                    <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getLotReport']) }}">{{ __('lang_v1.lot_report')}}  </a></li>
                @endif
                @if (in_array('stock_adjustment', $enabled_modules))
                    <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getStockAdjustmentReport']) }}">{{ __('report.stock_adjustment_report')}}  </a></li>
                @endif
            @endcan

            @can('trending_product_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getTrendingProducts']) }}">{{__('report.trending_products')}}  </a></li>
            @endcan

            @can('purchase_n_sell_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'itemsReport']) }}">{{__('lang_v1.items_report')}} </a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getproductPurchaseReport']) }}">{{ __('lang_v1.product_purchase_report')}}  </a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getproductSellReport']) }}">{{ __('lang_v1.product_sell_report')}}  </a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'purchasePaymentReport']) }}">{{ __('lang_v1.purchase_payment_report')}}  </a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'sellPaymentReport']) }}">{{  __('lang_v1.sell_payment_report')}}  </a></li>
            @endcan

            @if (in_array('expenses', $enabled_modules) && auth()->user()->can('expense_report.view'))
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getExpenseReport']) }}"> {{__('report.expense_report')}}</a></li>
            @endif

            @can('register_report.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getRegisterReport']) }}"> {{  __('report.register_report')}}</a></li>
            @endcan

            @can('sales_representative.view')
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getSalesRepresentativeReport']) }}">{{__('report.sales_representative')}} </a></li>
            @endcan

            @if (in_array('tables', $enabled_modules) && auth()->user()->can('purchase_n_sell_report.view'))
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getTableReport']) }}">{{__('restaurant.table_report')}}</a></li>
            @endif

            @if (auth()->user()->can('tax_report.view') && !empty(config('constants.enable_gst_report_india')))
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'gstSalesReport']) }}"> {{__('lang_v1.gst_sales_report')}}</a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'gstPurchaseReport']) }}">  {{__('lang_v1.gst_purchase_report')}}  </a></li>
            @endif

            @if (auth()->user()->can('sales_representative.view') && in_array('service_staff', $enabled_modules))
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'getServiceStaffReport']) }}">  {{__('restaurant.service_staff_report')}}</a></li>
            @endif

            @if ($is_admin)
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\ReportController::class, 'activityLog']) }}"> {{ __('lang_v1.activity_log')}}</a></li>
            @endif
        </ul>
    </li>
@endif













@if (auth()->user()->can('accounting.access_accounting_module') && $is_accounting_enabled)

    @if (auth()->user()->can('account.access') && in_array('account', $enabled_modules))

        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/>
                    <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/>
                </svg>
                <span class="side-menu__label">{{ __('lang_v1.payment_accounts') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\AccountController::class, 'index']) }}">{{ __('account.list_accounts') }}</a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\AccountReportsController::class, 'balanceSheet']) }}">{{ __('account.balance_sheet') }}</a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\AccountReportsController::class, 'trialBalance']) }}">{{ __('account.trial_balance') }}</a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\AccountController::class, 'cashFlow']) }}">{{ __('lang_v1.cash_flow') }}</a></li>
                <li><a class="slide-item" href="{{ action([\App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']) }}">{{ __('account.payment_account_report') }}</a></li>
                <li><a class="slide-item" href="{{ action([\Modules\Accounting\Http\Controllers\AccountingController::class, 'dashboard']) }}">{{ __('accounting::lang.accounting') }}</a></li>
            </ul>
        </li>

    @endif

@endif




@if (in_array('tables', $enabled_modules) && auth()->user()->can('access_tables'))
					
				 	<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/></svg><span class="side-menu__label">{{  __('restaurant.tables')}}</span><i class="angle fe fe-chevron-down"></i></a>  
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{  action([\App\Http\Controllers\Restaurant\TableController::class, 'index']) }}">{{-- {{    __('lang_v1.types_of_service')}} --}} الطاولات</a></li>
						</ul>
					</li> 

@endif




@if (in_array('modifiers', $enabled_modules) && (auth()->user()->can('product.view') || auth()->user()->can('product.create')))
					
				 	<li class="slide">
						
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/></svg><span class="side-menu__label">{{  __('restaurant.modifiers')}}</span><i class="angle fe fe-chevron-down"></i></a>  
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{   action([\App\Http\Controllers\Restaurant\ModifierSetsController::class, 'index']) }}">{{-- {{    __('lang_v1.types_of_service')}} --}} الاضافات</a></li>
						</ul>
					</li> 

@endif

@if (in_array('types_of_service', $enabled_modules) && auth()->user()->can('access_types_of_service'))
					
				 	<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15 11V4H4v8.17l.59-.58.58-.59H6z" opacity=".3"/><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-5 7c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10zM4.59 11.59l-.59.58V4h11v7H5.17l-.58.59z"/></svg><span class="side-menu__label">{{    __('lang_v1.types_of_service')}}</span><i class="angle fe fe-chevron-down"></i></a>  
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{    action([\App\Http\Controllers\TypesOfServiceController::class, 'index']) }}">{{-- {{    __('lang_v1.types_of_service')}} --}} الخدمة</a></li>
						</ul>
					</li> 

@endif





					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h15v3H5zm12 5h3v9h-3zm-7 0h5v9h-5zm-5 0h3v9H5z" opacity=".3"/><path d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM8 19H5v-9h3v9zm7 0h-5v-9h5v9zm5 0h-3v-9h3v9zm0-11H5V5h15v3z"/></svg><span class="side-menu__label">{{  __('lang_v1.setting')}}</span><i class="angle fe fe-chevron-down"></i></a>
						
						<ul class="slide-menu">
							@if (auth()->user()->can('manage_modules'))
							<li><a class="slide-item" href="{{ url('/' . $page='manage-modules') }}">{{__('lang_v1.modules')}}</a></li>
							@endif
							@if (auth()->user()->can('backup'))
							<li><a class="slide-item" href="{{ action([\App\Http\Controllers\BackUpController::class, 'index']) }}">{{__('lang_v1.backup')}} </a></li>
							@endif

							@if (auth()->user()->can('send_notifications'))
							<li><a class="slide-item" href="{{action([\App\Http\Controllers\NotificationTemplateController::class, 'index']) }}">{{__('lang_v1.notification_templates')}} </a></li>
							@endif

							@if (in_array('booking', $enabled_modules) && (auth()->user()->can('crud_all_bookings') || auth()->user()->can('crud_own_bookings')))
							<li><a class="slide-item" href="{{action([\App\Http\Controllers\Restaurant\BookingController::class, 'index']) }}">{{ __('restaurant.bookings')}} </a></li>
							@endif

							@if (in_array('kitchen', $enabled_modules))
							<li><a class="slide-item" href="{{action([\App\Http\Controllers\Restaurant\KitchenController::class, 'index']) }}">{{  __('restaurant.kitchen')}} </a></li>
							@endif

							@if (in_array('service_staff', $enabled_modules))
							<li><a class="slide-item" href="{{action([\App\Http\Controllers\Restaurant\OrderController::class, 'index']) }}">{{  __('restaurant.orders')}} </a></li>
							@endif

@if (auth()->user()->can('business_settings.access') ||
auth()->user()->can('barcode_settings.access') ||
auth()->user()->can('invoice_settings.access') ||
auth()->user()->can('tax_rate.view') ||
auth()->user()->can('tax_rate.create') ||
auth()->user()->can('access_package_subscriptions'))
							<li><a class="slide-item" href="{{ action([\App\Http\Controllers\InvoiceSchemeController::class, 'index']) }}"> {{__('invoice.invoice_settings')}}  </a></li>


							<li><a class="slide-item" href="{{action([\App\Http\Controllers\BarcodeController::class, 'index']) }}">{{ __('barcode.barcode_settings')}} </a></li>
							<li><a class="slide-item" href="{{  action([\App\Http\Controllers\TaxRateController::class, 'index'])}}">{{ __('tax_rate.tax_rates')}} </a></li>
							@if (in_array('subscription', $enabled_modules) && auth()->user()->can('direct_sell.access'))
							<li><a class="slide-item" href="{{  action([\App\Http\Controllers\SellPosController::class, 'listSubscriptions']) }}"> {{  __('lang_v1.subscriptions')}} </a></li>
						@endif

							<li><a class="slide-item" href="{{  action([\App\Http\Controllers\PrinterController::class, 'index']) }}">
								               {{  __('printer.receipt_printers')}}</a></li>
												 <li><a class="slide-item" href="{{   action([\App\Http\Controllers\BusinessController::class, 'getBusinessSettings'])}}"> 
													 {{ __('business.business_settings')}} </a></li>
												
@endif
												 
						</ul>
					</li>
	
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
