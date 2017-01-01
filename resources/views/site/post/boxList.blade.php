<div class="box-list">
	<ul>
		@foreach($data as $key => $value)
		<li>
			<div class="list-left">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $value->image }}" alt="{!! $value->name !!}" />
				</a>
			</div>
			<div class="list-right">
				<h2><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
				@if($value->summary != '')
				<p>{!! $value->summary !!}</p>
				@else
				<p>{!! substr(strip_tags($value->description),0,300) . '...' !!}</p>
				@endif
			</div>
			<div class="clearfix"></div>
		</li>
		@endforeach
	</ul>
</div>