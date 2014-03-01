<h2>
<i class="fa fa-times mt"></i>
<i class="fa fa-wrench mt"></i>
{$coupon->getKey()}</h2>
<div class="row">
	<div class="col-md-6">
		<ul class="list-group">
			<li class="list-group-item acitve">Identifiant: {$coupon->getId()}</li>
			<li class="list-group-item">Produit: {$coupon->getProduct()->getLabel()}</li>
			<li class="list-group-item">Clé: {$coupon->getKey()}</li>
			<li class="list-group-item">Date de début: {$coupon->getDateStart()}</li>
			<li class="list-group-item">Date de fin: {$coupon->getDateEnd()}</li>
			<li class="list-group-item">Compteur: {$coupon->getCounter()}</li>
			<li class="list-group-item">Status: {$coupon->getStatus()}</li>
			<li class="list-group-item">Prix: {$coupon->getPrice()}</li>
			<li class="list-group-item">Date de création: {$coupon->getDateCreate()}</li>
			<li class="list-group-item">Date de modification: {$coupon->getDateModify()}</li>
		</ul>
	</div>
	<div class="col-md-6">
	
	</div>
</div>

<script language="javascript">
$(document).ready(function(){
	$('.fa-wrench.mt').click(function(){
		getContent($('#content'), 'coupon/updateF/{$coupon->getId()}');
	});
	$('.fa-times.mt').click(function(){
		initDialog({
			body: "Voulez-vous vraiment supprimer ce coupon ?", 
			title: "Confirmez la suppression de coupon"
		});
		$('#dialogWindowButton > button').click(function(){
			if ($(this).data('val') == 'validate'){
				getContent($('#content'), 'coupon/delete/{$coupon->getId()}');	
				toggleDialog();
				reload('coupon/home');
			}
		})
	});
});
</script>