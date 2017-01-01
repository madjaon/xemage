<?php 
	$title = 'Tìm kiếm';
	$meta_title = '';
	$meta_keyword = '';
	$meta_description = '';
	$meta_image = '';
	$extendData = array(
			'is404' => false,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
			'pagePrev' => isset($data)?$data->previousPageUrl():null,
			'pageNext' => isset($data)?$data->nextPageUrl():null
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<?php
		$breadcrumb = array(
			['name' => $title, 'link' => '']
		);
	?>
	@include('site.common.breadcrumb', $breadcrumb)
	<div class="title">
		<strong>{!! $title !!}</strong>
	</div>
	<div class="search-result">
		<span>Kết quả tìm kiếm cho từ khóa:</span><h1>{{ $request->name }}</h1>
	</div>
	@if(isset($data) && $data->total() > 0)
		@include('site.post.boxList', array('data' => $data))
		@include('site.common.paginate', ['paginator' => $data])
	@else
		<div class="search-result">
			<p>Không tìm thấy kết quả nào phù hợp</p>
		</div>
	@endif
</div>
@endsection