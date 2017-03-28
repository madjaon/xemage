<!-- boi tinh yeu theo nhom mau -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$blood1 = $slugCharacter[count($slugCharacter)-3];
		if(!isset($blood1)) {
			$blood1 = 'a';
		}
		$blood2 = $slugCharacter[count($slugCharacter)-1];
		if(!isset($blood2)) {
			$blood2 = 'a';
		}
	} else {
		$blood1 = 'a';
		$blood2 = 'a';
	}
?>
<div class="timebox">
	<p><label>Nhóm máu nam:</label>{!! CommonOption::getListBlood('blood1', $blood1) !!}</p>
	<p><label>Nhóm máu nữ:</label>{!! CommonOption::getListBlood('blood2', $blood2) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter32">Xem kết quả</button></p>
</div>
<script>
	// boi tinh yeu theo nhom mau
	$('#filter32').click(function(){
		var blood1 = $('select[name="blood1"] option:selected').val();
		var blood2 = $('select[name="blood2"] option:selected').val();
		if(blood1 === '' || blood2 === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/xem-boi-tinh-yeu-theo-nhom-mau-'+blood1+'-va-'+blood2;
		window.location.href = url;
	});
</script>