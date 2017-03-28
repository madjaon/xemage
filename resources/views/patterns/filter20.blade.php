<!-- xem cung menh -->
<div class="timebox">
	<p><label>Năm sinh (âm lịch):</label>{!! CommonOption::getListYear('year', 2049, 1930) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter20">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// xem cung menh theo nam sinh
	$('#filter20').click(function(){
		var year = $('select[name="year"] option:selected').val();
		if(year === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.getJSON( "/js/cm.json", function( json ) {
			$('#filterError').hide().fadeOut('fast');
			var yearJs = json[year];
			var string = '<p><label>Năm sinh:</label>'+year+' ('+yearJs.tuoi+')</p><p><label>Mệnh:</label>'+yearJs.menh+' ('+yearJs.nghia+')</p><p><label>Cung (nam giới):</label>'+yearJs.cungnam+'</p><p><label>Cung (nữ giới):</label>'+yearJs.cungnu+'</p><p><label>Hành:</label>'+yearJs.hanh+'</p>';
	  		$('#filterResult').hide().html(string).fadeIn('fast');
		})
		.fail(function() {
			$('#filterError').hide().html('Dữ liệu đang được cập nhật').fadeIn('fast');
		});
		return;
	});
</script>