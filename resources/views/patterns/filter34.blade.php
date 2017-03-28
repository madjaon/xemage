<!-- diem bao lanh du -->
<div class="timebox">
	<p><label>Giờ:</label>{!! CommonOption::getListHour() !!}</p>
	<p><label>Điềm báo:</label>{!! CommonOption::getListBode() !!}</p>
	<p id="filterError"></p>
	<p><button id="filter34">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// diem bao lanh du
	$('#filter34').click(function(){
		var hour = $('select[name="hour"] option:selected').val();
		var bode = $('select[name="bode"] option:selected').val();
		if(hour === '' || bode === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/bode.json", function( json ) {
			$('#filterError').hide().fadeOut('fast');
	  		var string = '<p><strong>Kết quả:</strong> '+json[bode][hour]+'</p>';
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>