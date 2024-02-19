@extends('layouts.master')
@section('title', __('lang_v1.'.$type.'s'))
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}


<link href="https://cdn.datatables.net/buttons/2.1.2/css/buttons.dataTables.min.css" rel="stylesheet">

<!-- DataTables Buttons JavaScript -->

@endsection
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
                <div class="row mt-5">
                    @if($type == 'customer')
                    <div class="col-md-3">
                        <div class="form-group inline-checkbox">
                            <label>{!! Form::checkbox('has_sell_due', 1, false, ['class' => 'input-icheck ch', 'id' => 'has_sell_due']) !!} <strong>@lang('lang_v1.sell_due')</strong></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group inline-checkbox">
                            <label>{!! Form::checkbox('has_sell_return', 1, false, ['class' => 'input-icheck ch', 'id' => 'has_sell_return']) !!} <strong>@lang('lang_v1.sell_return')</strong></label>
                        </div>
                    </div>
                    @elseif($type == 'supplier')
                    <div class="col-md-3">
                        <div class="form-group inline-checkbox">
                            <label>{!! Form::checkbox('has_purchase_due', 1, false, ['class' => 'input-icheck ch', 'id' => 'has_purchase_due']) !!} <strong>@lang('report.purchase_due')</strong></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group inline-checkbox">
                            <label>{!! Form::checkbox('has_purchase_return', 1, false, ['class' => 'input-icheck ch', 'id' => 'has_purchase_return']) !!} <strong>@lang('lang_v1.purchase_return')</strong></label>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-3">
                        <div class="form-group inline-checkbox">
                            <label>{!! Form::checkbox('has_advance_balance', 1, false, ['class' => 'input-icheck ch', 'id' => 'has_advance_balance']) !!} <strong>@lang('lang_v1.advance_balance')</strong></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group inline-checkbox">
                            <label>{!! Form::checkbox('has_opening_balance', 1, false, ['class' => 'input-icheck ch', 'id' => 'has_opening_balance']) !!} <strong>@lang('lang_v1.opening_balance')</strong></label>
                        </div>
                    </div>
                    @if($type == 'customer')
                    <div class="col-md-3">
                        <div class="form-group inline-select">
                            <label for="has_no_sell_from">@lang('lang_v1.has_no_sell_from'):</label>
                            {!! Form::select('has_no_sell_from', ['one_month' => __('lang_v1.one_month'), 'three_months' => __('lang_v1.three_months'), 'six_months' => __('lang_v1.six_months'), 'one_year' => __('lang_v1.one_year')], null, ['class' => 'form-control ch', 'id' => 'has_no_sell_from', 'placeholder' => __('messages.please_select')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group inline-select">
                            <label for="cg_filter">@lang('lang_v1.customer_group'):</label>
                            {!! Form::select('cg_filter', $customer_groups, null, ['class' => 'form-control ch' , 'id' => 'cg_filter']); !!}
                        </div>
                    </div>
                    @endif
                    {{-- @if(config('constants.enable_contact_assign') === true)
                    <div class="col-md-3">
                        <div class="form-group inline-select">
                            {!! Form::label('assigned_to',  __('lang_v1.assigned_to') . ':') !!}
                            {!! Form::select('assigned_to', $users, null, ['class' => 'form-control  ch', 'style' => 'width:100%']); !!}
                        </div>
                    </div>
                    @endif --}}
                    <div class="col-md-3">
                        <div class="form-group inline-select">
                            <label for="status_filter">@lang('sale.status'):</label>
                            {!! Form::select('status_filter', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control ch', 'id' => 'status_filter', 'placeholder' => __('lang_v1.none')]); !!}
                        </div>
                    </div>
                </div>
                {{-- <button type="button" id="clearButton" class="btn btn-dark">تفريغ الكل </button> --}}
            @endcomponent
        </div>
    </div>
    <input type="hidden" value="{{$type}}" id="contact_type">


    @component('components.widget')
        @if(auth()->user()->can('supplier.create') || auth()->user()->can('customer.create') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
            @slot('tool')
           
                <div class="card-body">
                    <a class="btn  btn-dark text-white btn-small  rounded  btn-modal" 
                    data-href="{{action([\App\Http\Controllers\ContactController::class, 'create'], ['type' => $type])}}" 
                    data-container=".contact_modal">
                     @lang( 'messages.add' )</a>
                </div>
            @endslot
        @endif
        @if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
            <table class="table table-bordered   " id="contact_table" style="width: 100% !important;">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('lang_v1.contact_id')</th>
                        @if($type == 'supplier') 
                            <th>@lang('business.business_name')</th>
                            <th>@lang('contact.name')</th>
                            <th>@lang('business.email')</th>
                            <th>@lang('contact.tax_no')</th>
                            <th>@lang('contact.pay_term')</th>
                            <th>@lang('account.opening_balance')</th>
                            <th>@lang('lang_v1.advance_balance')</th>
                            <th>@lang('lang_v1.added_on')</th>
                            <th>@lang('business.address')</th>
                            <th>@lang('contact.mobile')</th>
                            <th>@lang('contact.total_purchase_due')</th>
                            <th>@lang('lang_v1.total_purchase_return_due')</th>
                        @elseif( $type == 'customer')
                            <th>@lang('business.business_name')</th>
                            <th>@lang('user.name')</th>
                            <th>@lang('business.email')</th>
                            <th>@lang('contact.tax_no')</th>
                            <th>@lang('lang_v1.credit_limit')</th>
                            <th>@lang('contact.pay_term')</th>
                            <th>@lang('account.opening_balance')</th>
                            <th>@lang('lang_v1.advance_balance')</th>
                            <th>@lang('lang_v1.added_on')</th>
                            @if($reward_enabled)
                                <th id="rp_col">{{session('business.rp_name')}}</th>
                            @endif
                            <th>@lang('lang_v1.customer_group')</th>
                            <th>@lang('business.address')</th>
                            <th>@lang('contact.mobile')</th>
                            <th>@lang('contact.total_sale_due')</th>
                            <th>@lang('lang_v1.total_sell_return_due')</th>
                        @endif
                        {{-- @php
                            $custom_labels = json_decode(session('business.custom_labels'), true);
                        @endphp
                        <th>
                            {{ $custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1') }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2') }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3') }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4') }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_5'] ?? __('lang_v1.custom_field', ['number' => 5]) }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_6'] ?? __('lang_v1.custom_field', ['number' => 6]) }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_7'] ?? __('lang_v1.custom_field', ['number' => 7]) }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_8'] ?? __('lang_v1.custom_field', ['number' => 8]) }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_9'] ?? __('lang_v1.custom_field', ['number' => 9]) }}
                        </th>
                        <th>
                            {{ $custom_labels['contact']['custom_field_10'] ?? __('lang_v1.custom_field', ['number' => 10]) }}
                        </th> --}}
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td
                            @if($type == 'supplier')
                                colspan="6"
                            @elseif( $type == 'customer')
                                @if($reward_enabled)
                                    colspan="9"
                                @else
                                    colspan="8"
                                @endif
                            @endif>
                                <strong>
                                    @lang('sale.total'):
                                </strong>
                        </td>
                        <td class="footer_contact_due"></td>
                        <td class="footer_contact_return_due"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        @endif
    @endcomponent

    <div class="modal  contact_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal  pay_contact_due_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
      


