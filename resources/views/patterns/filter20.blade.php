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
			$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
		}
		$.getJSON( "/js/cm.json", function( json ) {
			var yearJs = json[year];
			var string = '<p><label>Năm sinh:</label>'+year+' ('+yearJs.tuoi+')</p><p><label>Mệnh:</label>'+yearJs.menh+' ('+yearJs.nghia+')</p><p><label>Cung (nam giới):</label>'+yearJs.cungnam+'</p><p><label>Cung (nữ giới):</label>'+yearJs.cungnu+'</p><p><label>Hành:</label>'+yearJs.hanh+'</p>';
	  		$('#filterResult').html(string);
		})
		.fail(function() {
			$('#filterError').html('Dữ liệu đang được cập nhật');
		});
	});
</script>