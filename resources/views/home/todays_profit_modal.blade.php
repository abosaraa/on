<div class="modal " id="todays_profit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
          <button type="button" class="btn custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="custom-close-icon">&times;</span>
          </button>
        <h4 class="modal-title" id="myModalLabel">@lang('home.todays_profit')</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="modal_today" value="{{\Carbon::now()->format('Y-m-d')}}">
        <div class="row">
          <div id="todays_profit">
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">@lang('messages.close')</button>
      </div>
    </div>
  </div>
</div>