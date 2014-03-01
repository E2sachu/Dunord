<h2>
	<i class="fa fa-times mt"></i>
	<i class="fa fa-wrench mt"></i>
	{$product->getLabel()}
</h2>
<div class="row">
	<div class="col-md-6">
		<ul class="list-group">
			<li class="list-group-item acitve">Identifiant: {$product->getId()}</li>
			<li class="list-group-item">Description: {$product->getDescription()}</li>
			<li class="list-group-item">Montant: {$product->getPrice()} &euro;HT</li>
			<li class="list-group-item">Exécution: {$product->getExecFct()}</li>
			<li class="list-group-item">Paramètres: {$product->getParams()|json}</li>
			<li class="list-group-item">Date de création: {$product->getDateCreate()}</li>
			<li class="list-group-item">Date de modification: {$product->getDateModify()}</li>
		</ul>
	</div>
	<div class="col-md-6">
	
	</div>
</div>

<script language="javascript">
$(document).ready(function(){
	$('.fa-wrench.mt').click(function(){
		getContent($('#content'), 'product/updateF/{$product->getId()}');
	});
	$('.fa-times.mt').click(function(){
		confirmDialog({
			title: 'Suppression de produit',
			body: 'Etes vous certain de vouloir supprimer ce produit ?',
			validate: function(){
				getContent($('#content'), 'product/delete/{$product->getId()}');				
				reload('product/home');
			}
		});
	});
});
</script>