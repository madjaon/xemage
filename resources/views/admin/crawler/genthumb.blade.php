@extends('admin.layouts.master')

@section('title', 'Generate Thumbnail Avatar Images')

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.post.index') }}" class="btn btn-success">Danh sách post</a>
		<a href="{{ route('admin.post.create') }}" class="btn btn-primary">Thêm post</a>
		<a href="/admin/genthumb" class="btn btn-warning">Gen Thumb</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Generate Thumbnail Avatar Images</h3>
			</div>
			<div class="box-body">
				@if(count($data) > 0)
					<p>Có <strong>{{ count($data) }} ảnh avatar được tạo thumbnail</strong></p>
					<ul>
						@foreach($data as $value)
						<li>{{ $value }}</li>
						@endforeach
					</ul>
				@else
					<p>No Generate Thumbnail Avatar Images</p>
				@endif
			</div>
		</div>
	</div>
</div>

@stop