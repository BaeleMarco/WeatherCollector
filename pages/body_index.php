<div class="container">
	<h4>Real time values</h4>
	<div class="realtime row">
		<div class="col s6 m4 l2">
			<h5>Temperature</h5>
			<div class="circle red-border">
				<span></span>
				<div class="inner-box">
					&#9679; 0.0&deg;C
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Air pressure</h5>
			<div class="circle blue-border">
				<span></span>
				<div class="inner-box">
					&#x25B2;3.2Pa
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
					&#x25BC;5.8m&sup2;
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Wind speed</h5>
			<div class="circle yellow-border">
				<span></span>
				<div class="inner-box">
					m/s
				</div>
			</div>
		</div>
		<div class="col s6 m4 l2">
			<h5>Wind direction</h5>
				<div class="circle purple-border">
				<span></span>
				<div class="inner-box">
				</div>
			</div>
		</div>
	</div>
	<h4 class="graph">Graph</h4>
	<canvas id="canvas" class="graph"></canvas>
	<div class="row checkboxes graph">
		<div class="col s6 l3">
			<input class="red-border" type="checkbox" id="Temperature" checked>
			<label for="Temperature">Temperature</label>
		</div>
		<div class="col s6 l3">
			<input type="checkbox" id="Air-pressure" checked>
			<label for="Air-pressure">Air pressure</label>
		</div>
		<div class="col s6 l3">
			<input type="checkbox" id="Air-quality" checked>
			<label for="Air-quality">Air quality</label>
		</div>
		<div class="col s6 l3">
			<input type="checkbox" id="Rain-gauge" checked>
			<label for="Rain-gauge">Rain gauge</label>
		</div>
		<div class="col s6 l3">
			<input type="checkbox" id="Wind-speed" checked>
			<label for="Wind-speed">Wind speed</label>
		</div>
		<div class="col s6 l3">
			<input type="checkbox" id="Wind-direction">
			<label for="Wind-direction">Wind direction</label>
		</div>
	</div>
</div>
<div class="fixed-action-btn">
	<a class="btn-floating btn-large red">
		<i class="large material-icons">mode_edit</i>
	</a>
	<ul>
		<li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
		<li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
		<li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
		<li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
	</ul>
</div>