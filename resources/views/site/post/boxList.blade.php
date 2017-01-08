<div class="box-list">
	<ul>
		@foreach($data as $key => $value)
		<?php 
			$image = ($value->image)?$value->image:'/img/noimage.jpg';
		?>
		<li>
			<div class="list-left">
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $image }}" alt="{!! $value->name !!}" />
				</a>
			</div>
			<div class="list-right">
				<h2><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h2>
				@if($value->summary != '')
				<p>{!! $value->summary !!}</p>
				@else
				<p>{!! limit_text(strip_tags($value->description), 300) !!}</p>
				@endif
			</div>
			<div class="clearfix"></div>
		</li>
		@endforeach
	</ul>
</div>