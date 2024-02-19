<div class="card @if(!empty($class)) {{$class}} @else card-solid @endif" id="accordion">
  <div class="card-header with-border" style="cursor: pointer;">
    <h3 class="card-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
        @if(!empty($icon)) {!! $icon !!} @else <i class="fa fa-filter" aria-hidden="true"></i> @endif {{$title ?? ''}}
      </a>
    </h3>
  </div>
  @php
    if(isMobile()) {
      $closed = true;
    }
  @endphp
  <div id="collapseFilter" class="panel-collapse active collapse @if(empty($closed)) in @endif" aria-expanded="true">
    <div class="card-body">
      {{$slot}}
    </div>
  </div>
</div>