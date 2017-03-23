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
<script>
	// bang tinh tam tai hoang oc kim lau
	$('#filter21').click(function(){
		var year = $('select[name="year"] option:selected').val();
		if(year === '') {
			$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
		}
		var url = '/bang-tinh-tam-tai-hoang-oc-kim-lau-nam-'+year;
		window.location.href = url;
	});
</script>