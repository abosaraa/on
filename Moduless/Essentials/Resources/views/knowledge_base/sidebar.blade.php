@if(count($knowledge_base->children) > 0)

<div class="card-group" 
	id="accordian">
	@foreach($knowledge_base->children as $section)
		<div class="panel card card-primary" style="margin-bottom: 0;">
			<div class="card-header with-border">
				<h4 class="card-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#collapse_{{$section->id}}" @if($loop->index == 0 )aria-expanded="true" @endif>{{$section->title}}
					</a>
				</h4>
				<div class="card-tools pull-right">
					<a class="text-info p-5-5" href="{{action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$section->id])}}" title="@lang('messages.view')" data-toggle="tooltip"><i class="fas fa-eye"></i></a>
				</div>
			</div>
			<div id="collapse_{{$section->id}}" class="panel-collapse collapse @if($section_id == $section->id )in @endif" @if($loop->index == 0 )aria-expanded="true" @endif >
                <div class="card-body" style="padding: 10px 10px;">
            		@if(count($section->children) > 0)
            			<ul class="list-group">
            			@foreach($section->children as $article)
            				<li class="list-group-item @if($article_id == $article->id) bg-info @endif"><a class="text-primary" href="{{action([\Modules\Essentials\Http\Controllers\KnowledgeBaseController::class, 'show'], [$article->id])}}">{{$article->title}}
            				</a>
            				</li>
            			@endforeach
            			</ul>
            		@endif
                </div>
            </div>
		</div>
	@endforeach
</div>

@endif