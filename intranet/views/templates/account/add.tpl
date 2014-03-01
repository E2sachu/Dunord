<div class="panel panel-primary" id='accountLogsAdd' aid='{$account->getId()}'>
	<div class="panel-heading">
		<span>Ajouter un log</span>
		<span class='pull-right'><i class="fa fa-caret-square-o-up mt"></i></span>
	</div>
	<form class="form-inline" role="form" id='addAccountLogForm' action='{url path="account/addLog/"}{$account->getId()}'>
		<div class="form-group">
			<input type="text" class="form-control" id="addAccountLogAmount" placeholder="Montant" size=5 name='amount'>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" id="addAccountLogLabel" placeholder="Libellé" name='label'>
		</div>
		<div class="form-group">
			<select id="addAccountLogUserId" name='userId'>
				<option value=''>Choisir un utilisateur</option>
				{foreach $account->getAccessUsers() as $u}
				{if $u->getId() == $account->getAdminId()}
				<option value='{$u->getId()}' selected>{$u->getPrenom()} {$u->getNom()}</option>
				{else}
				<option value='{$u->getId()}'>{$u->getPrenom()} {$u->getNom()}</option>
				{/if}
				{/foreach}
			</select>
		</div>
		<div class="btn-group-xs pull-right">
			<span class="btn btn-primary" id='addAccountLogButton'>Ajouter</span>
		</div>
	</form>
</div>

<script language='javascript'>
$(document).ready(function(){
	$('#addAccountLogUserId').chosen({
		disable_search_threshold: 10,
        allow_single_deselect: true,
        width: "100%"
	});
	$('#addAccountLogButton').click(function(){
		$.formSubmit($('#addAccountLogForm'), function(){
			reload('account/view/'+$('#accountLogsAdd').attr('aid'));
		})
	});
});
</script>