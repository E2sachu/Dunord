<div class="panel panel-primary">
	<div class="panel-heading">
		<span><i class="fa fa-plus mt company"></i> Company</span>
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td><strong>Nom</strong></td>
					<td><strong>Admin</strong></td>
					<td><strong>Mail</strong></td>
					<td><strong>T&eacute;l&eacutephone</strong></td>
					<td><strong>Secteur</strong></td>
					<td><strong>Date de cr&eacute;action</strong></td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				{foreach $companys as $company}
				<tr companyId="{$company->getId()}">
					<td>{$company->getLabel()}</td>
					{if is_a($company->getAdmin(), 'Recruiter')}
					<td>{$company->getAdmin()->getNom()} {$company->getAdmin()->getPrenom()}</td>
					{else}
					<td></td>
					{/if}
					<td>{$company->getMailContact()}</td>
					<td>{$company->getTelContact()}</td>
					<td>{$company->getActivitySector()}</td>
					<td>{$company->getDateCreate('d/m/Y H:i')}</td>
					<td>
						<a href='{url path="company/view/"}{$company->getId()}'><i class="fa fa-sign-out mt" title='Consulter'></i></a>
					</td>
				</tr>
				{foreachelse}
				<tr>
					<td colspan=8><center>Pas de compagnie enregistr&eacute;</center></td>
				</tr>
				{/foreach}
			</tbody>
		</table>	
  	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
	    $('.fa-plus.mt.company').click(function(){
	        getContent($('#content'), 'company/addF');
	    });
	    $('.fa.fa-sign-out.mt').click(function(){
	        var companyId = $(this).parent().parent().attr('companyId')
	        getContent($('#content'), 'company/view/'+companyId);
	    });
	});
</script>