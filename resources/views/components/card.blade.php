

<div class="card {{$class ?? ''}}" @if(!empty($id)) id="{{$id}}" @endif>
    <div class="card-header pb-0">
        {{-- <h5 class="card-title mb-0 pb-0">
            {{ $title ?? '' }}
        </h5> --}}
        
    </div>

    <div class="ml-auto">
        {!! $tool ?? '' !!}
    </div>

    <div class="card-body">
        {{$slot}}

    </div>

</div>

