<ul class="list-group" companyId="{$company->getId()}">
	<li class="list-group-item ">Identifiant : {$company->getId()}</li>
	<li class="list-group-item ">Raison sociale : {$company->getLabel()}</li>
	<li class="list-group-item ">Mail de contact : {$company->getMailContact()}</li>
	<li class="list-group-item ">Téléphone : {$company->getTelContact()}</li>
	<li class="list-group-item ">Adresse1 : {$company->getAddress1()}</li>
	<li class="list-group-item ">Adresse2 : {$company->getAddress2()}</li>
	<li class="list-group-item ">Code postal : {$company->getZipCode()}</li>
	<li class="list-group-item ">Ville : {$company->getCity()}</li>
	<li class="list-group-item ">Pays : {$company->getCountry()}</li>
	<li class="list-group-item ">Type : {$company->getStyle()}</li>
	<li class="list-group-item ">CA : K€{$company->getCA()}</li>
	<li class="list-group-item ">Secteur d'actibit&eacute; : {$company->getActivitySector()}</li>
	<li class="list-group-item ">Mission : {$company->getMission()}</li>
	<li class="list-group-item ">Nombre de salariés : {$company->getStaffSize()}</li>
	<li class="list-group-item ">Website : <ul>
	{foreach $company->getWebsite() as $site}
		<li><a href='{$site}' target='_blank'>{$site}</a></li>
	{foreachelse}
		<li>Pas de site web</li>
	{/foreach}
	</li></ul>
	<li class="list-group-item ">Candidature libre : {$company->getFreeApplication()}</li>
	<li class="list-group-item">Candidature Libre :
	{if $company->getFreeApplication()}
	 	<span id="companyFreeStatusActive" class="label label-success">Activ&eacute;</span>
	{else}
		<span id="companyFreeStatusActive" class="label label-danger">Désactiv&eacute;</span>
	{/if}
	<div class="btn-group-xs pull-right">
			{if $company->getFreeApplication()}
			<button type="button" class="btn btn-danger" id='companyAppActive'>D&eacute;sactiver</button>
			{else}
			<button type="button" class="btn btn-success" id='companyAppActive'>Activer</button>
			{/if}
		</div>
	</li>
	<li class="list-group-item"> Visibilit&eacute; : 
	{if $company->getVisibility()}
	 	<span id="companyViewStatusActive" class="label label-success">Activ&eacute;</span>
	{else}
		<span id="companyViewStatusActive" class="label label-danger">Désactiv&eacute;</span>
	{/if}
	<div class="btn-group-xs pull-right">
			{if $company->getVisibility()}
			<button type="button" class="btn btn-danger" id='companyViewActive'>D&eacute;sactiver</button>
			{else}
			<button type="button" class="btn btn-success" id='companyViewActive'>Activer</button>
			{/if}
		</div>
	</li>
	<li class="list-group-item">Date de cr&eacute;ation : {$company->getDateCreate('d/m/Y H:i:s')}</li>
	<li class="list-group-item">Dernière modification :	 {$company->getDateModify('d/m/Y H:i:s')}</li>
</ul>
<script language='javascript'>
	$(document).ready(function(){
		$('#companyViewActive').click(function(){
			var uid = $(this).parent().parent().parent().attr('companyId');
			var btn = $(this);
			btn.removeClass();
			make('company/visibility/'+uid, {}, function(data){
				$('#companyViewStatusActive').removeClass();
				if (data['status']){
					btn.html('D&eacute;sactiver');
					btn.addClass('btn btn-danger');
					$('#companyViewStatusActive').html('Activ&eacute;');
					$('#companyViewStatusActive').addClass('label label-success');
				}else{
					btn.html('Activer');
					btn.addClass('btn btn-success');
					$('#companyViewStatusActive').html('D&eacute;sactiver')
					$('#companyViewStatusActive').addClass('label label-danger');
				}
			}, 'Activation du compte modifi&eacute; avec succ&egrave;s.');
		});
		$('#companyAppActive').click(function(){
			var uid = $(this).parent().parent().parent().attr('companyId');
			var btn = $(this);
			btn.removeClass();
			make('company/freeApplication/'+uid, {}, function(data){
				$('#companyFreeStatusActive').removeClass();
				if (data['status']){
					btn.html('D&eacute;sactiver');
					btn.addClass('btn btn-danger');
					$('#companyFreeStatusActive').html('Activ&eacute;');
					$('#companyFreeStatusActive').addClass('label label-success');
				}else{
					btn.html('Activer');
					btn.addClass('btn btn-success');
					$('#companyFreeStatusActive').html('D&eacute;sactiver')
					$('#companyFreeStatusActive').addClass('label label-danger');
				}
			}, 'Candidature libre modifi&eacute; avec succ&egrave;s.');
		});
	});
</script>