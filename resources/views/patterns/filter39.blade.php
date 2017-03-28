<!-- bang xep hang 12 chom sao -->
<div class="timebox">
	<p><label>Chọn đặc điểm cần xếp hạng:</label>{!! CommonOption::getListZodiacRank() !!}</p>
	<p id="filterError"></p>
	<p><button id="filter39">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// bang xep hang 12 chom sao
	$('#filter39').click(function(){
		var zodiacRank = $('select[name="zodiacRank"] option:selected').val();
		if(zodiacRank === '') {
			$('#filterError').hide().html('Mời bạn nhập đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/z.json", function( json ) {
			$('#filterError').hide().fadeOut('fast');
	  		var string = '<p><strong>Kết quả:</strong></p>'+json[zodiacRank];
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>