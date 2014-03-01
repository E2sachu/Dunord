<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nombre d'offre publiées</h3>
	</div>
	<div class="panel-body" style='font-size: 140px;' id='totalOffer'>
		<center></center>
	</div>
</div>
<script language="javascript">
	$(document).ready(function(){
		//SUBSCRIPTION TODAY
		$.getJSON($.baseUrl+'stat/totalOffer', function(data){
			$('#totalOffer > center').append(data['total']);
		});
	});
</script>