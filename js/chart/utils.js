window.chartColors = [
	['Temperature', 'rgb(255, 99, 132)'], //Red
	['Air-pressure', 'rgb(54, 162, 235)'], //Blue
	['Air-quality' ,'rgb(75, 192, 192)'], //green
	['Wind-speed' ,'rgb(255, 205, 86)'], //yellow
	['Humidity' ,'rgb(153, 102, 255)'], //purple
	['Rain-gauge' ,'rgb(255, 159, 64)'], //orange
	['Wind-direction' ,'rgb(231,233,237)'] //grey
];

window.randomScalingFactor = function() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}