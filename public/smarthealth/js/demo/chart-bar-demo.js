// Set new default font family and font color to mimic Bootstrap's default styling
//Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
//Chart.defaults.global.defaultFontColor = '#858796';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");

if(ctx) {
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["General", "Accounts & profile", "Payments & billings", "Medical services", "Medical records", "Appointments"],
	  
      datasets: [{
        label: "Incidents",
        backgroundColor: "#00425F",
        hoverBackgroundColor: "#00425F",
		borderRadius: {
			topRight: 10,
			topLeft: 10
		},
        barThickness: 30,
        borderSkipped: false,
        borderColor: "#00425F",
        data: [0, 25, 50, 75, 100, 125],
		grid: {
            display: false,
            drawBorder: false
        },
      }],
    },
    options: {
      maintainAspectRatio: false,
	  grid: 1,
      layout: {
        padding: {
          left: 5,
          right: 25,
          top: 25,
          bottom: 0
        },
      },
      scales: {
	
        x: {
			grid: {
			  display: false,
			  drawBorder: true,
			  drawOnChartArea: true,
			  drawTicks: true,
			}
		  },
        y:  {
			grid: {
			  display: true,
			  drawBorder: false,
			  drawOnChartArea: true,
			  drawTicks: true,
			}
		  },
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + tooltipItem.yLabel;
          }
        }
      },
    }
  });
}