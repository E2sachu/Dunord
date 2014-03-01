<div class="panel panel-primary">
	<div class="panel-heading">
		<span><i class="fa fa-plus mt user"></i> Utilisateur</span>
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td><strong>Type</strong></td>
					<td><strong>Nom</strong></td>
					<td><strong>Pr&eacute;nom</strong></td>
					<td><strong>Mail</strong></td>
					<td><strong>Status</strong></td>
					<td><strong>Inscription</strong></td>
					<td><strong>Dernier activit&eacute;</strong></td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				{foreach $offers as $off}
				
				{foreachelse}
				<tr>
					<td colspan=8><center>Aucune offre</center></td>
				</tr>
				{/foreach}
			</tbody>
		</table>	
  	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
	    $('.fa-plus.mt.user').click(function(){
	        getContent($('#content'), 'user/addF');
	    });
	    $('.fa.fa-sign-out.mt').click(function(){
	        var userId = $(this).parent().parent().attr('userId')
	        getContent($('#content'), 'user/view/'+userId);
	    });
	});
</script>