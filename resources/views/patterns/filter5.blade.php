<!-- Quy Coc Toan Menh -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 2) {
		$cannamsinh = $slugCharacter[count($slugCharacter)-2];
		$cangiosinh = $slugCharacter[count($slugCharacter)-1];
	} else {
		$cannamsinh = 'giap';
		$cangiosinh = 'giap';
	}
?>
<div class="timebox">
	<p><label>Can của năm sinh (âm lịch):</label>{!! CommonOption::getListCan('cannamsinh', $cannamsinh) !!}</p>
	<p><label>Can của giờ sinh:</label>{!! CommonOption::getListCan('cangiosinh', $cangiosinh) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter5">Xem kết quả</button></p>
</div>
<script>
	// quy coc toan menh
	$('#filter5').click(function(){
		var cannamsinh = $('select[name="cannamsinh"] option:selected').val();
		var cangiosinh = $('select[name="cangiosinh"] option:selected').val();
		if(cannamsinh === '' || cangiosinh === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/quy-coc-toan-menh-'+cannamsinh+'-'+cangiosinh;
		window.location.href = url;
	});
</script>