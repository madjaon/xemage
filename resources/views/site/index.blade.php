<?php 
	if(isset($seo)) {
		$title = ($seo->meta_title)?$seo->meta_title:'Trang chủ';
		$meta_title = $seo->meta_title;
		$meta_keyword = $seo->meta_keyword;
		$meta_description = $seo->meta_description;
		$meta_image = $seo->meta_image;
		$isHome = true;
		$is404 = false;
	} else {
		$title = PAGENOTFOUND;
		$meta_title = '';
		$meta_keyword = '';
		$meta_description = '';
		$meta_image = '';
		$isHome = false;
		$is404 = true;
	}
	$extendData = array(
			'meta_title' => $meta_title,
			'meta_keyword' => $meta_keyword,
			'meta_description' => $meta_description,
			'meta_image' => $meta_image,
			'isHome' => $isHome,
			'is404' => $is404,
		);
?>
@extends('site.layouts.master', $extendData)

@section('title', $title)

@section('content')

@include('patterns.filter1')

@include('site.common.ad', ['posPc' => 7, 'posMobile' => 8])

<div class="box">
	<div class="box-title clearfix">
		<h3><a href="{{ url('/tu-vi-tron-doi') }}" title="Tử vi">Tử vi</a></h3>
		<span>&nbsp;</span>
	</div>
	<ul class="loveyou">
		<li><a href="{{ url('/tu-vi-2017') }}" title="Tử vi 2017">Tử vi 2017</a></li>
		<li><a href="{{ url('/tu-vi-tron-doi') }}" title="Tử vi trọn đời">Tử vi trọn đời</a></li>
		<li><a href="{{ url('/tu-vi-12-con-giap') }}" title="Tử vi 12 con giáp">Tử vi 12 con giáp</a></li>
		<li><a href="{{ url('/xem-tu-vi-theo-gio-sinh') }}" title="Tử vi theo giờ sinh">Tử vi theo giờ sinh</a></li>
		<li><a href="{{ url('/kien-thuc-tu-vi') }}" title="Kiến Thức Tử Vi">Kiến Thức Tử Vi</a></li>
	</ul>
</div>

<div class="box">
	<div class="box-title clearfix">
		<h3><a href="{{ url('/xem-tuoi') }}" title="Xem tuổi">Xem tuổi</a></h3>
		<span>&nbsp;</span>
	</div>
	<ul class="loveyou">
		<li><a href="{{ url('/xem-tuoi-vo-chong') }}" title="Xem tuổi vợ chồng">Xem tuổi vợ chồng</a></li>
		<li><a href="{{ url('/xem-tuoi-ket-hon') }}" title="Xem tuổi kết hôn">Xem tuổi kết hôn</a></li>
		<li><a href="{{ url('/xem-tuoi-xong-dat') }}" title="Xem Tuổi Xông Đất">Xem Tuổi Xông Đất</a></li>
		<li><a href="{{ url('/dat-ten-con-theo-ngu-hanh') }}" title="Đặt tên con theo ngũ hành">Đặt tên con theo ngũ hành</a></li>
		<li><a href="{{ url('/cao-ly-dau-hinh') }}" title="Cao ly đầu hình">Cao ly đầu hình</a></li>
		<li><a href="{{ url('/quy-coc-toan-menh') }}" title="Quỷ cốc toán mệnh">Quỷ cốc toán mệnh</a></li>
		<li><a href="{{ url('/bang-tinh-tam-tai-hoang-oc-kim-lau') }}" title="Bảng tính tam tai hoàng ốc kim lâu">Bảng tính tam tai hoàng ốc kim lâu</a></li>
		<li><a href="{{ url('/menh-so') }}" title="Xem mệnh số">Xem mệnh số</a></li>
		<li><a href="{{ url('/xem-cung-menh-theo-nam-sinh') }}" title="Xem cung mệnh">Xem cung mệnh</a></li>
		<li><a href="{{ url('/xem-sao-chieu-menh') }}" title="Xem sao chiếu mệnh">Xem sao chiếu mệnh</a></li>
		<li><a href="{{ url('/tich-truyen') }}" title="Tích Truyện">Tích Truyện</a></li>
		<li><a href="{{ url('/van-khan-co-truyen') }}" title="Văn Khấn Cổ Truyền">Văn Khấn Cổ Truyền</a></li>
		<li><a href="{{ url('/nhan-qua') }}" title="Nhân quả">Nhân quả</a></li>
		<li><a href="{{ url('/nhung-cau-noi-hay') }}" title="Những câu nói hay">Những câu nói hay</a></li>
		<li><a href="{{ url('/tuong-so') }}" title="Tướng Số">Tướng Số</a></li>
		
	</ul>
