<div class="panel panel-primary">
	<div class="panel-heading">
		<span>Invitations</span>
		<span class='pull-right'><i class="fa fa-caret-square-o-up mt"></i></span>
	</div>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<td><strong>Intitule</strong></td>
				<td><strong>Status</strong></td>
				<td><strong>Date d'invitation</strong></td>
				<td><strong>Date de modification</strong></td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody>
			{foreach $user->getInvitations(true) as $invit}
			<tr>
				<td>{$invit.user->getNom()} {$invit.user->getPrenom()}</td>
				<td>
					{if $invit.status == 0}
					<span class='label label-default'>En attente</span>
					{elseif $invit.status == 1}
					<span class='label label-success'>Accept&eacute;e</span>
					{elseif $invit.status == 2}
					<span class='label label-danger'>Refus&eacute;e</span>
					{elseif $invit.status == 3}
					<span class='label label-waring'>Annul&eacute;e</span>
					{/if}
				</td>
				<td>{$invit.date|date_format:'%d/%m/%Y %R'}</td>
				<td>{$invit.dateStatus|date_format:'%d/%m/%Y %R'}</td>
				<td></td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan=4>Aucune invitation</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<script language='javascript'>
	$(document).ready(function(){
	});
</script>