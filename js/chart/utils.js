window.chartColors = [
	['Temperatuur', 'rgb(255, 99, 132)'], //Red
	['Luchtdruk', 'rgb(54, 162, 235)'], //Blue
	// orange: 'rgb(255, 159, 64)',
	// yellow: 'rgb(255, 205, 86)',
	// green: 'rgb(75, 192, 192)',
	// purple: 'rgb(153, 102, 255)',
	// grey: 'rgb(231,233,237)'
];

window.randomScalingFactor = function() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}