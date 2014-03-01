<ul class="list-group">
	<li class="list-group-item acitve">Identifiant: {$account->getId()}</li>
	<li class="list-group-item acitve">Solde: {$account->getBalance()} crédit</li>
	<li class="list-group-item">Date de cr&eacute;ation: {$account->getDateCreate('d/m/Y H:i:s')}</li>
	<li class="list-group-item">Date de dernière modification: {$account->getDateModify('d/m/Y H:i:s')}</li>
</ul>
<script language='javascript'>
	$(document).ready(function(){
	});
</script>