<?php 
	if($data->total() > 0) {
		$title = ($tag->meta_title!='')?$tag->meta_title:$tag->name;
		$h1 = $tag->name;
		$is404 = false;
		$meta_title = $tag->meta_title;
		$meta_keyword = $tag->meta_keyword;
		$meta_description = $tag->meta_description;
		$meta_image = $tag->meta_image;
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
			['name' => $h1, 'link' => '']
		);
	?>
	@include('site.common.breadcrumb', $breadcrumb)
	<div class="title">
		<h1>{!! $h1 !!}</h1>
	</div>
	@include('site.post.boxList', array('data' => $data))
	@include('site.common.paginate', ['paginator' => $data])
</div>
@endsection