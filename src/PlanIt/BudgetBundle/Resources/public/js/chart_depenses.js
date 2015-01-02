$(function () {

    $(document).ready(function () {

        // Build the chart
        chart = new Highcharts.Chart({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                renderTo: 'pie_chart_depenses'
            },
            title: {
                text: 'Diagramme des dépenses',
                style: { "color": "#6a6a6a",fontSize:'14px'},
                verticalAlign: 'bottom',
            },
             credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            tooltip: {
                pointFormat: '{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: false,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: false
                }
            },
            series: [{
                type: 'pie', 
                colors: ['#b6413b', '#e56454','#ef7e75'],     
                data: [ 
                        {name: 'Boissons', y: 45.0, sliced: false, selected: false},
                        {name: 'Lieu', y: 25.0, sliced: false, selected: false},
                        {name: 'Transport', y: 30.0, sliced: false, selected: false},
                     ]
            }]       
        });
    });


});


