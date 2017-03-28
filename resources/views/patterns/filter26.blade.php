<!-- xem tuoi xong dat -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 9) {
		$year1 = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year1) || !is_numeric($year1)) {
			$year1 = 1955;
		}
		$year2 = $slugCharacter[count($slugCharacter)-9];
		if(!isset($year2) || !is_numeric($year2)) {
			$year2 = 2018;
		}
	} else {
		$year1 = 1955;
		$year2 = 2018;
	}
?>
<div class="timebox">
	<p><label>Năm sinh gia chủ:</label>{!! CommonOption::getListYear('year1', 2015, 1955, $year1) !!}</p>
	<p><label>Năm xông đất:</label>{!! CommonOption::getListYear('year2', 2022, 2018, $year2) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter26">Xem kết quả</button></p>
</div>
<script>
	// xem tuoi xong dat
	$('#filter26').click(function(){
		var year1 = $('select[name="year1"] option:selected').val();
		var year2 = $('select[name="year2"] option:selected').val();
		if(year1 === '' || year2 === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/y.json", function( json ) {
	  		var url = '/xem-tuoi-xong-dat-nam-'+year2+'-'+json[year2]+'-cho-gia-chu-sinh-nam-'+year1;
			window.location.href = url;
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>