<!-- xem cung hoang dao -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 2) {
		$zodiac1 = $slugCharacter[count($slugCharacter)-1];
		$zodiac2 = $slugCharacter[count($slugCharacter)-2];
		if(!isset($zodiac1) || !isset($zodiac2)) {
			$zodiac = 'ma-ket';
		} else {
			$zodiac = $zodiac2 . '-' . $zodiac1;
		}
	} else {
		$zodiac = 'ma-ket';
	}
?>
<div class="timebox">
	<p><label>Chọn cung hoàng đạo của bạn:</label>{!! CommonOption::getListZodiac('zodiac', $zodiac) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter37">Xem kết quả</button></p>
</div>
<script>
	// xem cung hoang dao
	$('#filter37').click(function(){
		var zodiac = $('select[name="zodiac"] option:selected').val();
		if(zodiac === '') {
			$('#filterError').hide().html('Mời bạn nhập đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/xem-cung-hoang-dao-cung-'+zodiac;
		window.location.href = url;
	});
</script>