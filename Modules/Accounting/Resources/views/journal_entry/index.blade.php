@extends('layouts.master')

@section('title', __('accounting::lang.journal_entry'))
@section('css')

<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
{{-- <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet"> --}}
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
{{-- <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"> --}}

@endsection
@section('content')

@include('accounting::layouts.nav')

<!-- Content Header (Page header) -->
{{-- <section class="content-header">
    <h1>@lang( 'accounting::lang.journal_entry' )</h1>
</section> --}}
<section class="content no-print">
<div class="row">
        <div class="col-md-12">
            @component('components.filters', ['title' => __('report.filters')])
                <div class="col-md-4 mt-5">
                    <div class="form-group">
                        {!! Form::label('journal_entry_date_range_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('journal_entry_date_range_filter', null, 
                            ['placeholder' => __('lang_v1.select_a_date_range'), 
                            'class' => 'form-control', 'readonly']); !!}
                    </div>
                </div>
            @endcomponent
        </div>
    </div>
	@component('components.widget', ['class' => 'box-solid'])
        @can('accounting.add_journal')
            @slot('tool')
                <div class="card-body">
                    <a class="btn btn-default btn-dark rounded" 
                        href="{{action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'create'])}}">
                        @lang( 'messages.add' )</a>
                </div>
            @endslot
        @endcan
        
        <table class="table table-bordered table-hover " id="journal_table" style="width: 100%!important;">
            <thead class="bg-green">
                <tr>
                    <th>@lang('messages.action')</th>
                    <th>@lang('accounting::lang.journal_date')</th>
                    <th>@lang('purchase.ref_no')</th>
                    <th>@lang('lang_v1.added_by')</th>
                    <th>@lang('lang_v1.additional_notes')</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        
    @endcomponent
</section>

@stop

@section('javascript')
<script type="text/javascript">

    $(document).ready( function(){
        
        //Journal table
        journal_table = $('#journal_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/accounting/journal-entry',
                data: function(d) {
                    var start = '';
                    var end = '';
                    if ($('#journal_entry_date_range_filter').val()) {
                        start = $('input#journal_entry_date_range_filter')
                            .data('daterangepicker')
                            .startDate.format('YYYY-MM-DD');
                        end = $('input#journal_entry_date_range_filter')
                            .data('daterangepicker')
                            .endDate.format('YYYY-MM-DD');
                    }
                    d.start_date = start;
                    d.end_date = end;
                },
            },
            aaSorting: [[1, 'desc']],
            columns: [
                { data: 'action', name: 'action', orderable: false, searchable: false },
                { data: 'operation_date', name: 'operation_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'added_by', name: 'added_by' },
                { data: 'note', name: 'note' }
            ]
        });

        $('#journal_entry_date_range_filter').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#journal_entry_date_range_filter').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                journal_table.ajax.reload();
            }
        );
        $('#journal_entry_date_range_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#journal_entry_date_range_filter').val('');
            journal_table.ajax.reload();
        });

        //Delete Sale
        $(document).on('click', '.delete_journal_button', function(e) {
            e.preventDefault();
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    var href = $(this).data('href');
                    $.ajax({
                        method: 'DELETE',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                journal_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
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
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>


@endsection