</div>

<div class="box">
	<div class="box-title clearfix">
		<h3>Ngũ hành, phong thủy</h3>
		<span>&nbsp;</span>
	</div>
	<ul class="loveyou">
		<li><a href="{{ url('/mau-sac-hop-tuoi') }}" title="Xem màu sắc hợp tuổi">Xem màu sắc hợp tuổi</a></li>
		<li><a href="{{ url('/xem-ngay-cuoi-hoi') }}" title="Xem ngày cưới hỏi">Xem ngày cưới hỏi</a></li>
		<li><a href="{{ url('/chon-ngay-chon-cat') }}" title="Xem ngày chon cất">Xem ngày chôn cất</a></li>
		<li><a href="{{ url('/xem-ngay-khai-truong') }}" title="Xem ngày khai trương">Xem ngày khai trương</a></li>
		<li><a href="{{ url('/xem-ngay-lam-nha') }}" title="Xem ngày làm nhà">Xem ngày làm nhà</a></li>
		<li><a href="{{ url('/xem-ngay-nhap-trach-ve-nha-moi') }}" title="Xem ngày về nhà mới">Xem ngày về nhà mới</a></li>
		<li><a href="{{ url('/xem-ngay-tu-tao-sua-chua') }}" title="Xem ngày tu tạo sửa chữa">Xem ngày tu tạo sửa chữa</a></li>
		<li><a href="{{ url('/xem-ngay-bat-tuong') }}" title="Xem ngày bất tương">Xem ngày bất tương</a></li>
		<li><a href="{{ url('/xem-ngay-hac-dao-ngay-xau') }}" title="Xem ngày hắc đạo">Xem ngày hắc đạo</a></li>
		<li><a href="{{ url('/xem-ngay-hoang-dao') }}" title="Xem ngày hoàng đạo">Xem ngày hoàng đạo</a></li>
		<li><a href="{{ url('/xem-huong-nha-tot') }}" title="Xem hướng nhà tốt">Xem hướng nhà tốt</a></li>
		<li><a href="{{ url('/phong-thuy/phong-thuy-mat-tien') }}" title="Xem phong thủy mặt tiền">Phong thủy mặt tiền</a></li>
		<li><a href="{{ url('/phong-thuy/phong-thuy-san-vuon') }}" title="Xem phong thủy sân vườn">Phong thủy sân vườn</a></li>
		<li><a href="{{ url('/phong-thuy/phong-thuy-cai-menh') }}" title="Phong Thủy Cải Mệnh">Phong Thủy Cải Mệnh</a></li>
		<li><a href="{{ url('/phong-thuy/phong-thuy-kinh-doanh') }}" title="Phong Thủy Kinh Doanh">Phong Thủy Kinh Doanh</a></li>
		<li><a href="{{ url('/phong-thuy/phong-thuy-nha-o') }}" title="Phong Thủy Nhà Ở">Phong Thủy Nhà Ở</a></li>
		<li><a href="{{ url('/phong-tuc-tap-quan') }}" title="Phong Tục Tập Quán">Phong Tục Tập Quán</a></li>
	</ul>
</div>

