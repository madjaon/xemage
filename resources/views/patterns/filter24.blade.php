<!-- phong thuy mat tien nha o -->
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
	<p><label>Năm sinh:</label>{!! CommonOption::getListYear('year', 2000, 1947, $year) !!}</p>
	<p><label>Giới tính:</label>{!! CommonOption::getListSex('sex', $sex) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter24">Xem kết quả</button></p>
</div>
<script>
	// phong thuy mat tien nha o
	$('#filter24').click(function(){
		var year = $('select[name="year"] option:selected').val();
		var sex = $('input[name="sex"]:checked').val();
		if(year === '' || sex === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		if(sex === '2') {
			sextext = 'nu';
		} else {
			sextext = 'nam';
		}
		var url = '/xem-phong-thuy-mat-tien-'+sextext+'-sinh-nam-'+year;
		window.location.href = url;
	});
</script>