<div class="panel panel-primary">
	<div class="panel-heading">
		<span><i class="fa fa-plus mt user"></i> Utilisateur</span>
	</div>
	<div class="panel-body">
		<center>
			Candidats : {$stat.candidat}<BR>
			Recruteur : {$stat.recruiter}<BR>
			Total : {$stat.total}<BR>
		</center> 	
  	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
	    $('.fa-plus.mt.user').click(function(){
	        getContent($('#content'), 'user/addF');
	    });
	});
</script>