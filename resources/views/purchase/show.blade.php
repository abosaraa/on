<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    @include('purchase.partials.show_details')
    <div class="modal-footer">
      <button type="button" class="btn btn-primary no-print" aria-label="Print" 
      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> @lang( 'messages.print' )
      </button>
      <button type="button" class="btn  btn-secondary no-print" data-bs-dismiss="modal">@lang( 'messages.close' )</button>


        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang( 'messages.close' )</button> --}}

    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var element = $('div.modal-xl');
		__currency_convert_recursively(element);
	});
</script>