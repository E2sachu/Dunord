<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="fa fa-plus mt coupon"></i> Coupon
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td><strong>Label</strong></td>
					<td><strong>Produit</strong></td>
					<td><strong>Début</strong></td>
					<td><strong>Fin</strong></td>
					<td><strong>Compteur</strong></td>
					<td><strong>Création</strong></td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
			{foreach $coupons as $coupon}
				<tr>
					<td><span class='couponId' data-uid='{$coupon->getId()}'>{$coupon->getKey()}</span></td>
					<td>{$coupon->getProduct()->getLabel()}</td>
					<td>{$coupon->getDateStart('d/m/Y H:i')}</td>
					<td>{$coupon->getDateEnd('d/m/Y H:i')}</td>
					<td>{if $coupon->getCounter() == -1}
							<span class="label label-success">Illimit&eacute;</span>
						{elseif $coupon->getCounter() < 10}
							<span class="label label-danger">{$coupon->getCounter()}</span>
						{elseif $coupon->getCounter() < 50}
							<span class="label label-warning">{$coupon->getCounter()}</span>
						{else}
							<span class="label label-success">{$coupon->getCounter()}</span>
						{/if}
					</td>
					<td>{$coupon->getDateCreate('d/m/Y H:i')}</td>
					<td>
						<span class='pull-left'><i class="fa fa-times mt"></i></span>
						<span class='pull-right'><i class="fa fa-wrench mt"></i></span>
					</td>
				</tr>
			{foreachelse}
				<tr>
					<td colspan=7>Pas de coupon enregistr&eacute;</td>
				</tr>
			{/foreach}
			</tbody>
		</table>	    	
  	</div>
</div>
<script language='javascript'>
	$(document).ready(function(){
		$('.couponId').click(function(){
			getContent($('#content'), 'coupon/view/'+$(this).data('uid'));
		});
	    $('.fa-plus.mt.coupon').click(function(){
	        getContent($('#content'), 'coupon/addF');
	    });
	});
</script>