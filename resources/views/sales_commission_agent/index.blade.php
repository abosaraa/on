@extends('layouts.master')
@section('title', __('lang_v1.sales_commission_agents'))
@section('css')

<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}

@endsection

@section('content')
<div class="col-xl-12">
    <div class="card mg-b-20">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between">
                {{-- <h4 class="card-title mg-b-0">@lang('lang_v1.sales_commission_agents')</h4> --}}
                <i class="mdi mdi-dots-horizontal text-gray"></i>
            </div>
        </div>

        @can('user.create')

      
    

        <div class="card-body">
            <a class="btn  btn-dark text-white btn-small  rounded  btn-modal" 
            data-href="{{ action([\App\Http\Controllers\SalesCommissionAgentController::class, 'create']) }}"
            data-container=".commission_agent_modal">
             @lang( 'messages.add' )</a>
        </div>
        @endcan

        <div class="card-body">
            @can('user.view')
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0 text-md-nowrap display" style="width:100%"
                    id="sales_commission_agent_table">
                    <thead>
                        <tr>
                            <th>@lang('user.name')</th>
                            <th>@lang('business.email')</th>
                            <th>@lang('lang_v1.contact_no')</th>
                            <th>@lang('business.address')</th>
                            <th>@lang('lang_v1.cmmsn_percent')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>
                </table>
            </div>
            @endcan
        </div>
    </div>
</div>

<div class="modal   animated fadeIn commission_agent_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" >
</div>
@endsection

@section('javascript')


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