<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-plus mt product"></i> Produit
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td><strong>Label</strong></td>
					<td><strong>Description</strong></td>
					<td><strong>ExecFct</strong></td>
					<td><strong>Param&eacute;tre</strong></td>
				</tr>
			</thead>
			<tbody>
			{foreach $products as $product}
				<tr>
					<td><span class='productId' data-uid='{$product->getId()}'>{$product->getLabel()}</span></td>
					<td>{$product->getDescription()}</td>
					<td>{$product->getExecFct()}</td>
					<td>
						{foreach $product->getParams() as $key=>$value}
						<span class="label label-success">{$key}</span>
						<span class="label label-info">{$value}</span><BR>
						{foreachelse}
						Pas de param&eacute;tre
						{/foreach}
					</td>
				</tr>
			{/foreach}
			</tbody>
		</table>	    	
  	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
		$('.productId').click(function(){
			getContent($('#content'), 'product/view/'+$(this).data('uid'));
		});
		$('.fa-plus.mt.product').click(function(){
	        getContent($('#content'), 'product/addF');
	    });
	});
</script>