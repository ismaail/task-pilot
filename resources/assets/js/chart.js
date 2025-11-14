/* global timeChart */

import Chart from 'chart.js/auto';

/**
 * @see https://www.chartjs.org/docs/latest/charts/bar.html
 */

const data= {
	labels: timeChart.labels,
	datasets: [{
		label: 'Timelogs',
		data: timeChart.data,
		//borderColor: '#022f4e',
		backgroundColor: '#91c27c',
		//barThickness: 10,
		barPercentage: 0.8,
		borderRadius: 4,
	}]
};

const $elm = document.querySelector('#time-chart');

new Chart($elm, {
	type: 'bar',
	data: data,
	options: {
		indexAxis: 'x',
		scales: {
			y: {
				ticks: {
					min: 0, max: 240, stepSize: 15,// suggestedMin: 0.5, suggestedMax: 5.5,
					callback: (totalMinutes) => {
						const hours = Math.floor(totalMinutes / 60);
						const minutes = totalMinutes % 60;

						return (hours > 0) ? `${hours}H${0 !== minutes ? ` ${minutes}` : ''}` : `${minutes} min`;
					},
				},
			},
		},
		plugins: {
			tooltip: {
				callbacks: {
					/** @see https://www.chartjs.org/docs/latest/configuration/tooltip.html */
					label: (context) => {
						const totalMinutes = context.formattedValue;
						const hours = Math.floor(totalMinutes / 60);
						const minutes = totalMinutes % 60;

						return (hours > 0) ? ` ${hours}H${0 !== minutes ? ` ${minutes}min` : ''}` : ` ${minutes} min`;
					},
				},
			},
		},
	},
});
