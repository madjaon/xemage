@if($breadcrumb)
<ul class="breadcrumbs">
	<li><a href="{{ url('/') }}">Trang chủ</a></li>
	@foreach($breadcrumb as $value)
		@if($value['link'])
			<li>
				<a href="{{ $value['link'] }}">{!! $value['name'] !!}</a>
			</li>
		@else
			<li>
				<span>{!! $value['name'] !!}</span>
			</li>
		@endif
	@endforeach
</ul>
@endif