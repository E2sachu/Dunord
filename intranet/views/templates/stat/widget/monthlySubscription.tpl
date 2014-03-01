<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Nombre d'inscription (-30j)</h3>
	</div>
	<div class="panel-body" style='font-size: 140px;' id='todaySubscription'>
		<canvas class="monthlySubsciption" style='width:100%; height: 100%'></canvas>
	</div>
</div>
<script language="javascript">
	$(document).ready(function(){
		$.getJSON($.baseUrl+'stat/monthlySubsciption', function(data){
			var ctx = $('canvas.monthlySubsciption').get(0).getContext("2d");
			var monthlySubsciption = new Chart(ctx).Line({
				labels : ["","","","","","","","","","","","","","","","","","","","","","","","","","","","","",""],
				datasets : [
					{
						fillColor : "rgba(220,220,220,0.5)",
						strokeColor : "rgba(220,220,220,1)",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#fff",
						data : [12,13,14,15,16,17,18,19,20,21,22,23,24,25,25,25,25,23,20,18,19,17,18,19,20,22,35,36,34,18]
					}
				]
			},{});
		});
	});
</script>