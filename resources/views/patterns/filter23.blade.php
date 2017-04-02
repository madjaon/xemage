<!-- boi ngay sinh -->
<div class="timebox">
	<p><label>Ngày sinh:</label>{!! CommonOption::getListDay('day', 27) !!} {!! CommonOption::getListMonth('month', 11) !!} {!! CommonOption::getListYear('year', 2027, 1930, 1988) !!}</p>
	<p id="filterError"></p>
	<p><button id="filter23">Xem kết quả</button></p>
</div>
<script>
	// boi ngay sinh
	$('#filter23').click(function(){
		var day = $('select[name="day"] option:selected').val();
		var month = $('select[name="month"] option:selected').val();
		var year = $('select[name="year"] option:selected').val();
		if(day === '' || month === '' || year === '') {
			$('#filterError').hide().html('Mời bạn chọn đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.ajax(
		{
			type: 'post',
			url: '/boingaysinh',
			data: {
				'day': day,
				'month': month,
				'year': year,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
	            $('#filter23').html('Xin bạn chờ chút');
	        },
			success: function(data)
			{
				var url = '/xem-boi-ngay-sinh-que-so-'+data;
				window.location.href = url;
			},
			error: function(xhr)
			{
				alert('Tính năng đang cập nhật. Xin bạn quay lại sau!');
				window.location.reload();
			}
		});
		return;
	});
</script>