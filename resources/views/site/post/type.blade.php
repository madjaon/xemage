<?php 
	if($type) {
		$title = ($type->meta_title!='')?$type->meta_title:$type->name;
		$h1 = $type->name;
		$is404 = false;
		$meta_title = $type->meta_title;
		$meta_keyword = $type->meta_keyword;
		$meta_description = $type->meta_description;
		$meta_image = $type->meta_image;
	} else {
		$title = PAGENOTFOUND;
		$h1 = PAGENOTFOUND;
		$is404 = true;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
	}
	$extendData = array(
			'is404' => $is404,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
			'pagePrev' => ($total > 0)?$data->previousPageUrl():null,
			'pageNext' => ($total > 0)?$data->nextPageUrl():null
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<?php
		if(isset($typeParent)) {
			$breadcrumb = array(
				['name' => $typeParent->name, 'link' => url($typeParent->slug)],
				['name' => $h1, 'link' => '']
			);
		} else {
			$breadcrumb = array(
				['name' => $h1, 'link' => '']
			);
		}
	?>
	@include('site.common.breadcrumb', $breadcrumb)
	<div class="title">
		<h1>{!! $h1 !!}</h1>
	</div>
	<div class="info">
		<div class="description">{!! $type->patterns !!}</div>
		<div class="description">{!! $type->summary !!}</div>
		<div class="description">{!! $type->description !!}</div>

		@include('site.common.ad', ['posPc' => 7, 'posMobile' => 8])
		
	</div>
	@if(isset($typeChild))
		@include('site.post.box3', array('data' => $typeChild, 'type' => $type))
	@endif
	@if($total > 0)
		@if($type->grid == ACTIVE)
		@include('site.post.boxList', array('data' => $data, 'type' => $type))
		@else
		@include('site.post.box', array('data' => $data))
		@endif
		@if(isset($paginate))
		@include('site.common.paginate', ['paginator' => $data])
		@endif
	@endif
</div>
@endsection