<!-- boi nhay mat -->
<div class="timebox">
	<p><label>Giờ nháy mắt:</label>{!! CommonOption::getListHour() !!}</p>
	<p><label>Vị trí nháy mắt:</label>{!! CommonOption::getListEyes() !!}</p>
	<p id="filterError"></p>
	<p><button id="filter33">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// boi nhay mat
	$('#filter33').click(function(){
		var hour = $('select[name="hour"] option:selected').val();
		var posEye = $('select[name="posEye"] option:selected').val();
		if(hour === '' || posEye === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/wink.json", function( json ) {
			$('#filterError').hide().fadeOut('fast');
	  		var string = '<p><strong>Kết quả:</strong> '+json[posEye][hour]+'</p>';
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>