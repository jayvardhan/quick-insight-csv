<div>
	<button class="btn btn-default qic-btn">Download CSV</button>
</div>

<script type="text/javascript">
	const qicUrl = '<?php _e($ajax_url);?>';

	const qicBtn = document.querySelector('.qic-btn');
	
	qicBtn.addEventListener('click', function(e){
		
		$.ajax({
        	type:'get',
        	url: qicUrl,
        	success: function(response){ 
        		console.log(response);
        	}
		});
	});
</script>