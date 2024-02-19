<div class="card {{$class ?? ''}}" @if(!empty($id)) id="{{$id}}" @endif>
    <div class="card-header pb-0">
        @if(empty($header))
            @if(!empty($title) || !empty($tool))
                {!! $icon ?? '' !!}
                <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
                <div class="card-tools">
                 
                </div>
                @if(isset($help_text))
                    <br/>
                    <small>{!! $help_text !!}</small>
                @endif
            @endif
            <div class="ml-auto">
                {!! $tool ?? '' !!}
            </div>
        @else
            {!! $header !!}
        @endif
    </div>

    <div class="card-body">
        <div id="collapseContent">
            {{ $slot }}
       
        
        </div>
    </div>

    
</div>


