<ul class="list-group" userId="{$user->getId()}">
	<li class="list-group-item">Identifiant: {$user->getId()}</li>
	<li class="list-group-item">Pr&eacute;nom Nom: {$user->getPrenom()} {$user->getNom()}</li>
	<li class="list-group-item">Mail/Login: {$user->getMail1()}<span class='pull-right'><button type="button" class="btn-xs btn-danger" id='userViewReinitPwd'>R&eacute;initialiser</button><span></li>
	<li class="list-group-item">Status: 
		{if $user->isActived()}
		<span class='label label-success' id='userViewStatusActive'>Activ&eacute;</span>
		{else}
		<span class='label label-danger' id='userViewStatusActive'>D&eacute;sactiv&eacute;</span>
		{/if}
		{if $user->isLocked()}
		<span class='label label-danger' id='userViewStatusLock'>Bloqu&eacute;</span>
		{else}
		<span class='label label-success' id='userViewStatusLock'>D&eacute;bloqu&eacute;</span>
		{/if}
		<div class="btn-group-xs pull-right">
			{if $user->isActived()}
			<button type="button" class="btn btn-danger" id='userViewActive'>D&eacute;sactiver</button>
			{else}
			<button type="button" class="btn btn-success" id='userViewActive'>Activer</button>
			{/if}
			{if $user->isLocked()}
			<button type="button" class="btn btn-warning" id='userViewLock'>D&eacute;bloquer</button>
			{else}
			<button type="button" class="btn btn-warning" id='userViewLock'>Bloquer</button>
			{/if}
		</div>
	</li>
	<li class="list-group-item">Date d'inscription': {$user->getDateInscription('d/m/Y H:i:s')}</li>
	<li class="list-group-item">Date de dernière connexion: {$user->getDateLastLogin('d/m/Y H:i:s')}</li>
	<li class="list-group-item">Clé de validation: {$user->getValidateMail()|truncate:30:'...'}</li>
</ul>
<script language='javascript'>
	$(document).ready(function(){
		$('#userViewReinitPwd').click(function(){
			var uid = $(this).parent().parent().parent().attr('userId');
			make('user/reinitPwd/'+uid, {}, function(data){}, 'Réinitialisation du mot de passe du compte effectué avec succ&egrave;s.');
		});
		$('#userViewActive').click(function(){
			var uid = $(this).parent().parent().parent().attr('userId');
			var btn = $(this);
			btn.removeClass();
			make('user/actived/'+uid, {}, function(data){
				$('#userViewStatusActive').removeClass();
				if (data['status']){
					btn.html('D&eacute;sactiver');
					btn.addClass('btn btn-danger');
					$('#userViewStatusActive').html('Activ&eacute;');
					$('#userViewStatusActive').addClass('label label-success');
				}else{
					btn.html('Activer');
					btn.addClass('btn btn-success');
					$('#userViewStatusActive').html('D&eacute;sactiver')
					$('#userViewStatusActive').addClass('label label-danger');
				}
			}, 'Activation du compte modifi&eacute; avec succ&egrave;s.');
		});
		$('#userViewLock').click(function(){
			var uid = $(this).parent().parent().parent().attr('userId');
			var btn = $(this);
			btn.removeClass();
			make('user/locked/'+uid, {}, function(data){
				$('#userViewStatusLock').removeClass();
				if (data['status']){
					btn.html('D&eacute;bloquer');
					btn.addClass('btn btn-success');
					$('#userViewStatusLock').html('Bloqu&eacute;');
					$('#userViewStatusLock').addClass('label label-danger');
				}else{
					btn.html('Bloquer');
					btn.addClass('btn btn-warning');
					$('#userViewStatusLock').html('D&eacute;bloqu&eacute;')
					$('#userViewStatusLock').addClass('label label-success');
				}
			}, 'Bloquage du compte modifi&eacute; avec succ&egrave;s.');
		});
	});
</script>