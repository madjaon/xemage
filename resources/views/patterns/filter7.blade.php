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
<script>
	// Cao ly đầu hình
	$('#filter7').click(function(){
		var can = $('select[name="can"] option:selected').val();
		var chi = $('select[name="chi"] option:selected').val();
		if(can === '' || chi === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/cao-ly-dau-hinh-chong-can-'+can+'-vo-chi-'+chi;
		window.location.href = url;
	});
</script>