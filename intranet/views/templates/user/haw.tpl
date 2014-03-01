<div class="panel panel-primary">
	<div class="panel-heading">
		<span>Cultur Fit</span>
		<span class='pull-right'><i class="fa fa-caret-square-o-up mt"></i></span>
	</div>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<td><strong>Intitule</strong></td>
				<td><strong>Status</strong></td>
				<td><strong>Date d'invitation</strong></td>
				<td><strong>Date de modification</strong></td>
			</tr>
		</thead>
		<tbody>
			{foreach $user->getHaw() as $result}
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan=4>Aucun Cultur Fit</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<script language='javascript'>
	$(document).ready(function(){
	});
</script>