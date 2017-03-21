// tu vi tron doi theo gioi tinh va nam sinh
$('#filter1').click(function(){
	var year = $('select[name="year"] option:selected').val();
	var sex = $('input[name="sex"]:checked').val();
	if(year === '' || sex === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	$.getJSON( "/js/y.json", function( json ) {
		var sextext = '';
		if(sex === '2') {
			sextext = '-nu-mang';
		} else {
			sextext = '-nam-mang';
		}
  		var url = '/xem-tu-vi-tron-doi-tuoi-'+json[year]+sextext;
  		window.location.href = url;
	})
	.fail(function() {
		$('#filterError').html('Dữ liệu đang được cập nhật');
	});
});
// dat ten con theo ngu hanh
$('#filter4').click(function(){
	var hanh = $('select[name="hanh"] option:selected').val();
	if(hanh === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/dat-ten-con-theo-hanh-'+hanh;
	window.location.href = url;
});
// quy coc toan menh
$('#filter5').click(function(){
	var cannamsinh = $('select[name="cannamsinh"] option:selected').val();
	var cangiosinh = $('select[name="cangiosinh"] option:selected').val();
	if(cannamsinh === '' || cangiosinh === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/quy-coc-toan-menh-'+cannamsinh+'-'+cangiosinh;
	window.location.href = url;
});
// xem tuoi ket hon
$('#filter6').click(function(){
	var year = $('select[name="year"] option:selected').val();
	var sex = $('input[name="sex"]:checked').val();
	if(year === '' || sex === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	if(sex === '2') {
		sextext = 'nu';
	} else {
		sextext = 'nam';
	}
	var url = '/xem-tuoi-ket-hon-'+sextext+'-sinh-nam-'+year;
	window.location.href = url;
});
// Cao ly đầu hình
$('#filter7').click(function(){
	var can = $('select[name="can"] option:selected').val();
	var chi = $('select[name="chi"] option:selected').val();
	if(can === '' || chi === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/cao-ly-dau-hinh-chong-can-'+can+'-vo-chi-'+chi;
	window.location.href = url;
});
// xem ngay cuoi hoi
$('#filter8').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-cuoi-hoi-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay hoang dao
$('#filter9').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-hoang-dao-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay lam nha
$('#filter10').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-lam-nha-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay nhap trach
$('#filter11').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-nhap-trach-ve-nha-moi-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay khai truong
$('#filter12').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-khai-truong-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay tu tao sua chua
$('#filter13').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-tu-tao-sua-chua-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem tuoi ket hon
$('#filter14').click(function(){
	var year = $('select[name="year"] option:selected').val();
	var sex = $('input[name="sex"]:checked').val();
	if(year === '' || sex === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	if(sex === '2') {
		sextext = 'nu';
	} else {
		sextext = 'nam';
	}
	var url = '/xem-mau-sac-hop-tuoi-cho-'+sextext+'-sinh-nam-'+year;
	window.location.href = url;
});
// xem huong nha tot
$('#filter15').click(function(){
	var year = $('select[name="year"] option:selected').val();
	var sex = $('input[name="sex"]:checked').val();
	if(year === '' || sex === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	if(sex === '2') {
		sextext = 'nu';
	} else {
		sextext = 'nam';
	}
	var url = '/xem-huong-nha-tot-cho-'+sextext+'-sinh-nam-'+year;
	window.location.href = url;
});
// xem ngay chon cat
$('#filter16').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-chon-cat-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay hac dao ngay xau
$('#filter17').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-hac-dao-ngay-xau-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem ngay bat tuong
$('#filter18').click(function(){
	var month = $('select[name="month"] option:selected').val();
	var year = $('select[name="year"] option:selected').val();
	if(month === '' || year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-ngay-bat-tuong-thang-'+month+'-nam-'+year;
	window.location.href = url;
});
// xem tu vi gio sinh
$('#filter19').click(function(){
	var hour = $('select[name="hour"] option:selected').val();
	if(hour === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/xem-tu-vi-theo-gio-sinh-cho-ban-sinh-gio-'+hour;
	window.location.href = url;
});
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
// bang tinh tam tai hoang oc kim lau
$('#filter21').click(function(){
	var year = $('select[name="year"] option:selected').val();
	if(year === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	var url = '/bang-tinh-tam-tai-hoang-oc-kim-lau-nam-'+year;
	window.location.href = url;
});
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
function compareMenh(y1, y2, m1, m2, calc) {
	if((y1 === 'Kim' && y2 === 'Thuỷ') || (y1 === 'Kim' && y2 === 'Thổ') || (y1 === 'Thuỷ' && y2 === 'Mộc')|| (y1 === 'Thuỷ' && y2 === 'Kim')|| (y1 === 'Mộc' && y2 === 'Hỏa')|| (y1 === 'Mộc' && y2 === 'Thuỷ')|| (y1 === 'Hỏa' && y2 === 'Thổ')|| (y1 === 'Hỏa' && y2 === 'Mộc')|| (y1 === 'Thổ' && y2 === 'Hỏa')|| (y1 === 'Thổ' && y2 === 'Kim')) {
		if(calc) { return 2; }
		return '<strong style="color:#00CC66">Tương sinh</strong>';
	} else if((y1 === 'Kim' && y2 === 'Hỏa') || (y1 === 'Kim' && y2 === 'Mộc') || (y1 === 'Thuỷ' && y2 === 'Thổ')|| (y1 === 'Thuỷ' && y2 === 'Hỏa')|| (y1 === 'Mộc' && y2 === 'Kim')|| (y1 === 'Mộc' && y2 === 'Thổ')|| (y1 === 'Hỏa' && y2 === 'Kim')|| (y1 === 'Hỏa' && y2 === 'Thuỷ')|| (y1 === 'Thổ' && y2 === 'Thuỷ')|| (y1 === 'Thổ' && y2 === 'Mộc')) {
		if(calc) { return 0; }
		// cac truong hop ngoai le, khac nhung lai tot
		if(((y1 === 'Kim' && y2 === 'Hỏa') && (m1 === 'Kiếm phong kim' || m1 === 'Sa trung kim')) || ((y1 === 'Hỏa' && y2 === 'Kim') && (m2 === 'Kiếm phong kim' || m2 === 'Sa trung kim'))) {
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Kim là Kiếm phong kim hoặc Sa trung kim</span>';
		}
		if(((y1 === 'Hỏa' && y2 === 'Thủy') && (m1 === 'Thiên thượng hỏa' || m1 === 'Sơn hạ hỏa' || m1 === 'Tích Lịch Hỏa')) || ((y1 === 'Thủy' && y2 === 'Hỏa') && (m2 === 'Thiên thượng hỏa' || m2 === 'Sơn hạ hỏa' || m2 === 'Tích Lịch Hỏa'))) {
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Hỏa là Thiên thượng hỏa hoặc Sơn hạ hỏa hoặc Tích Lịch Hỏa</span>';
		}
		if(((y1 === 'Mộc' && y2 === 'Kim') && (m1 === 'Bình địa mộc')) || ((y1 === 'Kim' && y2 === 'Mộc') && (m2 === 'Bình địa mộc'))) {
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Mộc là Bình địa mộc</span>';
		}
		if(((y1 === 'Thủy' && y2 === 'Thổ') && (m1 === 'Đại hải thủy' || m1 === 'Thiên hà thủy')) || ((y1 === 'Thổ' && y2 === 'Thủy') && (m2 === 'Đại hải thủy' || m2 === 'Thiên hà thủy'))) {
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Thủy là Đại hải thủy hoặc Thiên hà thủy</span>';
		}
		if(((y1 === 'Thổ' && y2 === 'Mộc') && (m1 === 'Lộ bàng thổ' || m1 === 'Đại dịch thổ' || m1 === 'Sa trung thổ')) || ((y1 === 'Mộc' && y2 === 'Thổ') && (m2 === 'Lộ bàng thổ' || m2 === 'Đại dịch thổ' || m2 === 'Sa trung thổ'))) {
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Thổ là Lộ bàng thổ hoặc Đại dịch thổ hoặc Sa trung thổ</span>';
		}
		return '<strong style="color:#FF0066">Tương khắc</strong>';
	} else {
		if(calc) { return 1; }
		return '<strong style="color:#0000CC">Bình</strong>';
	}
}
function compareThiencan(t1, t2, calc) {
	var t = [t1, t2];
	if(t1 !== t2) {
		if((is_equal(t, ['Giáp', 'Bính'])) || (is_equal(t, ['Ất', 'Đinh'])) ||(is_equal(t, ['Bính', 'Mậu'])) || (is_equal(t, ['Đinh', 'Kỷ'])) ||(is_equal(t, ['Mậu', 'Canh'])) || (is_equal(t, ['Kỷ', 'Tân'])) || (is_equal(t, ['Canh', 'Nhâm'])) || (is_equal(t, ['Tân', 'Quý'])) || (is_equal(t, ['Nhâm', 'Giáp'])) || (is_equal(t, ['Quý', 'Ất']))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Sinh</strong>';
		}
		else if((is_equal(t, ['Giáp', 'Kỷ'])) || (is_equal(t, ['Ất', 'Canh'])) ||(is_equal(t, ['Bính', 'Tân'])) || (is_equal(t, ['Đinh', 'Nhâm'])) ||(is_equal(t, ['Mậu', 'Quý'])) || (is_equal(t, ['Kỷ', 'Giáp'])) || (is_equal(t, ['Canh', 'Ất'])) || (is_equal(t, ['Tân', 'Bính'])) || (is_equal(t, ['Nhâm', 'Đinh'])) || (is_equal(t, ['Quý', 'Mậu']))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Hợp</strong>';
		}
		else if((is_equal(t, ['Giáp', 'Mậu'])) || (is_equal(t, ['Ất', 'Kỷ'])) ||(is_equal(t, ['Bính', 'Canh'])) || (is_equal(t, ['Đinh', 'Tân'])) ||(is_equal(t, ['Mậu', 'Nhâm'])) || (is_equal(t, ['Kỷ', 'Quý'])) || (is_equal(t, ['Canh', 'Giáp'])) || (is_equal(t, ['Tân', 'Ất'])) || (is_equal(t, ['Nhâm', 'Bính'])) || (is_equal(t, ['Quý', 'Đinh']))) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Khắc</strong>';
		}
		else if((is_equal(t, ['Giáp', 'Canh'])) || (is_equal(t, ['Ất', 'Tân'])) ||(is_equal(t, ['Bính', 'Nhâm'])) || (is_equal(t, ['Đinh', 'Quý'])) ||(is_equal(t, ['Mậu', 'Giáp'])) || (is_equal(t, ['Kỷ', 'Ất'])) || (is_equal(t, ['Canh', 'Bính'])) || (is_equal(t, ['Tân', 'Đinh'])) || (is_equal(t, ['Nhâm', 'Mậu'])) || (is_equal(t, ['Quý', 'Kỷ']))) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Xung</strong>';
		}
		else {
			if(calc) { return 1; }
			return '<strong style="color:#0000CC">Bình</strong>';
		}
	} else {
		if(calc) { return 1; }
		return '<strong style="color:#0000CC">Bình</strong>';
	}
}
function compareDiachi(d1, d2, calc) {
	var d = [d1, d2];
	if(d1 !== d2) {
		if((contains(d1, ['Thân', 'Tý', 'Thìn']) && contains(d2, ['Thân', 'Tý', 'Thìn'])) || (contains(d1, ['Tỵ', 'Dậu', 'Sửu']) && contains(d2, ['Tỵ', 'Dậu', 'Sửu'])) || (contains(d1, ['Dần', 'Ngọ', 'Tuất']) && contains(d2, ['Dần', 'Ngọ', 'Tuất'])) || (contains(d1, ['Hợi', 'Mão', 'Mùi']) && contains(d2, ['Hợi', 'Mão', 'Mùi'])) ) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Tam hợp</strong><br><span>Số mệnh xum vầy thuận thảo, phát đạt bền vững</span>';
		}
		if((isEqual(d, ['Tý', 'Sửu'])) || (isEqual(d, ['Tỵ', 'Thân'])) || (isEqual(d, ['Thìn', 'Dậu'])) || (isEqual(d, ['Mão', 'Tuất'])) || (isEqual(d, ['Dần', 'Hợi'])) || (isEqual(d, ['Ngọ', 'Mùi'])) ) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Lục hợp</strong><br><span>Hai tuổi này kết hợp với nhau được xem như đại lợi, đại hợp. Trong việc kết hôn nên chọn những người cùng trong cặp Tam hợp hoặc Lục hợp để tránh những điều không tốt.</span>';
		}
		if((isEqual(d, ['Tý', 'Ngọ'])) || (isEqual(d, ['Tỵ', 'Hợi'])) || (isEqual(d, ['Dần', 'Thân'])) || (isEqual(d, ['Mão', 'Dậu'])) || (isEqual(d, ['Thìn', 'Tuất'])) || (isEqual(d, ['Sửu', 'Mùi'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Lục xung</strong><br><span>Theo người phương Đông cổ xưa việc cưới hỏi cần phải tránh các cặp xung – hại – tuyệt bởi vì các cặp đó ấy sớm muộn sẽ gặp họa không gia đạo bất hòa, thì công danh trắc trở, bệnh tật tiêu hao tiền của.</span>';
		}
		if((isEqual(d, ['Tý', 'Mùi'])) || (isEqual(d, ['Mão', 'Thìn'])) || (isEqual(d, ['Sửu', 'Ngọ'])) || (isEqual(d, ['Thân', 'Hợi'])) || (isEqual(d, ['Dần', 'Tỵ'])) || (isEqual(d, ['Dậu', 'Tuất'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Lục hại</strong><br><span>Theo người phương Đông cổ xưa việc cưới hỏi cần phải tránh các cặp xung – hại – tuyệt bởi vì các cặp đó ấy sớm muộn sẽ gặp họa không gia đạo bất hòa, thì công danh trắc trở, bệnh tật tiêu hao tiền của.</span>';
		}
		if((isEqual(d, ['Tý', 'Tỵ'])) || (isEqual(d, ['Ngọ', 'Hợi'])) || (isEqual(d, ['Dậu', 'Dần'])) || (isEqual(d, ['Mão', 'Thân'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Tứ tuyệt</strong><br><span>Theo người phương Đông cổ xưa việc cưới hỏi cần phải tránh các cặp xung – hại – tuyệt bởi vì các cặp đó ấy sớm muộn sẽ gặp họa không gia đạo bất hòa, thì công danh trắc trở, bệnh tật tiêu hao tiền của.</span>';
		}
		else {
			if(calc) { return 1; }
			return '<strong style="color:#0000CC">Bình</strong>';
		}
	} else {
		if(calc) { return 1; }
		return '<strong style="color:#0000CC">Bình</strong>';
	}
}
function compareCung(c1, c2, calc) {
	var c = [c1, c2];
	if(c1 !== c2) {
		if((isEqual(c, ['Càn', 'Khảm'])) || (isEqual(c, ['Cấn', 'Chấn'])) || (isEqual(c, ['Tốn', 'Đoài'])) || (isEqual(c, ['Ly', 'Khôn'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Lục sát</strong><br><span>Nhà có sát khí</span';
		}
		if((isEqual(c, ['Càn', 'Cấn'])) || (isEqual(c, ['Khảm', 'Chấn'])) || (isEqual(c, ['Tốn', 'Ly'])) || (isEqual(c, ['Khôn', 'Đoài'])) ) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Thiên y</strong><br><span>Gặp thiên thời được che chở</span';
		}
		if((isEqual(c, ['Càn', 'Chấn'])) || (isEqual(c, ['Khảm', 'Cấn'])) || (isEqual(c, ['Tốn', 'Khôn'])) || (isEqual(c, ['Ly', 'Đoài'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Ngũ quỷ</strong><br><span>Gặp tai hoạ</span';
		}
		if((isEqual(c, ['Càn', 'Tốn'])) || (isEqual(c, ['Khảm', 'Đoài'])) || (isEqual(c, ['Cấn', 'Ly'])) || (isEqual(c, ['Chấn', 'Khôn'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Họa hại</strong><br><span>Nhà có hung khí</span';
		}
		if((isEqual(c, ['Càn', 'Đoài'])) || (isEqual(c, ['Khảm', 'Tốn'])) || (isEqual(c, ['Cấn', 'Khôn'])) || (isEqual(c, ['Chấn', 'Ly'])) ) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Sanh khí</strong><br><span>Phúc lộc vẹn toàn</span';
		}
		if((isEqual(c, ['Càn', 'Ly'])) || (isEqual(c, ['Khảm', 'Khôn'])) || (isEqual(c, ['Cấn', 'Tốn'])) || (isEqual(c, ['Chấn', 'Đoài'])) ) {
			if(calc) { return 0; }
			return '<strong style="color:#FF0066">Tuyệt mệnh</strong><br><span>Chết chóc</span';
		}
		if((isEqual(c, ['Càn', 'Khôn'])) || (isEqual(c, ['Khảm', 'Ly'])) || (isEqual(c, ['Cấn', 'Đoài'])) || (isEqual(c, ['Chấn', 'Tốn'])) ) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Diên niên</strong><br><span>Mọi sự ổn định</span';
		}
	} else {
		if(calc) { return 2; }
		return '<strong style="color:#00CC66">Phục vị</strong><br><span>Được sự giúp đỡ</span';
	}
}
function compareNienmenh(y1, y2, calc) {
	var y = [y1, y2];
	if(isEqual(y, ['Kim', 'Thuỷ']) || isEqual(y, ['Kim' , 'Thổ']) || isEqual(y, ['Thuỷ', 'Mộc'])|| isEqual(y, ['Mộc', 'Hỏa'])|| isEqual(y, ['Hỏa', 'Thổ']) ) {
		if(calc) { return 2; }
		return '<strong style="color:#00CC66">Tương sinh</strong>';
	} else if(isEqual(y, ['Kim', 'Hỏa']) || isEqual(y, ['Kim' , 'Mộc']) || isEqual(y, ['Thuỷ', 'Thổ'])|| isEqual(y, ['Thuỷ', 'Hỏa'])|| isEqual(y, ['Mộc', 'Thổ']) ) {
		if(calc) { return 0; }
		return '<strong style="color:#FF0066">Tương khắc</strong>';
	} else {
		if(calc) { return 1; }
		return '<strong style="color:#0000CC">Bình</strong>';
	}
}
function is_equal(array1, array2) {
    /* WARNING: arrays must not contain {objects} or behavior may be undefined */
    return JSON.stringify(array1)==JSON.stringify(array2);
}
// equal no care position index
function isEqual(array1, array2) {
	return array1.length==array2.length && array1.every(function(v,i) { return ($.inArray(v,array2) != -1)});
}
function contains(value, array) {
    for (var i = 0; i < array.length; i++) {
        if (array[i] === value) {
            return true;
        }
    }
    return false;
}
// xem hop tuoi
$('#filter2').click(function(){
	var year2 = $('select[name="year2"] option:selected').val();
	var year1 = $('select[name="year1"] option:selected').val();
	var sex2 = $('input[name="sex2"]:checked').val();
	var sex1 = $('input[name="sex1"]:checked').val();
	if(year2 === '' || year1 === '' || sex2 === '' || sex1 === '') {
		$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
	}
	$.getJSON( "/js/cm.json", function( json ) {
		var year1Js = json[year1];
		var year2Js = json[year2];
		if(sex2 === '2') {
			sextext2 = 'Nữ';
			var cung2 = year2Js.nucung
			var nienmenh2 = year2Js.nienmenhnu
		} else {
			sextext2 = 'Nam';
			var cung2 = year2Js.namcung;
			var nienmenh2 = year2Js.nienmenhnam;
		}
		if(sex1 === '2') {
			sextext1 = 'Nữ';
			var cung1 = year1Js.nucung
			var nienmenh1 = year1Js.nienmenhnu
		} else {
			sextext1 = 'Nam';
			var cung1 = year1Js.namcung;
			var nienmenh1 = year1Js.nienmenhnam;
		}
		var resultText;
		var compareMenhResult = compareMenh(year1Js.hanh2, year2Js.hanh2, year1Js.menh, year2Js.menh, 1);
		var compareThiencanResult = compareThiencan(year1Js.thiencan, year2Js.thiencan, 1);
		var compareDiachiResult = compareDiachi(year1Js.diachi, year2Js.diachi, 1);
		var compareCungResult = compareCung(cung1, cung2, 1);
		var compareNienmenhResult = compareNienmenh(nienmenh1, nienmenh2, 1);
		var compareResult = parseInt(compareMenhResult) + parseInt(compareThiencanResult) + parseInt(compareDiachiResult) + parseInt(compareCungResult) + parseInt(compareNienmenhResult);
		if(compareResult <= 4) {
			resultText = '<p><strong style="width:40px;height:40px;border-radius:20px;background:#FF0000;text-align:center;line-height:40px;font-size:20px;color:#ffffff;display:inline-block;vertical-align:middle;">'+compareResult+'</strong> Hai bạn không hợp tuổi nhau</p>';
		} else if(compareResult <= 7) {
			resultText = '<p><strong style="width:40px;height:40px;border-radius:20px;background:#0000CC;text-align:center;line-height:40px;font-size:20px;color:#ffffff;display:inline-block;vertical-align:middle;">'+compareResult+'</strong> Hai bạn khá hợp tuổi nhau</p>';
		} else {
			resultText = '<p><strong style="width:40px;height:40px;border-radius:20px;background:#00CC66;text-align:center;line-height:40px;font-size:20px;color:#ffffff;display:inline-block;vertical-align:middle;">'+compareResult+'</strong> Hai bạn rất hợp tuổi nhau</p>';
		}
		var string = '<table style="width:100%;margin: 0 auto;text-align:center;"><tbody><tr><th>Tuổi bạn</th><th>Tuổi người kia</th></tr><tr><td>'
			+'<p><strong>Năm: </strong>'+year1+' - '+year1Js.tuoi+'</p>'
			+'<p><strong>Mệnh: </strong>'+year1Js.menh+' ('+year1Js.nghia+')</p>'
			+'<p><strong>Cung: </strong>'+cung1+'</p>'
			+'<p><strong>Niên mệnh năm sinh: </strong>'+nienmenh1+'</p>'
			+'<p><strong>Hành: </strong>'+year1Js.hanh+'</p>'
			+'<p><strong>Giới tính: </strong>'+sextext1+'</p>'
			+'</td><td>'
			+'<p><strong>Năm: </strong>'+year2+' - '+year2Js.tuoi+'</p>'
			+'<p><strong>Mệnh: </strong>'+year2Js.menh+' ('+year2Js.nghia+')</p>'
			+'<p><strong>Cung: </strong>'+cung2+'</p>'
			+'<p><strong>Niên mệnh năm sinh: </strong>'+nienmenh2+'</p>'
			+'<p><strong>Hành: </strong>'+year2Js.hanh+'</p>'
			+'<p><strong>Giới tính: </strong>'+sextext2+'</p>'
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
			+'<p>'+cung1+' - '+cung2+' => '+compareCung(cung1, cung2)+'</p>'
			+'</td></tr><tr><td><p><strong>Về niên mệnh năm sinh</strong></p>'
			+'<p>'+nienmenh1+' - '+nienmenh2+' => '+compareNienmenh(nienmenh1, nienmenh2)+'</p>'
			+'</td></tr><tr><td><p><strong>KẾT QUẢ</strong></p>'+resultText
			+'</td></tr></tbody></table>';
  		$('#filterResult').html(string);
	})
	.fail(function() {
		$('#filterError').html('Dữ liệu đang được cập nhật');
	});
});
