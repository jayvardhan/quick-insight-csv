<div style="margin-top: 50px;">
	<div class="text-muted" style="margin-bottom:50px;">
		<h3>Data will be generated for following query</h3>
		<?php echo $this->query(); ?>		
	</div>
	<button class="btn btn-primary qic-btn">Download CSV</button>
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