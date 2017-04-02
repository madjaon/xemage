<!-- thay phan -->
<div class="timebox">
	<p><strong>Nhập câu hỏi:</strong></p>
	<p>Mời bạn nhập 1 câu hỏi bất kỳ mà bạn đang phân vân.</p>
	<p><input type="text" name="question" value="" class="form-control" style="width: 100%;"></p>
	<p><strong>Nhập câu trả lời:</strong></p>
	<p>Mời bạn nhập các câu trả lời cho câu hỏi phía trên. Mỗi câu trả lời ngăn cách bởi dấu phẩy ,</p>
	<p><input type="text" name="answer" value="" class="form-control" style="width: 100%;"></p>
	<p id="filterError"></p>
	<p><button id="filter35">Xem kết quả</button></p>
	<div id="filterResult"></div>
</div>
<script>
	// thay phan
	$('#filter35').click(function(){
		var question = $('input[name="question"]').val();
		var answer = $('input[name="answer"]').val();
		if(question === '' || answer === '') {
			$('#filterError').hide().html('Mời bạn nhập đầy đủ thông tin').fadeIn('fast');
			return;
		}
		$.ajax(
		{
			type: 'post',
			url: '/xemboithayphan',
			data: {
				'question': question,
				'answer': answer,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
	            $('#filter35').html('Xin bạn chờ thầy chút');
	        },
			success: function(data)
			{
				$('#filterError').hide().fadeOut('fast');
				$('#filter35').html('Xem kết quả');
				var string = '<p><strong>Kết quả:</strong> '+data+'</p>';
		  		$('#filterResult').hide().html(string).fadeIn('fast');
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