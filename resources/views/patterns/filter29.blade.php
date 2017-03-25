<!-- boi not ruoi co the nam -->
<div class="timebox">
	<p><img src="{{ url('/img/xem-boi-not-ruoi-tren-co-the-dan-ong.jpg') }}" alt="Bói nốt ruồi trên cơ thể đàn ông"></p>
	<p><label>Vị trí nốt ruồi:</label>{!! CommonOption::getListSelectOption('pos', 37, 1) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter29">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// boi not ruoi co the nam
	$('#filter29').click(function(){
		var pos = $('select[name="pos"] option:selected').val();
		if(pos === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
		}
		$.getJSON( "/js/mole.json", function( json ) {
	  		var string = '<p><strong>Kết quả:</strong> '+json['bodyman'][pos]+'</p>';
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
	});
</script>