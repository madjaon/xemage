<!-- xem tu vi gio sinh -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 0) {
		$hour = $slugCharacter[count($slugCharacter)-1];
	} else {
		$hour = 'ty';
	}
?>
<div class="timebox">
	<p><label>Giờ sinh:</label>{!! CommonOption::getListHour('hour', $hour) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter19">Xem kết quả</button></p>
</div>
<script>
	// xem tu vi gio sinh
	$('#filter19').click(function(){
		var hour = $('select[name="hour"] option:selected').val();
		if(hour === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		var url = '/xem-tu-vi-theo-gio-sinh-cho-ban-sinh-gio-'+hour;
		window.location.href = url;
	});
</script>