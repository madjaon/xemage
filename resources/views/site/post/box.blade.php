<?php 
	if(isset($type) && isset($type->posts)) {
		$data = $type->posts;
		$display = $type->display;
	} else {
		$display = DISPLAY_1;
	}
?>
<div class="box-grid">
@if($display == DISPLAY_1)
	<ul>
		@foreach($data as $key => $value)
			<?php 
				$image = ($value->image)?$value->image:'/img/noimage.jpg';
			?>
			<li>
				<a href="{{ url($value->slug) }}" title="{!! $value->name !!}">
					<img src="{{ $image }}" alt="{!! $value->name !!}" />
					<span>{!! $value->name !!}</span>
					<div class="clearfix"></div>
				</a>
			</li>
		@endforeach
	</ul>
	<div class="clearfix"></div>
@else
	<ul class="kiromitsu">
		@foreach($data as $key => $value)
		<li><a href="{{ url($value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></li>
		@endforeach
	</ul>
	<div class="clearfix"></div>
@endif
</div>