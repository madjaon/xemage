<?php 
	$device = getDevice2();
	$countPost = count($post);
	if($countPost > 0) {
		$title = ($post->meta_title!='')?$post->meta_title:$post->name;
		$h1 = $post->name;
		$isPost = true;
		$is404 = false;
		$meta_title = $post->meta_title;
		$meta_keyword = $post->meta_keyword;
		$meta_description = $post->meta_description;
		$meta_image = $post->meta_image;
	} else {
		$title = PAGENOTFOUND;
		$h1 = PAGENOTFOUND;
		$isPost = false;
		$is404 = true;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
	}
	$extendData = array(
			'isPost' => $isPost,
			'is404' => $is404,
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')
<div class="box">
	<?php
		if(isset($typeMainParent)) {
			$typeMainParentUrl = url($typeMainParent->slug);
			$typeMainUrl = url($typeMainParent->slug.'/'.$typeMain->slug);
			$breadcrumb = array(
				['name' => $typeMainParent->name, 'link' => $typeMainParentUrl],
				['name' => $typeMain->name, 'link' => $typeMainUrl],
				['name' => $h1, 'link' => '']
			);
		} else {
			$typeMainUrl =url($typeMain->slug);
			$breadcrumb = array(
				['name' => $typeMain->name, 'link' => $typeMainUrl],
				['name' => $h1, 'link' => '']
			);
		}
	?>
	@include('site.common.breadcrumb', $breadcrumb)
	<div class="title">
		<h1>{!! $h1 !!}</h1>
	</div>
	<div class="info">
		<div class="description">{!! $post->patterns !!}</div>
		<div class="description">{!! $post->description !!}</div>
		
		@include('site.common.social')
		
		@if(count($tags) > 0)
		<div class="tags">
			<div class="tags-icon"><i class="fa fa-tags" aria-hidden="true"></i> Từ khóa liên quan</div>
			<ul>
				@foreach($tags as $value)
				<li><a href="{{ url('tag/'.$value->slug) }}" title="{!! $value->name !!}">{!! $value->name !!}</a></li>
				@endforeach
			</ul>
		</div>
		@endif

		@include('site.common.ad', ['posPc' => 7, 'posMobile' => 8])

		<div class="fb-comments" data-numposts="5"></div>

		@include('site.post.related', ['typeMainUrl' => $typeMainUrl, 'data' => $typeMain, 'postData' => $postTypes])
		@include('site.post.related', ['typeMainUrl' => $typeMainUrl, 'data' => $related, 'postData' => $postRelated])
	</div>
</div>
@endsection