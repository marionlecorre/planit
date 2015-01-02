$(function () {

    $(document).ready(function () {

        // Build the chart
        chart = new Highcharts.Chart({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                renderTo: 'pie_chart_apports'
            },
            title: {
                text: 'Diagramme des apports',
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
                colors: ['#847299', '#4a3c63','#64527c',"#9075b1"],     
                data: [ 
                        {name: 'Invités', y: 25.0, sliced: false, selected: false},
                        {name: 'Mami', y: 45.0, sliced: false, selected: false},
                        {name: 'Dons', y: 50.0, sliced: false, selected: false},
                        {name: 'Perso', y: 10.0, sliced: false, selected: false}
                     ]
            }]       
        });
    });


});


