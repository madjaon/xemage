<!-- tinh yeu cua cung hoang dao -->
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
	<p><button id="filter38">Xem kết quả</button></p>
</div>
<script>
	// tinh yeu cua cung hoang dao
	$('#filter38').click(function(){
		var zodiac = $('select[name="zodiac"] option:selected').val();
		if(zodiac === '') {
			$('#filterError').hide().html('Mời bạn nhập đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/tinh-yeu-cua-cung-hoang-dao-'+zodiac;
		window.location.href = url;
	});
</script>