<!-- boi ngay sinh -->
<?php 
	$slug = getSlugFromUrl('',1);
	$slugCharacter = explode('-', $slug);
	$slugCharacterCount = count($slugCharacter);
	if($slugCharacterCount > 3) {
		$year = $slugCharacter[count($slugCharacter)-1];
		if(!isset($year) || !is_numeric($year)) {
			$year = 1930;
		}
		$month = $slugCharacter[count($slugCharacter)-3];
		if(!isset($month) || !is_numeric($month)) {
			$month = 1;
		}
		$day = $slugCharacter[count($slugCharacter)-3];
		if(!isset($day) || !is_numeric($day)) {
			$day = 1;
		}
	} else {
		$year = 1930;
		$month = 1;
		$day = 1;
	}
?>
<div class="timebox">
	<p><label>Ngày sinh:</label>{!! CommonOption::getListDay('day', $day) !!} {!! CommonOption::getListMonth('month', $month) !!} {!! CommonOption::getListYear('year', 2027, 1930, $year) !!}</p>
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
			$('#filterError').html('Mời bạn chọn đầy đủ thông tin');
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
			}
		});
		return;
	});
</script>