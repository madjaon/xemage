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
<script>
	// dat ten con theo ngu hanh
	$('#filter4').click(function(){
		var hanh = $('select[name="hanh"] option:selected').val();
		if(hanh === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/dat-ten-con-theo-hanh-'+hanh;
		window.location.href = url;
	});
</script>