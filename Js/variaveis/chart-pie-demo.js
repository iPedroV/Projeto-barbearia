// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

//esse é de lucro
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Cortes", "Unhas", "Escovas"],
    datasets: [{
      data: [55, 30, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
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
//esse é de despesa
var ctx = document.getElementById("myPieChart2");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Aluguel", "Água", "Luz", "Irmã"],
    datasets: [{
      data: [55, 30, 15, 25],
      backgroundColor: ['#eda85f', '#955ed1', '#edca61', '#eb5963' ],
      hoverBackgroundColor: ['#f59b3b', '#660ec9', '#ffc107', '#e81523'],
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
