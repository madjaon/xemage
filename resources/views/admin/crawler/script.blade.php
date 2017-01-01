<script>
	$(function () {
		typeCrawler();
		buttonDisabled('.savenow');
		buttonDisabled('.stealnow');
	});
	function typeCrawler()
	{
		type = $('select[name="type"]').val();
		if(type == {{ CRAW_POST }}) {
			$('.crawpost').prop('disabled', false);
			$('.crawcategory').prop('disabled', true);
		} else {
			//CRAW_CATEGORY
			$('.crawpost').prop('disabled', true);
			$('.crawcategory').prop('disabled', false);
		}
		return;
	}
	function stealnow()
	{
		getForm();
		$.ajax(
		{
			type: 'post',
			url: '{{ url("admin/crawler/steal") }}',
			data: {
				'id': id,
				'type': type,
				'post_links': post_links,
				'category_link': category_link,
				'category_page_link': category_page_link,
				'category_page_number': category_page_number,
				'category_post_link_pattern': category_post_link_pattern,
				'image_dir': image_dir,
				'image_pattern': image_pattern,
				'image_check': image_check,
				'title_pattern': title_pattern,
				'description_pattern': description_pattern,
				'description_pattern_delete': description_pattern_delete,
				'element_delete': element_delete,
				'element_delete_positions': element_delete_positions,
				'name': name,
				'source': source,
				'type_main_id': type_main_id,
				'start_date': start_date,
				'start_time': start_time,
				'status': status,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
	            buttonDisabled('.stealnow', 1);
	        },
			success: function(data)
			{
				alert('Ok darling! Check Posts List Now!');
				buttonDisabled('.stealnow');
				return;
			}
		});
		// window.location.reload();
	}
	function savenow()
	{
		getForm();
		$.ajax(
		{
			type: 'post',
			url: '{{ url("admin/crawler/save") }}',
			data: {
				'id': id,
				'type': type,
				'post_links': post_links,
				'category_link': category_link,
				'category_page_link': category_page_link,
				'category_page_number': category_page_number,
				'category_post_link_pattern': category_post_link_pattern,
				'image_dir': image_dir,
				'image_pattern': image_pattern,
				'image_check': image_check,
				'title_pattern': title_pattern,
				'description_pattern': description_pattern,
				'description_pattern_delete': description_pattern_delete,
				'element_delete': element_delete,
				'element_delete_positions': element_delete_positions,
				'name': name,
				'source': source,
				'type_main_id': type_main_id,
				'start_date': start_date,
				'start_time': start_time,
				'status': status,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
	            buttonDisabled('.savenow', 1);
	        },
			success: function(data)
			{
				if(data == 1) {
					alert('Ok darling!');
					buttonDisabled('.savenow');
				} else if(data == 0) {
					alert('Cập nhật lỗi! Mời xem lại');
					window.location.reload();
				} else if(data == 2) {
					alert('Lỗi dữ liệu! Mời xem lại dữ liệu đã nhập');
					buttonDisabled('.savenow');
				}
				return;
			}
		});
		// window.location.reload();
	}
	function getForm()
	{
		id = $('input[name="id"]').val();
		type = $('select[name="type"]').val();
		post_links = $('textarea[name="post_links"]').val();
		category_link = $('textarea[name="category_link"]').val();
		category_page_link = $('textarea[name="category_page_link"]').val();
		category_page_number = $('input[name="category_page_number"]').val();
		category_post_link_pattern = $('input[name="category_post_link_pattern"]').val();
		image_dir = $('input[name="image_dir"]').val();
		image_pattern = $('input[name="image_pattern"]').val();
		image_check = $('select[name="image_check"]').val();
		title_pattern = $('input[name="title_pattern"]').val();
		description_pattern = $('input[name="description_pattern"]').val();
		description_pattern_delete = $('textarea[name="description_pattern_delete"]').val();
		element_delete = $('input[name="element_delete"]').val();
		element_delete_positions = $('input[name="element_delete_positions"]').val();
		name = $('input[name="name"]').val();
		source = $('input[name="source"]').val();
		type_main_id = $('select[name="type_main_id"]').val();
		start_date = $('input[name="start_date"]').val();
		start_time = $('input[name="start_time"]').val();
		status = $('select[name="status"]').val();
	}
	function buttonDisabled(btnClass, disabled)
	{
		if (btnClass == '.savenow') {
			if (disabled == 1) {
				$(btnClass).prop('disabled', true);
	            $(btnClass).val('Saving me...');
			} else {
				$(btnClass).val('Lưu lại');
				$(btnClass).prop('disabled', false);
			}
		} else if (btnClass == '.stealnow') {
			if (disabled == 1) {
				$(btnClass).prop('disabled', true);
	            $(btnClass).val('Stealing me...');
			} else {
				$(btnClass).val('Steal Now');
				$(btnClass).prop('disabled', false);
			}
		}
	}
</script>