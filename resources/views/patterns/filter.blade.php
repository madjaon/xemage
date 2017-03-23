@if(isset($filter))
@if($filter == 1)
<!-- tu vi tron doi -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-3];
		if(!isset($year) || !is_numeric($year)) {
			$year = 1930;
		}
		$sextext = $slugCharacter[count($slugCharacter)-2];
		if(isset($sextext) && $sextext == 'nu') {
			$sex = '2';
		} else {
			$sex = '1';
		}
	} else {
		$year = 1930;
		$sex = '1';
	}
?>
<div class="timebox">
	<h3>Tra Cứu Tử Vi Trọn Đời</h3>
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year', 2049, 1930, $year) !!}</p>
	<p><label>Giới tính:</label>{!! CommonOption::getListSex('sex', $sex) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter1">Xem kết quả</button></p>
</div>
@endif
@if($filter == 2)
<!-- xem hop tuoi -->
<div class="timebox">
	<h3>Xem Tuổi Hợp Làm Ăn</h3>
	<p><label>Năm sinh  (âm lịch) và giới tính của bạn:</label>{!! CommonOption::getListYear('year1', 2049, 1930) !!} {!! CommonOption::getListSex('sex1') !!}</p>
	<p><label>Năm sinh  (âm lịch) và giới tính người khác:</label>{!! CommonOption::getListYear('year2', 2049, 1930) !!} {!! CommonOption::getListSex('sex2') !!}</p>
	<p id="filterError"></p>
	<p><button id="filter2">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
@endif
@if($filter == 3)
<!-- xem tuoi vo chong -->
<div class="timebox">
	<p><label>Năm sinh chồng (âm lịch):</label>{!! CommonOption::getListYear('year1', 2049, 1930) !!}</p>
	<p><label>Năm sinh vợ (âm lịch):</label>{!! CommonOption::getListYear('year2', 2049, 1930) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter3">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
@endif
@if($filter == 4)
<!-- Tra Cứu Tên Theo Ngũ Hành -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 0) {
		$hanh = $slugCharacter[count($slugCharacter)-1];	
	} else {
		$hanh = 'kim';
	}
?>
<div class="timebox">
	<p><label>Chọn hành:</label>{!! CommonOption::getListNguHanh($hanh) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter4">Xem kết quả</button></p>
</div>
@endif
@if($filter == 5)
<!-- Quy Coc Toan Menh -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 2) {
		$cannamsinh = $slugCharacter[count($slugCharacter)-2];
		$cangiosinh = $slugCharacter[count($slugCharacter)-1];
	} else {
		$cannamsinh = 'giap';
		$cangiosinh = 'giap';
	}
?>
<div class="timebox">
	<p><label>Can của năm sinh (âm lịch):</label>{!! CommonOption::getListCan('cannamsinh', $cannamsinh) !!}</p>
	<p><label>Can của giờ sinh:</label>{!! CommonOption::getListCan('cangiosinh', $cangiosinh) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter5">Xem kết quả</button></p>
</div>
@endif
@if($filter == 6)
<!-- xem tuoi ket hon -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 4) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 1947;
		}
		$sextext = $slugCharacter[count($slugCharacter)-4];
		if(isset($sextext) && $sextext == 'nu') {
			$sex = '2';
		} else {
			$sex = '1';
		}
	} else {
		$year = 1947;
		$sex = '1';
	}
?>
<div class="timebox">
	<h3>Tra Cứu Tuổi Kết Hôn</h3>
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year', 2032, 1947, $year) !!}</p>
	<p><label>Giới tính:</label>{!! CommonOption::getListSex('sex', $sex) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter6">Xem kết quả</button></p>
</div>
@endif
@if($filter == 7)
<!-- Cao ly đầu hình -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 4) {
		$can = $slugCharacter[count($slugCharacter)-4];
		$chi = $slugCharacter[count($slugCharacter)-1];
	} else {
		$can = 'giap';
		$chi = 'ty';
	}
