<div class="panel panel-primary">
	<div class="panel-heading">
		<span>Candidatures</span>
		<span class='pull-right'><i class="fa fa-caret-square-o-up mt"></i></span>
	</div>
	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<td><strong>Intitule</strong></td>
				<td><strong>Status</strong></td>
				<td><strong>Date de candidature</strong></td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody>
			{foreach $user->getCandidatures(true) as $cand}
			<tr>
				<td>{$cand.offre->getIntitule()}</td>
				<td>
					{if $cand['2'] == 0}
					<span class='label label-default'>En attente</span>
					{elseif $cand['2'] == 1}
					<span class='label label-success'>Accept&eacute;e</span>
					{elseif $cand['2'] == 2}
					<span class='label label-danger'>Refus&eacute;e</span>
					{elseif $cand['2'] == 3}
					<span class='label label-waring'>Annul&eacute;e</span>
					{/if}
				</td>
				<td>{$cand['1']|date_format:'%d/%M/%Y %R'}</td>
				<td>
					<a href='{url path="offer/view/"}{$cand["0"]}'>
						<i class="fa fa-sign-out mt" title='Consulter'></i>
					</a>
				</td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan=4>Aucune candidature</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

<script language='javascript'>
	$(document).ready(function(){
	});
</script>