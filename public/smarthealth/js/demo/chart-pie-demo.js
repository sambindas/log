// Set new default font family and font color to mimic Bootstrap's default styling
//Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
//Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx1 = document.getElementById("myPieChart");
if(ctx1) {
	var myPieChart = new Chart(ctx1, {
		type: 'doughnut',
		data: {
		  labels: ["Direct", "Referral", "Social"],
		  datasets: [{
			data: [20, 30, 50],
			backgroundColor: ['#99E3F2', '#6CC5D8', '#00425F'],
			hoverBackgroundColor: ['#99E3F2', '#6CC5D8', '#00425F'],
			hoverBorderColor: "#00425F",
			// barThickness: 5,
			// borderWidth: 10,
			// hoverOffset: 4
		  }],
		},
		options: {
		  maintainAspectRatio: false,
		  tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: '#dddfeb',
			borderWidth: 5,
			barThickness: 5,
			xPadding: 25,
			yPadding: 25,
			displayColors: false,
			caretPadding: 20,
		  },
		  legend: {
			display: false
		  },
		  cutoutPercentage: 80,
		},
	  });
}

var ctx2 = document.getElementById("myPieChart2");

if(ctx2) {
	var myPieChart2 = new Chart(ctx2, {
		type: 'doughnut',
		data: {
		  labels: ["Direct", "Referral", "Social"],
		  datasets: [{
			data: [20, 30, 50],
			backgroundColor: ['#99E3F2', '#6CC5D8', '#00425F'],
			hoverBackgroundColor: ['#99E3F2', '#6CC5D8', '#00425F'],
			hoverBorderColor: "rgba(234, 236, 244, 1)",
		  }],
		},
		options: {
		  maintainAspectRatio: false,
		  tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: '#dddfeb',
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: false,
			caretPadding: 10,
		  },
		  legend: {
			display: false
		  },
		  cutoutPercentage: 80,
		},
	  });
}

