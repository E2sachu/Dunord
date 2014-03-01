<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nombre d'inscription aujourd'hui</h3>
	</div>
	<div class="panel-body" style='font-size: 140px;' id='todaySubscription'>
		<center></center>
	</div>
</div>
<script language="javascript">
	$(document).ready(function(){
		//SUBSCRIPTION TODAY
		$.getJSON($.baseUrl+'stat/todaySubscription', function(data){
			$('#todaySubscription > center').append(data['today']);
		});
	});
</script>