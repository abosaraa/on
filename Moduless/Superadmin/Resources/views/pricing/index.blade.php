{{-- @extends('layouts.auth')
@section('title', __('superadmin::lang.pricing'))

@section('content')

<div class="container">
    @include('superadmin::layouts.partials.currency')
    @include('layouts.partials.logo')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-center">@lang('superadmin::lang.packages')</h3>
            </div>

            <div class="card-body">
                @include('superadmin::subscription.partials.packages', ['action_type' => 'register'])
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('pricing') }}?lang=" + $(this).val();
        });
    })
</script>
@endsection --}}


@extends('layouts.master')
@section('title', __('superadmin::lang.pricing'))

@section('content')

<div class="card-body">
    @include('superadmin::subscription.partials.packages', ['action_type' => 'register'])
</div>    


@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_lang').change( function(){
            window.location = "{{ route('pricing') }}?lang=" + $(this).val();
        });
    })
</script>
@endsection
@endsection