<div class="box">
	<div class="box-title clearfix">
		<h3><a href="{{ url('/xem-boi') }}" title="Xem bói">Xem bói</a></h3>
		<span>&nbsp;</span>
	</div>
	<ul class="loveyou">
		<li><a href="{{ url('/boi-ngay-sinh') }}" title="Bói ngày sinh">Bói ngày sinh</a></li>
		<li><a href="{{ url('/boi-not-ruoi') }}" title="Bói nốt ruồi">Bói nốt ruồi</a></li>
		<li><a href="{{ url('/boi-nhay-mat') }}" title="Bói nháy mắt">Bói nháy mắt</a></li>
		<li><a href="{{ url('/xem-boi-chi-tay') }}" title="Xem Bói Chỉ Tay">Xem Bói Chỉ Tay</a></li>
		<li><a href="{{ url('/xem-boi-hoa-tay') }}" title="Xem Bói hoa tay">Xem Bói hoa tay</a></li>
		<li><a href="{{ url('/diem-bao-lanh-du') }}" title="Điềm báo lành dữ">Điềm báo lành dữ</a></li>
		<li><a href="{{ url('/giai-ma-giac-mo') }}" title="Giải Mã Giấc Mơ">Giải Mã Giấc Mơ</a></li>
		<li><a href="{{ url('/giai-mong-chiem-bao') }}" title="Giải Mộng Chiêm Bao">Giải Mộng Chiêm Bao</a></li>
		<li><a href="{{ url('/giai-ma-giac-mo-va-cac-con-so') }}" title="Giải Mã Giấc Mơ Và Các Con Số">Giải Mã Giấc Mơ Và Các Con Số</a></li>
		<li><a href="{{ url('/ngay-sinh-va-tinh-cach') }}" title="Xem bói ngày Sinh Và Tính Cách">Bói ngày Sinh Và Tính Cách</a></li>
		<li><a href="{{ url('/thang-sinh-va-tinh-cach') }}" title="Xem bói tháng Sinh Và Tính Cách">Bói tháng Sinh Và Tính Cách</a></li>
		<li><a href="{{ url('/xem-boi-tinh-yeu-theo-nhom-mau') }}" title="Xem bói tình yêu theo nhóm máu">Bói tình yêu theo nhóm máu</a></li>
		<li><a href="{{ url('/xem-boi-thay-phan') }}" title="Xem bói thầy phán">Bói thầy phán</a></li>
		<li><a href="{{ url('/xem-boi-ai-cap') }}" title="Xem bói Ai Cập">Xem bói Ai Cập</a></li>
		<li><a href="{{ url('/xem-boi-tinh-yeu-theo-chu-cai-dau-tien') }}" title="Xem Bói Tình Yêu Theo Chữ Cái Đầu Tiên Trong Tên">Bói Tình Yêu Theo Chữ Cái</a></li>
		<li><a href="{{ url('/xem-boi-tinh-cach-theo-chu-cai-dau-tien') }}" title="Xem Bói Tính Cách Theo Chữ Cái Đầu Tiên Trong Tên">Bói Tính Cách Theo Chữ Cái</a></li>
		<li><a href="{{ url('/xem-boi-tuong-mat') }}" title="Xem Bói Tướng Mặt">Xem Bói Tướng Mặt</a></li>
		<li><a href="{{ url('/boi-bai-tay') }}" title="Bói Bài Tây">Bói Bài Tây</a></li>
	</ul>
</div>

<div class="box">
	<div class="box-title clearfix">
		<h3><a href="{{ url('/12-cung-hoang-dao') }}" title="12 Cung Hoàng Đạo">12 Cung Hoàng Đạo</a></h3>
		<span>&nbsp;</span>
	</div>
	<ul class="loveyou">
		<li><a href="{{ url('/xem-cung-hoang-dao') }}" title="Xem cung hoàng đạo">Xem cung hoàng đạo</a></li>
		<li><a href="{{ url('/tinh-yeu-cua-cung-hoang-dao') }}" title="Tình Yêu Của Cung Hoàng Đạo">Tình Yêu Của Cung Hoàng Đạo</a></li>
		<li><a href="{{ url('/xep-hang-12-chom-sao') }}" title="Xếp Hạng 12 Chòm Sao">Xếp Hạng 12 Chòm Sao</a></li>
	</ul>
</div>

@if(count($data) > 0)
	@foreach($data as $key => $value)
		@if(count($value->posts) > 0)
			<?php 
				if($value->parentType) {
					$url = url($value->parentType->slug.'/'.$value->slug);
				} else {
					$url = url($value->slug);
				}
			?>
			<div class="box">
				<div class="box-title clearfix">
					<h3><a href="{{ $url }}" title="{!! $value->name !!}">{!! $value->name !!}</a></h3>
					<span>&nbsp;</span>
				</div>
				@include('site.post.box', array('type' => $value))
			</div>
			<div class="clearfix"></div>
		@endif
	@endforeach
@endif

@endsection