</section>

<!-- /.content -->
@stop
@section('javascript')

<script type="text/javascript">
    $(document).on('shown.bs.modal', '.contact_modal', function(e) {
        initAutocomplete();
    });
</script>
 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var selectElements = document.querySelectorAll('.ch');
        
        selectElements.forEach(function (selectElement) {
            var choices = new Choices(selectElement, {
                searchEnabled: false, // Disable search if not needed
                shouldSort: false,    // Disable sorting if not needed
                placeholder: true,
            });
        });

        // Get the clear button element
        var clearButton = document.getElementById('clearButton');

        // Add a click event listener to the clear button
        clearButton.addEventListener('click', function () {
            // Iterate over each Choices.js instance and clear the value
            selectElements.forEach(function (selectElement) {
                // Use Choices.js API to clear the selected value
                var choicesInstance = new Choices(selectElement);
                choicesInstance.clearStore();

                // Reset the input element value
                selectElement.value = '';

                // Trigger the 'change' event to notify other scripts about the change
                var event = new Event('change', { bubbles: true });
                selectElement.dispatchEvent(event);
            });
        });
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
<script src="https://cdn.datatables.net/buttons/2.1.2/js/buttons.print.min.js"></script>



<!-- JSZip -->

<!-- PDFMake -->

<!-- Buttons HTML5 -->

<!-- Buttons Print -->
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
