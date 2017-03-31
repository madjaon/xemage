<?php 
	if(isset($type) && isset($type->posts)) {
		$data = $type->posts;
	}
?>
<div class="box-list box0">
	<ul>
		@foreach($data as $key => $value)
			<?php 
				if(isset($type) && isset($value->parent_id)) {
					$url = url($type->slug.'/'.$value->slug);
				} else {
					$url = url($value->slug);
				}
			?>
			<li>
				<i class="fa fa-caret-right" aria-hidden="true"></i><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a>
			</li>
		@endforeach
	</ul>
</div>