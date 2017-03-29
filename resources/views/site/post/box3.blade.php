<?php 
	if(isset($type) && isset($type->posts)) {
		$data = $type->posts;
	}
?>
<div class="box-grid box3">
	<ul>
		@foreach($data as $key => $value)
			<?php 
				if(isset($type) && isset($value->parent_id)) {
					$url = url($type->slug.'/'.$value->slug);
				} else {
					$url = url($value->slug);
				}
				$image = ($value->image)?$value->image:'/img/noimage.jpg';
			?>
			<li>
				<a href="{{ $url }}" title="{!! $value->name !!}">
					<img src="{{ $image }}" alt="{!! $value->name !!}" />
					<strong>{!! $value->name !!}</strong>
				</a>
			</li>
		@endforeach
	</ul>
</div>