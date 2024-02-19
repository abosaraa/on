@extends('layouts.master')
@section('title', __('business.business_settings'))


@section('content')

<!-- Content Header (Page header) -->
{{-- <section class="content-header ">    <h1>@lang('business.business_settings')</h1>
    <br>
    @include('layouts.partials.search_settings')
</section> --}}

<!-- Main content -->
<section class="content mt-4">
    {!! Form::open(['url' => action([\App\Http\Controllers\BusinessController::class, 'postBusinessSettings']), 'method' => 'post', 'id' => 'bussiness_edit_form', 'files' => true]) !!}

        
            <div class="d-md-flex">
                <div class="col-md-4">
                   
                        <div class="tab-menu-heading tabs-style-4">
                         
                                <ul class="nav panel-tabs" style="display: inline-block !important;">
                                    <li class=""><a href="#v-pills-business" class="active" data-toggle="pill"><i class="fa fa-laptop"></i> @lang('business.business')</a></li>
                                    <li><a href="#v-pills-tax" data-toggle="pill"><i class="fa fa-cube"></i> @lang('business.tax') @show_tooltip(__('tooltip.business_tax'))</a></li>
                                    <li><a href="#v-pills-product" data-toggle="pill"><i class="fa fa-cogs"></i> @lang('business.product')</a></li>
                                    <li><a href="#v-pills-contact" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('contact.contact')</a></li>
                                    <li><a href="#v-pills-sale" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('business.sale')</a></li>
                                    <li><a href="#v-pills-pos" data-toggle="pill"><i class="fa fa-tasks"></i>@lang('sale.pos_sale')</a></li>
                                    <li><a href="#v-pills-purchases" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('purchase.purchases')</a></li>
                                    <li><a href="#v-pills-payment" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('lang_v1.payment')</a></li>
                                    <li><a href="#v-pills-dashboard" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('business.dashboard')</a></li>
                                    <li><a href="#v-pills-system" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('business.system')</a></li>
                                    <li><a href="#v-pills-prefixes" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('lang_v1.prefixes')</a></li>
                                    <li><a href="#v-pills-email_settings" data-toggle="pill"><i class="fa fa-tasks"></i>@lang('lang_v1.email_settings')</a></li>
                                    <li><a href="#v-pills-sms_settings" data-toggle="pill"><i class="fa fa-tasks"></i>@lang('lang_v1.sms_settings')</a></li>
                                    <li><a href="#v-pills-reward_point_settings" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('lang_v1.reward_point_settings')</a></li>
                                    <li><a href="#v-pills-modules" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('lang_v1.modules')</a></li>
                                    <li><a href="#v-pills-custom_labels" data-toggle="pill"><i class="fa fa-tasks"></i> @lang('lang_v1.custom_labels')</a></li>
                                </ul>
                            
                        </div>
                    
                </div>
                
                <div class="tabs-style-4 col-md-8">
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="v-pills-business">
                                @include('business.partials.settings_business')
                            </div>
                            <div class="tab-pane" id="v-pills-tax">
                                @include('business.partials.settings_tax')
                            </div>
                            <div class="tab-pane" id="v-pills-product">
                                @include('business.partials.settings_product')
                            </div>
                            <div class="tab-pane" id="v-pills-contact">
                                @include('business.partials.settings_contact')
                            </div>
                            <div class="tab-pane" id="v-pills-sale">
                                @include('business.partials.settings_sales')
                            </div>
                            <div class="tab-pane" id="v-pills-pos">
                                @include('business.partials.settings_pos')
                            </div>
                            <div class="tab-pane" id="v-pills-purchases">
                                @include('business.partials.settings_purchase')
                            </div>
                            <div class="tab-pane" id="v-pills-payment">
                                @include('business.partials.settings_payment')
                            </div>
                            <div class="tab-pane" id="v-pills-dashboard">
                                @include('business.partials.settings_dashboard')
                            </div>
                            <div class="tab-pane" id="v-pills-system">
                                @include('business.partials.settings_system')
                            </div>
                            <div class="tab-pane" id="v-pills-prefixes">
                                @include('business.partials.settings_prefixes')
                            </div>
                            <div class="tab-pane" id="v-pills-email_settings">
                                @include('business.partials.settings_email')
                            </div>
                            <div class="tab-pane" id="v-pills-sms_settings">
                                @include('business.partials.settings_sms')
                            </div>
                            <div class="tab-pane" id="v-pills-reward_point_settings">
                                @include('business.partials.settings_reward_point')
                            </div>
                            <div class="tab-pane" id="v-pills-modules">
                                @include('business.partials.settings_modules')
                            </div>
                            <div class="tab-pane" id="v-pills-custom_labels">
                                @include('business.partials.settings_custom_labels')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
    <div class="row">
        <div class="col-sm-12 text-center">
            <button class="btn btn-danger btn-big" type="submit">@lang('business.update_settings')</button>
        </div>
    </div>
    {!! Form::close() !!}
        
