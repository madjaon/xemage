<!-- boi ai cap -->
<div class="timebox">
	<p><strong>Nhập tên cần xem bói:</strong></p>
	<p><input type="text" name="fullname" value="" class="form-control" style="width: 60%;"></p>
	<p id="filterError"></p>
	<p><button id="filter36">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// boi ai cap
	$('#filter36').click(function(){
		var fullname = $('input[name="fullname"]').val();
		if(fullname === '') {
			$('#filterError').hide().html('Mời bạn nhập đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.ajax(
		{
			type: 'post',
			url: '/xemboiaicap',
			data: {
				'fullname': fullname,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
	            $('#filter36').html('Xin bạn bạn chờ chút');
	        },
			success: function(data)
			{
				var url = '/xem-boi-ai-cap-menh-so-'+data;
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