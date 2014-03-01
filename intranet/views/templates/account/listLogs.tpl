<div class="panel panel-primary">
	<div class="panel-heading">
		<span>Logs</span>
		<span class='pull-right'><i class="fa fa-caret-square-o-up mt"></i></span>
	</div>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<td><strong>Montant</strong></td>
				<td><strong>Libell&eacute;</strong></td>
				<td><strong>Utilisateur</strong></td>
				<td><strong>Date</strong></td>
			</tr>
		</thead>
		<tbody>
			{foreach $logs as $log}
			<tr>
				<td>{$log.amount}</td>
				<td>{$log.label}</td>
				<td>{$log.user->getPrenom()} {$log.user->getNom()}</td>
				<td>{$log.dateCreate|date_format:'%d/%m/%Y %R'}</td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan=4>Aucun log</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<script language='javascript'>
	$(document).ready(function(){
	});
</script>