<div class="panel panel-primary">
	<div class="panel-heading">
		<span>Big 5</span>
		<span class='pull-right'><i class="fa fa-caret-square-o-up mt"></i></span>
	</div>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<td><strong>Item</strong></td>
				<td><strong>v1</strong></td>
				<td><strong>v2</strong></td>
				<td><strong>v3</strong></td>
				<td><strong>v4</strong></td>
			</tr>
		</thead>
		<tbody>
			{foreach $user->getBigFive('result') as $key=>$result}
			<tr>
				<td>{$key}</td>
				{foreach $result as $k=>$value}
				<td>{$value}</td>
				{/foreach}
			</tr>
			{foreachelse}
			<tr>
				<td colspan=4>Aucun Big 5</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<script language='javascript'>
	$(document).ready(function(){
	});
</script>