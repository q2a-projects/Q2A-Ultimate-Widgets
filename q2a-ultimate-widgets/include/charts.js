function draw_chart (element, type, datasets, labels) {
	new Chart(document.getElementById(element), {
		type: type,
		data: {
			labels: labels,
			datasets: datasets,
		},
	});
}
