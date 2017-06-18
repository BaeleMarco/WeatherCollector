<div class="container">
	<h4>Real time values</h4>
	<div class="realtime row">
		<div class="col s6 m4 l2">
			<h5>Temperature</h5>
			<div class="circle red-border">
				<span></span>
				<div class="inner-box">
					&deg;C
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Humidity</h5>
			<div class="circle purple-border">
				<span></span>
				<div class="inner-box">
					%
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Air pressure</h5>
			<div class="circle blue-border">
				<span></span>
				<div class="inner-box">
					Hg
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Air quality</h5>
			<div class="circle green-border">
				<span></span>
				<div class="inner-box">
				%
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Rain gauge</h5>
			<div class="circle orange-border">
				<span></span>
				<div class="inner-box">
					m&sup2;
				</div>
			</div>
		</div>
	</div>
	<h4 class="graph">Graph</h4>
	<canvas id="canvas" class="graph"></canvas>
	<p class="info">To edit the graph display, check or uncheck the boxes below.</p>
	<div class="row checkboxes graph">
		<div class="col m4">
			<input type="checkbox" id="Temperature" checked>
			<label for="Temperature">Temperature</label>
		</div>
		<div class="col m4">
			<input type="checkbox" id="Humidity" checked>
			<label for="Humidity">Humidity</label>
		</div>
		<div class="col m4">
			<input type="checkbox" id="Air-pressure" checked>
			<label for="Air-pressure">Air pressure</label>
		</div>
		<div class="col m4">
			<input type="checkbox" id="Air-quality" checked>
			<label for="Air-quality">Air quality</label>
		</div>
		<div class="col m4">
			<input type="checkbox" id="Rain-gauge" checked>
			<label for="Rain-gauge">Rain gauge</label>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/chart-self.js"></script>
<script type="text/javascript">
	// window.setInterval(function(){
		//Refreshing the realtime data every minut
		updatePage($('div.row.checkboxes')[0].innerText,'selectLast')
	// }, 60000);

	//Update onresize because default graph is empty
	if ($(window).width() < 993){
		window.onresize = function(event){
		    updatePage($('div.row.checkboxes')[0].innerText,'selectAll')
		}
	}

	$('div.row.checkboxes').on('change',function(e){ e.preventDefault(); $('p.info').hide(); updatePage(e,'selectAll'); });
</script>