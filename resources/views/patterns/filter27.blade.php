<!-- boi not ruoi mat nam -->
<div class="timebox">
	<p><img src="{{ url('/img/xem-boi-not-ruoi-tren-mat-dan-ong.jpg') }}" alt="Bói nốt ruồi trên mặt đàn ông"></p>
	<p><label>Vị trí nốt ruồi:</label>{!! CommonOption::getListSelectOption('pos', 41, 1) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter27">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// boi not ruoi mat nam
	$('#filter27').click(function(){
		var pos = $('select[name="pos"] option:selected').val();
		if(pos === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/mole.json", function( json ) {
			$('#filterError').hide().fadeOut('fast');
	  		var string = '<p><strong>Kết quả:</strong> '+json['faceman'][pos]+'</p>';
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>