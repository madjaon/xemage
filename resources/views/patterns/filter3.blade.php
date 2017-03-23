<!-- xem tuoi vo chong -->
<div class="timebox">
	<p><label>Năm sinh chồng (âm lịch):</label>{!! CommonOption::getListYear('year1', 2049, 1930) !!}</p>
	<p><label>Năm sinh vợ (âm lịch):</label>{!! CommonOption::getListYear('year2', 2049, 1930) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter3">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// xem tuoi vo chong
	$('#filter3').click(function(){
		var year2 = $('select[name="year2"] option:selected').val();
		var year1 = $('select[name="year1"] option:selected').val();
		if(year2 === '' || year1 === '') {
			$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
		}
		$.getJSON( "/js/cm.json", function( json ) {
			var year1Js = json[year1];
			var year2Js = json[year2];
			var resultText;
			var compareMenhResult = compareMenh(year1Js.hanh2, year2Js.hanh2, year1Js.menh, year2Js.menh, 1);
			var compareThiencanResult = compareThiencan(year1Js.thiencan, year2Js.thiencan, 1);
			var compareDiachiResult = compareDiachi(year1Js.diachi, year2Js.diachi, 1);
			var compareCungResult = compareCung(year1Js.namcung, year2Js.nucung, 1);
			var compareNienmenhResult = compareNienmenh(year1Js.nienmenhnam, year2Js.nienmenhnu, 1);
			var compareResult = parseInt(compareMenhResult) + parseInt(compareThiencanResult) + parseInt(compareDiachiResult) + parseInt(compareCungResult) + parseInt(compareNienmenhResult);
			if(compareResult <= 4) {
				resultText = '<p><strong style="width:40px;height:40px;border-radius:20px;background:#FF0000;text-align:center;line-height:40px;font-size:20px;color:#ffffff;display:inline-block;vertical-align:middle;">'+compareResult+'</strong> Hai bạn không hợp tuổi nhau</p>';
			} else if(compareResult <= 7) {
				resultText = '<p><strong style="width:40px;height:40px;border-radius:20px;background:#0000CC;text-align:center;line-height:40px;font-size:20px;color:#ffffff;display:inline-block;vertical-align:middle;">'+compareResult+'</strong> Hai bạn khá hợp tuổi nhau</p>';
			} else {
				resultText = '<p><strong style="width:40px;height:40px;border-radius:20px;background:#00CC66;text-align:center;line-height:40px;font-size:20px;color:#ffffff;display:inline-block;vertical-align:middle;">'+compareResult+'</strong> Hai bạn rất hợp tuổi nhau</p>';
			}
			var string = '<table style="width:100%;margin: 0 auto;text-align:center;"><tbody><tr><th>Tuổi chồng</th><th>Tuổi vợ</th></tr><tr><td>'
				+'<p><strong>Năm: </strong>'+year1+' - '+year1Js.tuoi+'</p>'
				+'<p><strong>Mệnh: </strong>'+year1Js.menh+' ('+year1Js.nghia+')</p>'
				+'<p><strong>Cung: </strong>'+year1Js.namcung+'</p>'
				+'<p><strong>Niên mệnh năm sinh: </strong>'+year1Js.nienmenhnam+'</p>'
				+'<p><strong>Hành: </strong>'+year1Js.hanh+'</p>'
				+'</td><td>'
				+'<p><strong>Năm: </strong>'+year2+' - '+year2Js.tuoi+'</p>'
				+'<p><strong>Mệnh: </strong>'+year2Js.menh+' ('+year2Js.nghia+')</p>'
				+'<p><strong>Cung: </strong>'+year2Js.nucung+'</p>'
				+'<p><strong>Niên mệnh năm sinh: </strong>'+year2Js.nienmenhnu+'</p>'
				+'<p><strong>Hành: </strong>'+year2Js.hanh+'</p>'
				+'</td></tr></tbody></table>'
				+'<h3 style="font-size:18px;">Luận giải xem bói tuổi chồng '+year1Js.tuoi+' vợ '+year2Js.tuoi+'</h3>'
				+'<table style="width:100%;margin: 0 auto;text-align:center;"><tbody><tr><td>'
				+'<p><strong>Về Mệnh</strong></p>'
				+'<p>'+year1Js.hanhmenh+' - '+year2Js.hanhmenh+' => '+compareMenh(year1Js.hanh2, year2Js.hanh2, year1Js.menh, year2Js.menh)+'</p>'
				+'</td></tr><tr><td><p><strong>Về Thiên can</strong></p>'
				+'<p>'+year1Js.thiencan+' - '+year2Js.thiencan+' => '+compareThiencan(year1Js.thiencan, year2Js.thiencan)+'</p>'
				+'</td></tr><tr><td><p><strong>Về Địa chi</strong></p>'
				+'<p>'+year1Js.diachi+' - '+year2Js.diachi+' => '+compareDiachi(year1Js.diachi, year2Js.diachi)+'</p>'
				+'</td></tr><tr><td><p><strong>Về Cung</strong></p>'
				+'<p>'+year1Js.namcung+' - '+year2Js.nucung+' => '+compareCung(year1Js.namcung, year2Js.nucung)+'</p>'
				+'</td></tr><tr><td><p><strong>Về niên mệnh năm sinh</strong></p>'
				+'<p>'+year1Js.nienmenhnam+' - '+year2Js.nienmenhnu+' => '+compareNienmenh(year1Js.nienmenhnam, year2Js.nienmenhnu)+'</p>'
				+'</td></tr><tr><td><p><strong>KẾT QUẢ</strong></p>'+resultText
				+'</td></tr></tbody></table>';
	  		$('#filterResult').html(string);
		})
		.fail(function() {
			$('#filterError').html('Dữ liệu đang được cập nhật');
		});
	});
</script>