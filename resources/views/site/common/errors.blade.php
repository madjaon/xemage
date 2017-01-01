@if(count($errors) > 0)
    <div class="alert">
        <b><i class="fa fa-times"></i> Có lỗi xảy ra!</b>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success'))
    <div class="success">
        <b><i class="fa fa-check"></i> Thành công!</b> {{ Session::get('success') }}
    </div>
@endif
@if(Session::has('warning'))
    <div class="warning">
        <b><i class="fa fa-warning"></i> Chú ý!</b> {{ Session::get('warning') }}
    </div>
@endif