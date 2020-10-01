<div style="margin-top: 50px;">
	<button class="btn btn-default qic-btn">Download CSV</button>
</div>

<script type="text/javascript">
	const qicUrl = '<?php _e($ajax_url);?>';

	const qicBtn = document.querySelector('.qic-btn');
	
	qicBtn.addEventListener('click', function(e){
		e.preventDefault();
		
		this.disabled = true;

		$.ajax({
        	type:'get',
        	url: qicUrl,
        	success: function(response){ 
        		if (response.url != undefined ) {
		          window.open(response.url);
		        }
        	}
		});
	});
</script>