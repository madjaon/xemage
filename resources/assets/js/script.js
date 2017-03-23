function compareMenh(y1, y2, m1, m2, calc) {
	if((y1 === 'Kim' && y2 === 'Thuỷ') || (y1 === 'Kim' && y2 === 'Thổ') || (y1 === 'Thuỷ' && y2 === 'Mộc')|| (y1 === 'Thuỷ' && y2 === 'Kim')|| (y1 === 'Mộc' && y2 === 'Hỏa')|| (y1 === 'Mộc' && y2 === 'Thuỷ')|| (y1 === 'Hỏa' && y2 === 'Thổ')|| (y1 === 'Hỏa' && y2 === 'Mộc')|| (y1 === 'Thổ' && y2 === 'Hỏa')|| (y1 === 'Thổ' && y2 === 'Kim')) {
		if(calc) { return 2; }
		return '<strong style="color:#00CC66">Tương sinh</strong>';
	} else if((y1 === 'Kim' && y2 === 'Hỏa') || (y1 === 'Kim' && y2 === 'Mộc') || (y1 === 'Thuỷ' && y2 === 'Thổ')|| (y1 === 'Thuỷ' && y2 === 'Hỏa')|| (y1 === 'Mộc' && y2 === 'Kim')|| (y1 === 'Mộc' && y2 === 'Thổ')|| (y1 === 'Hỏa' && y2 === 'Kim')|| (y1 === 'Hỏa' && y2 === 'Thuỷ')|| (y1 === 'Thổ' && y2 === 'Thuỷ')|| (y1 === 'Thổ' && y2 === 'Mộc')) {
		// cac truong hop ngoai le, khac nhung lai tot
		if(((y1 === 'Kim' && y2 === 'Hỏa') && (m1 === 'Kiếm phong kim' || m1 === 'Sa trung kim')) || ((y1 === 'Hỏa' && y2 === 'Kim') && (m2 === 'Kiếm phong kim' || m2 === 'Sa trung kim'))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Kim là Kiếm phong kim hoặc Sa trung kim</span>';
		}
		if(((y1 === 'Hỏa' && y2 === 'Thủy') && (m1 === 'Thiên thượng hỏa' || m1 === 'Sơn hạ hỏa' || m1 === 'Tích Lịch Hỏa')) || ((y1 === 'Thủy' && y2 === 'Hỏa') && (m2 === 'Thiên thượng hỏa' || m2 === 'Sơn hạ hỏa' || m2 === 'Tích Lịch Hỏa'))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Hỏa là Thiên thượng hỏa hoặc Sơn hạ hỏa hoặc Tích Lịch Hỏa</span>';
		}
		if(((y1 === 'Mộc' && y2 === 'Kim') && (m1 === 'Bình địa mộc')) || ((y1 === 'Kim' && y2 === 'Mộc') && (m2 === 'Bình địa mộc'))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Mộc là Bình địa mộc</span>';
		}
		if(((y1 === 'Thủy' && y2 === 'Thổ') && (m1 === 'Đại hải thủy' || m1 === 'Thiên hà thủy')) || ((y1 === 'Thổ' && y2 === 'Thủy') && (m2 === 'Đại hải thủy' || m2 === 'Thiên hà thủy'))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Thủy là Đại hải thủy hoặc Thiên hà thủy</span>';
		}
		if(((y1 === 'Thổ' && y2 === 'Mộc') && (m1 === 'Lộ bàng thổ' || m1 === 'Đại dịch thổ' || m1 === 'Sa trung thổ')) || ((y1 === 'Mộc' && y2 === 'Thổ') && (m2 === 'Lộ bàng thổ' || m2 === 'Đại dịch thổ' || m2 === 'Sa trung thổ'))) {
			if(calc) { return 2; }
			return '<strong style="color:#00CC66">Tương khắc nhưng tốt</strong><br><span>Nếu Thổ là Lộ bàng thổ hoặc Đại dịch thổ hoặc Sa trung thổ</span>';
		}
		if(calc) { return 0; }
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