?>
<div class="timebox">
	<p><label>Can tuổi chồng (âm lịch):</label>{!! CommonOption::getListCan('can', $can) !!}</p>
	<p><label>Chi tuổi vợ (âm lịch):</label>{!! CommonOption::getListChi('chi', $chi) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter7">Xem kết quả</button></p>
</div>
@endif
@if($filter == 8)
<!-- xem ngay cuoi hoi -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng cưới (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm cưới:</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter8">Xem kết quả</button></p>
</div>
@endif
@if($filter == 9)
<!-- xem ngay hoang dao -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm :</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter9">Xem kết quả</button></p>
</div>
@endif
@if($filter == 10)
<!-- xem ngay lam nha -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm :</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter10">Xem kết quả</button></p>
</div>
@endif
@if($filter == 11)
<!-- xem ngay nhap trach (ve nha moi) -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm (dương lịch):</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter11">Xem kết quả</button></p>
</div>
@endif
@if($filter == 12)
<!-- xem ngay khai truong -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm:</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter12">Xem kết quả</button></p>
</div>
@endif
@if($filter == 13)
<!-- xem ngay tu tao sua chua -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm:</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter13">Xem kết quả</button></p>
</div>
@endif
@if($filter == 14)
<!-- mau sac hop tuoi -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 4) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 1947;
		}
		$sextext = $slugCharacter[count($slugCharacter)-4];
		if(isset($sextext) && $sextext == 'nu') {
			$sex = '2';
		} else {
			$sex = '1';
		}
	} else {
		$year = 1947;
		$sex = '1';
	}
?>
<div class="timebox">
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year', 2027, 1947, $year) !!}</p>
	<p><label>Giới tính:</label>{!! CommonOption::getListSex('sex', $sex) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter14">Xem kết quả</button></p>
</div>
@endif
@if($filter == 15)
<!-- xem huong nha tot -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 4) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 1947;
		}
		$sextext = $slugCharacter[count($slugCharacter)-4];
		if(isset($sextext) && $sextext == 'nu') {
			$sex = '2';
		} else {
			$sex = '1';
		}
	} else {
		$year = 1947;
		$sex = '1';
	}
?>
<div class="timebox">
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year', 2027, 1947, $year) !!}</p>
	<p><label>Giới tính:</label>{!! CommonOption::getListSex('sex', $sex) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter15">Xem kết quả</button></p>
</div>
@endif
@if($filter == 16)
<!-- chon ngay chon cat -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm:</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter16">Xem kết quả</button></p>
</div>
@endif
@if($filter == 17)
<!-- xem ngay hac dao ngay xau -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm:</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter17">Xem kết quả</button></p>
</div>
@endif
@if($filter == 18)
<!-- xem ngay bat tuong -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 2017;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
	} else {
		$year = 2017;
		$month = 1;
	}
?>
<div class="timebox">
	<p><label>Tháng (dương lịch):</label>{!! CommonOption::getListMonth('month', $month) !!}</p>
	<p><label>Năm:</label>{!! CommonOption::getListYear('year', 2027, 2017, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter18">Xem kết quả</button></p>
</div>
@endif
@if($filter == 19)
<!-- xem tu vi gio sinh -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 0) {
		$hour = $slugCharacter[count($slugCharacter)-1];
	} else {
		$hour = 'ty';
	}
?>
<div class="timebox">
	<p><label>Giờ sinh:</label>{!! CommonOption::getListHour('hour', $hour) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter19">Xem kết quả</button></p>
</div>
@endif
@if($filter == 20)
<!-- xem cung menh -->
<div class="timebox">
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year', 2049, 1930) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter20">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
@endif
@if($filter == 21)
<!-- bang tinh tam tai hoang oc kim lau -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 0) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 1947;
		}
	} else {
		$year = 1947;
	}
?>
<div class="timebox">
	<p><label>Năm cần xem:</label>{!! CommonOption::getListYear('year', 2032, 1947, $year) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter21">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
@endif
@if($filter == 22)
<!-- xem sao chieu menh -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 6) {
		$year1 = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year1) || !is_numeric($year1)) {
			$year1 = 1947;
		}
		$year2 = $slugCharacter[count($slugCharacter)-6];
		if(!isset($year2) || !is_numeric($year2)) {
			$year2 = 2017;
		}
		$sextext = $slugCharacter[count($slugCharacter)-4];
		if(isset($sextext) && $sextext == 'nu') {
			$sex = '2';
		} else {
			$sex = '1';
		}
	} else {
		$year1 = 1947;
		$year2 = 2017;
		$sex = '1';
	}
?>
<div class="timebox">
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year1', 2027, 1947, $year1) !!} {!! CommonOption::getListSex('sex', $sex) !!}</p>
	<p><label>Năm xem sao chiếu mệnh:</label>{!! CommonOption::getListYear('year2', 2020, 2017, $year2) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter22">Xem kết quả</button></p>
</div>
@endif

@endif
