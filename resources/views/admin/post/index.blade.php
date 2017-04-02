@extends('admin.layouts.master')

@section('title', 'Posts')

@section('content')

@include('admin.post.search')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ route('admin.post.index') }}" class="btn btn-success">Danh sách post</a>
		<a href="{{ route('admin.post.create') }}" class="btn btn-primary">Thêm post</a>
		<a onclick="actionSelected(3);" class="btn btn-danger" id="loadMsg3">Xóa mục đã chọn</a>
		<a onclick="actionSelected(2);" class="btn btn-warning" id="loadMsg2">Đổi thể loại mục đã chọn</a>
		<a onclick="actionSelected(1);" class="btn btn-default" id="loadMsg1">Đổi Status mục đã chọn</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Posts</h3><i> - Total: {{ $data->total() }}</i>
			</div>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tr>
						<th><input type="checkbox" id="checkall" onClick="toggle(this)"></th>
						<th>Image</th>
						<th>Name</th>
						<th>Thể loại chính</th>
						<!-- <th>Loại post</th> -->
						<th>Lượt xem</th>
						<th>Nguồn</th>
						<th>Ngày đăng</th>
						<th>Status</th>
						<th style="width:200px;">Action</th>
					</tr>
					@foreach($data as $key => $value)
					<?php 
						$thumbnail = str_replace('/images/', '/thumbs/', $value->image);
						$thumbnail = str_replace('/thumb/', '/', $thumbnail);
					?>
					<tr>
						<td><input type="checkbox" class="id" name="id[]" value="{{ $value->id }}"></td>
						<td><img height="30px" src="{{ $thumbnail }}" /></td>
						<td>{{ $value->name }}</td>
						<td>{{ CommonQuery::getFieldById('post_types', $value->type_main_id, 'name') }}</td>
						<!-- <td>{{-- CommonOption::getTypePost($value->type) --}}</td> -->
						<td>{{ getZero($value->view) }}</td>
						<td><a href="{{ $value->source_url }}" target="_blank" rel="nofollow">{{ $value->source }}</a></td>
						<td>{!! CommonMethod::startDateLabel($value->start_date) !!}</td>
						<td><a id="status_{{ $value->id }}" onclick="updateStatus({{ $value->id }}, 'status')" style="cursor: pointer;" title="Click to change">{!! CommonOption::getStatus($value->status) !!}</a></td>
						<td>
							<a href="{{ CommonUrl::getUrl($value->slug) }}" class="btn btn-success" target="_blank">Xem</a>
							<a href="{{ route('admin.post.edit', $value->id) }}" class="btn btn-primary">Sửa</a>
							<form method="POST" action="{{ route('admin.post.destroy', $value->id) }}" style="display: inline-block;">
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
								<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
							</form>
						</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		{!! $data->appends($request->except('page'))->render() !!}
	</div>
</div>

@include('admin.post.indexposttype')
@include('admin.post.script')

@stop