</section>
<!-- /.content -->
@stop
@section('javascript')

<script>
    // Initialization for ES Users
import { Tab, initMDB } from "mdb-ui-kit";

initMDB({ Tab });
</script>
<script type="text/javascript">
    __page_leave_confirmation('#bussiness_edit_form');
    $(document).on('ifToggled', '#use_superadmin_settings', function() {
        if ($('#use_superadmin_settings').is(':checked')) {
            $('#toggle_visibility').addClass('hide');
            $('.test_email_btn').addClass('hide');
        } else {
            $('#toggle_visibility').removeClass('hide');
            $('.test_email_btn').removeClass('hide');
        }
    });

    $(document).ready(function(){

    
        $('#test_email_btn').click( function() {
            var data = {
                mail_driver: $('#mail_driver').val(),
                mail_host: $('#mail_host').val(),
                mail_port: $('#mail_port').val(),
                mail_username: $('#mail_username').val(),
                mail_password: $('#mail_password').val(),
                mail_encryption: $('#mail_encryption').val(),
                mail_from_address: $('#mail_from_address').val(),
                mail_from_name: $('#mail_from_name').val(),
            };
            $.ajax({
                method: 'post',
                data: data,
                url: "{{ action([\App\Http\Controllers\BusinessController::class, 'testEmailConfiguration']) }}",
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        swal({
                            text: result.msg,
                            icon: 'success'
                        });
                    } else {
                        swal({
                            text: result.msg,
                            icon: 'error'
                        });
                    }
                },
            });
        });

        $('#test_sms_btn').click( function() {
            var test_number = $('#test_number').val();
            if (test_number.trim() == '') {
                toastr.error('{{__("lang_v1.test_number_is_required")}}');
                $('#test_number').focus();

                return false;
            }

            var data = {
                url: $('#sms_settings_url').val(),
                send_to_param_name: $('#send_to_param_name').val(),
                msg_param_name: $('#msg_param_name').val(),
                request_method: $('#request_method').val(),
                param_1: $('#sms_settings_param_key1').val(),
                param_2: $('#sms_settings_param_key2').val(),
                param_3: $('#sms_settings_param_key3').val(),
                param_4: $('#sms_settings_param_key4').val(),
                param_5: $('#sms_settings_param_key5').val(),
                param_6: $('#sms_settings_param_key6').val(),
                param_7: $('#sms_settings_param_key7').val(),
                param_8: $('#sms_settings_param_key8').val(),
                param_9: $('#sms_settings_param_key9').val(),
                param_10: $('#sms_settings_param_key10').val(),

                param_val_1: $('#sms_settings_param_val1').val(),
                param_val_2: $('#sms_settings_param_val2').val(),
                param_val_3: $('#sms_settings_param_val3').val(),
                param_val_4: $('#sms_settings_param_val4').val(),
                param_val_5: $('#sms_settings_param_val5').val(),
                param_val_6: $('#sms_settings_param_val6').val(),
                param_val_7: $('#sms_settings_param_val7').val(),
                param_val_8: $('#sms_settings_param_val8').val(),
                param_val_9: $('#sms_settings_param_val9').val(),
                param_val_10: $('#sms_settings_param_val10').val(),
                test_number: test_number
            };

            $.ajax({
                method: 'post',
                data: data,
                url: "{{ action([\App\Http\Controllers\BusinessController::class, 'testSmsConfiguration']) }}",
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        swal({
                            text: result.msg,
                            icon: 'success'
                        });
                    } else {
                        swal({
                            text: result.msg,
                            icon: 'error'
                        });
                    }
                },
            });

        });

        $('select.custom_labels_products').change(function(){
            value = $(this).val();
            textarea = $(this).parents('div.custom_label_product_div').find('div.custom_label_product_dropdown');
            if(value == 'dropdown'){
                textarea.removeClass('hide');
            } else{
                textarea.addClass('hide');
            }
        })
    });
</script>


@endsection