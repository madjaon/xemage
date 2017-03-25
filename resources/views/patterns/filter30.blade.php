<!-- boi not ruoi co the nu -->
<div class="timebox">
	<p><img src="{{ url('/img/xem-boi-not-ruoi-tren-co-the-phu-nu.jpg') }}" alt="Bói nốt ruồi trên cơ thể phụ nữ"></p>
	<p><label>Vị trí nốt ruồi:</label>{!! CommonOption::getListSelectOption('pos', 20, 1) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter30">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// boi not ruoi co the nu
	$('#filter30').click(function(){
		var pos = $('select[name="pos"] option:selected').val();
		if(pos === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
		}
		$.getJSON( "/js/mole.json", function( json ) {
	  		var string = '<p><strong>Kết quả:</strong> '+json['bodywoman'][pos]+'</p>';
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
	});
</script>