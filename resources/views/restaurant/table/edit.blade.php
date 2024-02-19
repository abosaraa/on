<div class="modal-dialog" role="document">
  <div class="modal-content">

    {!! Form::open(['url' => action([\App\Http\Controllers\Restaurant\TableController::class, 'update'], [$table->id]), 'method' => 'PUT', 'id' => 'table_edit_form' ]) !!}

    <div class="modal-header">
      
          <button type="button" class="btn custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="custom-close-icon">&times;</span>
          </button>
      <h4 class="modal-title">@lang( 'restaurant.edit_table' )</h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        {!! Form::label('name', __( 'restaurant.table_name' ) . ':*') !!}
          {!! Form::text('name', $table->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'brand.brand_name' )]); !!}
      </div>

      <div class="form-group">
        {!! Form::label('description', __( 'restaurant.short_description' ) . ':') !!}
          {!! Form::text('description', $table->description, ['class' => 'form-control','placeholder' => __( 'brand.short_description' )]); !!}
      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">@lang( 'messages.update' )</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang( 'messages.close' )</button>
    </div>

    {!! Form::close() !!}

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->