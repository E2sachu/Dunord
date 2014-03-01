<div class="row" accountId="{$account->getId()}">
	<h2>
		Compte de {$account->getAdmin()->getPrenom()} {$account->getAdmin()->getNom()}
	</h2>
	<div class="col-md-6">
		<h3>Compte de cr&eacute;dit</h3>
		{include file='account/view.tpl'}
		{include file='account/add.tpl'}
	</div>
	<div class="col-md-6" id='accountLogsList'>
		<h3>Administrateur
			<a href='{url path="user/view/"}{$account->getAdminId()}'>
				<i class="fa fa-sign-out mt" title='Consulter'></i>
			</a>
		</h3>
		{include file='user/view.tpl' user=$account->getAdmin()}
	</div>
</div>
<div class="row" accountId="{$account->getId()}">
	<div class="col-md-6" id='accountLogsList'>
		{include file='account/listLogs.tpl' logs=$account->getLogs(true)}
	</div>
	<div class="col-md-6" id=''>

	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
		$('#accountLogsList > .panel > .panel-heading > span.pull-right > i').click();
		$('#accountLogsAdd > div.panel-heading > span.pull-right > i').click();
	    $('.fa.fa-times.mt').click(function(){
	        var accountId = $(this).parent().parent().attr('accountId')
	        getContent($('#content'), 'account/delete/'+accountId);
	    });
	    $('.fa.fa-wrench.mt').click(function(){
	        var accountId = $(this).parent().parent().attr('accountId')
	        getContent($('#content'), 'account/updateF/'+accountId);
	    });
	});
</script>