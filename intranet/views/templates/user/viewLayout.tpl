<div class="row" id='userId' userId="{$user->getId()}">
	<h2>
		<i class="fa fa-times mt" title='Supprimer'></i>
		<a href='{url path="user/updateF/"}{$user->getId()}'><i class="fa fa-wrench mt" title='Modifier'></i></a>
		{$user->getPrenom()} {$user->getNom()} 
		{if $user->getProfilType() == 2}
		<span class='label label-primary'>Rec</span>
		{else}
		<span class='label label-default'>Cand</span>
		{/if}
	</h2>
	<div class="col-md-6">
		<h3>Compte utilisateur</h3>
		{include file='user/view.tpl'}
	</div>
	<div class="col-md-6">
		{if $user->getProfilType() == 2}
		<h3>Company 
			<a href='{url path="company/view/"}{$user->getCompanyId()}'>
				<i class="fa fa-sign-out mt" title='Consulter'></i>
			</a>
		</h3>
		{include file='company/view.tpl' company=$user->getCompany()}
		{else}
		<h3>Compte de cr&eacute;dit 
			<a href='{url path="account/view/"}{$user->getAccountId()}'>
				<i class="fa fa-sign-out mt" title='Consulter'></i>
			</a>
		</h3>
		{include file='account/view.tpl' account=$user->getAccount()}
		{/if}
	</div>
</div>
{if $user->getProfilType() == 2}
<div class="row" userId="{$user->getId()}">
	<div class="col-md-6">
		
	</div>
	<div class="col-md-6">
		
	</div>
</div>
{else}
<div class="row" userId="{$user->getId()}">
	<div class="col-md-6" id='userViewBig5'>
		{include file='user/big5.tpl'}
	</div>
	<div class="col-md-6" id='userViewHaw'>
		{include file='user/haw.tpl'}
	</div>
</div>
<div class="row" userId="{$user->getId()}">
	<div class="col-md-6" id='userViewListCandidature'>
		{include file='user/listCandidature.tpl'}
	</div>
	<div class="col-md-6" id='userViewListInvitation'>
		{include file='user/listInvitation.tpl'}
	</div>
</div>
{/if}


<script language='javascript'>
	$(document).ready(function(){
		$('#userViewListCandidature > .panel > .panel-heading > span.pull-right > i').click();
		$('#userViewListInvitation > .panel > .panel-heading > span.pull-right > i').click();
		$('#userViewBig5 > .panel > .panel-heading > span.pull-right > i').click();
		$('#userViewHaw > .panel > .panel-heading > span.pull-right > i').click();
		$('.fa-times.mt').click(function(){
			initDialog({
				body: "Voulez-vous vraiment supprimer cet utilisateur ?", 
				title: "Confirmez la suppression de l'utilisateur"
			});
			$('#dialogWindowButton > button').click(function(){
				if ($(this).data('val') == 'validate'){
					make('user/delete/'+$('#userId').attr('userId'), {}, function(){
						toggleDialog();
						reload('user/home');
					}, 'Compte supprimé avec succès',
					function (){
						toggleDialog();
					}, 'Compte non supprimable');	
				}
			})
		});
	});
</script>