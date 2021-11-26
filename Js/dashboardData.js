


$(document).ready(function () {



    makechart();

    function makechart() {
        $.ajax({
            url: "data.php",
            method: "POST",
            data: {
                action: 'fetch'
            },
            dataType: "JSON",
            success: function (data) {
                var valortotal = [];
                var teste = [];
                var total = [];
                var total1 = [];
                var total2 = [];
                var total3 = [];
                var total4 = [];
                var total5 = [];
                var total6 = [];
                var total7 = [];
                var color = [];
                var dia = [];
                var seg = [];
                var ter = [];
                var qua = [];
                var qui = [];
                var sex = [];
                var sab = [];
                var dom = [];

                for (var count = 0; count < data.length; count++) {
                    valortotal.push(data[count].valortotal);
                    total.push(data[count].total);
                    color.push(data[count].color);
                    color.push(data[count].color);
                    seg = "Seg"
                    ter = "Ter"
                    qua = "Seg"
                    qui = "Seg"
                    sex = "Sex"
                    sab = "Sab"
                    dom = "Dom"
                    if (data[count].dia == "Monday") {
                        total1.push(data[count].total);
                        seg.push(data[count].data);
                    }
                    if (data[count].dia == "Tuesday") {
                        total2.push(data[count].total);
                        ter.push(data[count].data);
                    }
                    if (data[count].dia == "Wednesday") {
                        total3.push(data[count].total);
                        qua.push(data[count].data);
                    }
                    if (data[count].dia == "Thursday") {
                        total4.push(data[count].total);
                        qui.push(data[count].data);
                    }
                    if (data[count].dia == "Friday") {
                        total5.push(data[count].total);
                        sex.push(data[count].data);
                    } 
                    if (data[count].dia == "Saturday") {
                        total6.push(data[count].total);
                        sab.push(data[count].data);
                    }
                    if (data[count].dia == "Sunday") {
                        total7.push(data[count].total);
                        dom.push(data[count].data);
                    }


                }

                var chart_data = {
                    labels: [seg, ter, qua, qui, sex, sab, dom],
                    datasets: [{
                        label: 'Total em R$',
                        backgroundColor: color,
                        data: [total1, total2, total3, total4, total5, total6, total7],
                    }],
                };

                var options = {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0
                            }
                        }]
                    }
                };

                var group_chart1 = $('#pie_chart');

                var graph1 = new Chart(group_chart1, {
                    type: "pie",
                    data: chart_data
                });

                var group_chart2 = $('#doughnut_chart');

                var graph2 = new Chart(group_chart2, {
                    type: "doughnut",
                    data: chart_data
                });

                var group_chart3 = $('#bar_chart');

                var graph3 = new Chart(group_chart3, {
                    type: 'bar',
                    data: chart_data,
                    options: options
                });
            }
        })
    }

});