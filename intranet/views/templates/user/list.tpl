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
				{foreach $users as $user}
				<tr userId="{$user->getId()}">
					<td>
						{if $user->getProfilType() == 2}
						<span class='label label-primary'>Rec</span>
						{else}
						<span class='label label-default'>Cand</span>
						{/if}
					</td>
					<td>{$user->getNom()}</td>
					<td>{$user->getPrenom()}</td>
					<td>{$user->getMail1()}</td>
					<td>
						{if $user->isActived()}
						<span class='label label-success'>Activ&eacute;</span>
						{else}
						<span class='label label-danger'>D&eacute;sactiv&eacute;</span>
						{/if}
						{if $user->isLocked()}
						<span class='label label-danger'>Bloqu&eacute;</span>
						{else}
						<span class='label label-success'>D&eacute;bloqu&eacute;</span>
						{/if}
					</td>
					<td>{$user->getDateInscription('d/m/Y H:i')}</td>
					<td>{$user->getDateLastLogin('d/m/Y H:i')}</td>
					<td>
						<a href='{url path="user/view/"}{$user->getId()}'><i class="fa fa-sign-out mt" title='Consulter'></i></a>
					</td>
				</tr>
				{foreachelse}
				<tr>
					<td colspan=8><center>Pas de compte enregistr&eacute;</center></td>
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