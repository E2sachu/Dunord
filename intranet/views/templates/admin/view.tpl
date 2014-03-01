<ul class="list-group" userId="{$user->getId()}">
	<li class="list-group-item">Identifiant: {$user->getId()}</li>
	<li class="list-group-item">Pr&eacute;nom Nom: {$user->getFirstName()} {$user->getSureName()}</li>
	<li class="list-group-item">Mail/Login: {$user->getMail()}<span class='pull-right'><button type="button" class="btn-xs btn-danger" id='userViewReinitPwd'>R&eacute;initialiser</button><span></li>
	<li class="list-group-item">Status: 
		{if $user->isActived()}
		<span class='label label-success' id='userViewStatusActive'>Activ&eacute;</span>
		{else}
		<span class='label label-danger' id='userViewStatusActive'>D&eacute;sactiv&eacute;</span>
		{/if}
		<div class="btn-group-xs pull-right">
			{if $user->isActived()}
			<button type="button" class="btn btn-danger" id='userViewActive'>D&eacute;sactiver</button>
			{else}
			<button type="button" class="btn btn-success" id='userViewActive'>Activer</button>
			{/if}
		</div>
	</li>
</ul>
<script language='javascript'>
	$(document).ready(function(){
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
	});
</script>