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
<script>
	// xem ngay hac dao ngay xau
	$('#filter17').click(function(){
		var month = $('select[name="month"] option:selected').val();
		var year = $('select[name="year"] option:selected').val();
		if(month === '' || year === '') {
			$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
		}
		var url = '/xem-ngay-hac-dao-ngay-xau-thang-'+month+'-nam-'+year;
		window.location.href = url;
	});
</script>