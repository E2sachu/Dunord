<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Repartition des utilisateurs</h3>
	</div>
	<div class="panel-body row">
		<ul class='userChart col-md-5'></ul>
		<div class='col-md-7'>
			<canvas class="userChart" width="200" height="200"></canvas>
		</div>
	</div>
</div>
<script language="javascript">
	$(document).ready(function(){
		//USERCHART
		$.getJSON($.baseUrl+'stat/userChart', function(data){
			var ctx = $('canvas.userChart').get(0).getContext("2d");
			var candidatureChart = new Chart(ctx).Doughnut(data, {});
			var total = 0;
			for(i in data){
				$('ul.userChart').append('<li class="list-group-item">'+data[i]['type']+': '+data[i]['value']+'</li>');
				total = total + data[i]['value'];
			}
			$('ul.userChart').append('<li class="list-group-item">Total: <strong>'+total+'</strong></li>');
		});
	});
</script>