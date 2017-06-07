<div class="container">
	<h4>Real time values</h4>
	<div class="realtime row">
		<div class="col s6 m3">
			<h5>Temperature</h5>
			<div class="circle red-border">
				<span></span>
				<div class="inner-box">
					&deg;C
				</div>
			</div>
		</div>
		<div class="col s6 m3">
			<h5>Humidity</h5>
			<div class="circle purple-border">
				<span></span>
				<div class="inner-box">
					%
				</div>
			</div>
		</div>
		<div class="col s6 m3">
			<h5>Air pressure</h5>
			<div class="circle blue-border">
				<span></span>
				<div class="inner-box">
					Hg
				</div>
			</div>
		</div>
		<div class="col s6 m3">
			<h5>Air quality</h5>
			<div class="circle green-border">
				<span></span>
				<div class="inner-box">
				%
				</div>
			</div>
		</div>
		<div class="col s6 m3">
			<h5>Rain gauge</h5>
			<div class="circle orange-border">
				<span></span>
				<div class="inner-box">
					m&sup2;
				</div>
			</div>
		</div>
		<div class="col s6 m3">
			<h5>Wind speed</h5>
			<div class="circle yellow-border">
				<span></span>
				<div class="inner-box">
					km/h
				</div>
			</div>
		</div>
		<div class="col s6 m3">
			<h5>Wind direction</h5>
				<div class="circle grey-border">
				<span></span>
				<div class="inner-box">
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
		<div class="col m4">
			<input type="checkbox" id="Wind-speed" checked>
			<label for="Wind-speed">Wind speed</label>
		</div>
	</div>
</div>
<!-- <div class="fixed-action-btn">
	<a class="btn-floating btn-large red">
		<i class="large material-icons">mode_edit</i>
	</a>
	<ul>
		<li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
		<li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
		<li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
		<li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
	</ul>
</div> -->
<script type="text/javascript">
	// window.setInterval(function(){
		//Refreshing the realtime data every 5 seconds
		updatePage($('div.row.checkboxes')[0].innerText,'selectLast')
	// }, 5000);

	//Update onresize because default graph is empty
	window.onresize = function(event){
	    updatePage($('div.row.checkboxes')[0].innerText,'selectAll')
	}

	$('div.row.checkboxes').on('change',function(e){ e.preventDefault(); $('p.info').hide(); updatePage(e,'selectAll'); });
</script>