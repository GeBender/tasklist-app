$(document).ready(function() {
	
	$('#form-task').submit(function(e) {
		e.preventDefault();
		
		type = 'POST';
		data = $(this).serialize();
		url = $(this).attr('action');
		$.ajax({
			type: type,
	  		url: url,
	  		data: data,
			success:function(data){
				if ($('#id').val() == '') {
					parent.location.href = parent.location.href;
				} else {
					parent.location.href = '/';
				}
			}
		});
		
		return false;
	})
	
});