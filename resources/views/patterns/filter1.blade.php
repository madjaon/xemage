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
<script>
	// tu vi tron doi theo gioi tinh va nam sinh
	$('#filter1').click(function(){
		var year = $('select[name="year"] option:selected').val();
		var sex = $('input[name="sex"]:checked').val();
		if(year === '' || sex === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/y.json", function( json ) {
			var sextext = '';
			if(sex === '2') {
				sextext = '-nu-mang';
			} else {
				sextext = '-nam-mang';
			}
	  		var url = '/xem-tu-vi-tron-doi-tuoi-'+json[year]+sextext;
	  		window.location.href = url;
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>