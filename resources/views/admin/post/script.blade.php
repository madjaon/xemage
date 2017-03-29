<script>
	$(function () {
		
	});
	function checkPostType(id, check=1)
	{
		if($('#type_id_'+id).is(':checked')) {
			//type main
			$('#make_primary_'+id).show();
			//seri
			// $('#make_seri_'+id).show();
			//related
			// $('#make_related_'+id).show();
		} else {
			//type main
			if($('input[name="type_main_id"]').val() == id) {
				$('input[name="type_main_id"]').val('');
			}
			$('#primary_'+id).hide();
			$('#make_primary_'+id).hide();
			//seri
			// if($('input[name="seri"]').val() == id) {
			// 	$('input[name="seri"]').val('');
			// }
			// $('#seri_'+id).hide();
			// $('#make_seri_'+id).hide();
			//related
			if($('input[name="related"]').val() == id) {
				$('input[name="related"]').val('');
			}
			$('#related_'+id).hide();
			// $('#make_related_'+id).hide();
			$('#make_related_'+id).show();
		}
		return;
	}
	function checkKey(id, key, name, check=1)
	{
		$('.post-type-list').each(function(index){
			var $li = $(this);
			type_id = $li.find('.type_id');
			if(check === 1) {
				if(type_id.is(':checked')) {
					$li.find('.'+key).hide();
					$li.find('.make_'+key).show();
				}
			} else {
				$li.find('.'+key).hide();
				$li.find('.make_'+key).show();
			}
		});
		$('input[name="'+name+'"]').val(id);
		$('#'+key+'_'+id).show();
		$('#make_'+key+'_'+id).hide();
	}
	//script for index:
	function updateStatus(id, field)
	{
		$.ajax(
		{
			type: 'post',
			url: '{{ url("admin/post/updateStatus") }}',
			data: {
				'id': id,
				'field': field,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
	            $('#'+field+'_'+id).html('...');
	        },
			success: function(data)
			{
				if(data == 1) {
					window.location.reload();
				} else {
					alert('Xảy ra lỗi! Chưa thể cập nhật! Vui lòng refresh trang.');
					window.location.reload();
				}
			}
		});
		// window.location.reload();
	}
	function deleteSelected()
	{
		var check = $('input:checkbox:checked.id').val();
		if(check) {
			calldelete();
		} else {
			alert('Bạn chưa chọn cái nào!');
		}
	}
	//call delete selected
	function calldelete()
	{
		confirm = confirm('Bạn có chắc chắn muốn xóa?')
		if(confirm) {
			var id = $('input:checkbox:checked.id').map(function () {
			  	return this.value;
			}).get();
			$.ajax(
			{
				type: 'post',
				url: '{{ url("admin/post/calldelete") }}',
				data: {
					'id': id,
					'_token': '{{ csrf_token() }}'
				},
				beforeSend: function() {
		            $('#loadMsg').html('Deleting...');
		        },
				success: function(data)
				{
					if(data) {
						window.location.reload();
					}
				}
			});
		} else {
			window.location.reload();
		}
	}
	//update type main index list
	function callupdatetype()
	{
		alert('od');
	}
</script>