<div class="panel panel-primary">
	<div class="panel-heading">
		<span><i class="fa fa-plus mt admin"></i> Administrateurs</span>
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td><strong>Identifiant</strong></td>
					<td><strong>Nom</strong></td>
					<td><strong>Pr&eacute;nom</strong></td>
					<td><strong>Mail</strong></td>
					<td><strong>Status</strong></td>
					<td><strong>Droits</strong></td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				{foreach $admins as $user}
				<tr adminId="{$user->getId()}">
					<td>{$user->getId()}</td>
					<td>{$user->getSureName()}</td>
					<td>{$user->getFirstName()}</td>
					<td>{$user->getMail()}</td>
					<td>
						{if $user->isActived()}
						<span class='label label-success'>Activ&eacute;</span>
						{else}
						<span class='label label-danger'>D&eacute;sactiv&eacute;</span>
						{/if}
					</td>
					<td></td>
					<td>
						<a href='{url path="admin/view/"}{$user->getId()}'><i class="fa fa-sign-out mt" title='Consulter'></i></a>
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
	    $('.fa-plus.mt.admin').click(function(){
	        getContent($('#content'), 'admin/addF');
	    });
	    $('.fa.fa-sign-out.mt').click(function(){
	        var adminId = $(this).parent().parent().attr('adminId')
	        getContent($('#content'), 'admin/view/'+adminId);
	    });
	});
</script>