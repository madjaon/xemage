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
<script>
	// xem sao chieu menh
	$('#filter22').click(function(){
		var year1 = $('select[name="year1"] option:selected').val();
		var year2 = $('select[name="year2"] option:selected').val();
		var sex = $('input[name="sex"]:checked').val();
		if(year1 === '' || sex === '' || year2 === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		if(sex === '2') {
			sextext = 'nu';
		} else {
			sextext = 'nam';
		}
		var url = '/xem-sao-chieu-menh-nam-'+year2+'-cua-'+sextext+'-sinh-nam-'+year1;
		window.location.href = url;
	});
</script>