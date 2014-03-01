<div class="panel panel-primary">
	<div class="panel-heading">
		<span><i class="fa fa-plus mt company"></i> Compagnie</span>
	</div>
	<div class="panel-body">
		<center>
			Total : {$stat.total}<BR>
		</center> 	
  	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
	    $('.fa-plus.mt.compnay').click(function(){
	        getContent($('#content'), 'company/addF');
	    });
	});
</script>