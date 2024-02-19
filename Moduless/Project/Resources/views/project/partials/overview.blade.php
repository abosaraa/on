<div class="row">
	<div class="col-md-7">
		<div class="row">
			<div class="col-md-3">
				<div class="card card-solid card-warning">
					<div class="card-header with-border">
						<h4 class="card-title">
							@lang('project::lang.incompleted_tasks')
						</h4>
						<!-- /.card-tools -->
					</div>
					<!-- /.card-header -->
					<div class="card-body text-center">
						<span class="fs-20">
							<b>{{$project->incomplete_task}}</b>
						</span>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			@if(isset($project->settings['enable_notes_documents']) && $project->settings['enable_notes_documents'])
				<div class="col-md-3">
					<div class="card card-solid card-primary">
						<div class="card-header with-border">
							<h4 class="card-title">
								@lang('project::lang.documents_and_notes')
							</h4>
							<!-- /.card-tools -->
						</div>
						<!-- /.card-header -->
						<div class="card-body text-center">
							<span class="fs-20">
								<b>{{$project->note_and_documents_count}}</b>
							</span>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			@endif
			@if(isset($project->settings['enable_timelog']) && $project->settings['enable_timelog'])
				<div class="col-md-3">
					<div class="card card-solid card-info">
						<div class="card-header with-border">
							<h4 class="card-title">
								@lang('project::lang.total_time')
							</h4>
							<!-- /.card-tools -->
						</div>
						<!-- /.card-header -->
						<div class="card-body text-center">
							@php
								$hours = floor($timelog->total_seconds / 3600);
								$minutes = floor(($timelog->total_seconds / 60) % 60);
							@endphp
							<span>
								<b>
									{{sprintf('%02d:%02d', $hours, $minutes)}}
								</b>
							</span>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			@endif
			@if((isset($project->settings['enable_invoice']) && $project->settings['enable_invoice']) && $is_lead_or_admin)
				<div class="col-md-3">
					<div class="card card-solid card-success">
						<div class="card-header with-border">
							<h4 class="card-title">
								@lang('sale.total_paid')
								<small class="text-white">
									@lang('project::lang.invoice')
								</small>
							</h4>
							<!-- /.card-tools -->
						</div>
						<!-- /.card-header -->
						<div class="card-body text-center">
							<span>
								<b>
									<span class="subtotal display_currency" data-currency_symbol="true">
										{{$invoice->paid}}
									</span>
								</b>
							</span>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			@endif
		</div>
		<div class="row">
			@if((isset($project->settings['enable_invoice']) && $project->settings['enable_invoice']) && $is_lead_or_admin)
				<div class="col-md-3">
					<div class="card card-solid card-danger">
						<div class="card-header with-border">
							<h4 class="card-title">
								@lang('sale.total_remaining')
								<small class="text-white">
									@lang('project::lang.invoice')
								</small>
							</h4>
							<!-- /.card-tools -->
						</div>
						<!-- /.card-header -->
						<div class="card-body text-center">
							<span>
								<b>
									<span class="subtotal display_currency" data-currency_symbol="true">
										{{$transaction->total - $invoice->paid}}
									</span>
								</b>
							</span>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
			@endif
		</div>
		@if(!empty($project->description))
			<div class="row">
				<div class="col-md-12">
					<div class="card card-solid">
						<div class="card-body">
							{!! $project->description !!}
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
	<div class="col-md-5">
		<!-- customer -->
		<div class="card card-solid card-default">
			<div class="card-header with-border">
				<h4 class="card-title">
					<i class="fas fa-check-circle"></i>
					{{ucFirst($project->name)}}
				</h4>
			</div>
			<div class="card-body">
				@if(isset($project->customer->name))
					<i class="fa fa-briefcase"></i>
					{{$project->customer->name}}
				@endif <br>

				@if(isset($project->customer->mobile))
					<i class="fa fa-mobile"></i>
					@lang('contact.mobile'): {{$project->customer->mobile}}
				@endif <br>

				<i class="fa fa-map-marker"></i>
				@lang('business.address'):
				@if(isset($project->customer->landmark))
			        {{ $project->customer->landmark }}
			    @endif

			    @if(isset($project->customer->city))
			    	{{ ', ' . $project->customer->city }}
			    @endif

			    @if(isset($project->customer->state))
			        {{ ', ' . $project->customer->state }}
			    @endif
			    @if(isset($project->customer->country))
			        {{ ', ' . $project->customer->country }}
			    @endif
				<br>

				<i class="fas fa-check-circle"></i>
				@lang('sale.status'):
				@lang('project::lang.'.$project->status)

				@if($project->categories->count() > 0)
					<br>
					<i class="fa fas fa-gem"></i>
					@lang('category.categories'):
					<span>
					@foreach($project->categories as $categories)
						
						@if(!$loop->last)
							{{$categories->name . ','}}
						@else
							{{$categories->name}}
					    @endif
					@endforeach
					</span>
				@endif
			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				@includeIf('project::avatar.create', ['max_count' => '10', 'members' => $project->members])
			</div>
			<!-- /.card-footer-->
		</div>
	</div>
</div>