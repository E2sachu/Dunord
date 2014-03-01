<div class="row" companyId="{$company->getId()}">
	<h2>
		<i class="fa fa-times mt" title='Supprimer'></i>
		<i class="fa fa-wrench mt" title='Modifier'></i>
		{$company->getLabel()}
	</h2>
	<div class="col-md-6">
		<h3>Company</h3>
		{include file='company/view.tpl'}
	</div>
	<div class="col-md-6">
		<h3>Administrateur
			<a href='{url path="user/view/"}{$company->getAdminId()}'>
				<i class="fa fa-sign-out mt" title='Consulter'></i>
			</a>
		</h3>
		{include file='user/view.tpl' user=$company->getAdmin()}
	</div>
</div>

<script language='javascript'>
	$(document).ready(function(){
	    $('.fa-plus.mt.user').click(function(){
	        getContent($('#content'), 'company/addF');
	    });
	    $('.fa.fa-times.mt').click(function(){
	        var companyId = $(this).parent().parent().attr('companyId')
	        getContent($('#content'), 'company/delete/'+companyId);
	    });
	    $('.fa.fa-wrench.mt').click(function(){
	        var companyId = $(this).parent().parent().attr('companyId')
	        getContent($('#content'), 'company/updateF/'+companyId);
	    });
	});
</script>