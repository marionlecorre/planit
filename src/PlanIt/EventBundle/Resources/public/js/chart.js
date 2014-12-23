/*$(function () {

    Highcharts.setOptions({
     colors: ['#e56454', '#a5cd7d']
    });

    $(document).ready(function () {

        // Build the chart
        chart = new Highcharts.Chart({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                renderTo: 'pie_chart'
            },
            title: {
                text: ''
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
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Balance du budget',
                color: '#0066FF',         
                data: [
                    {
                        name: 'Dépenses',
                        y: 45.0,
                        sliced: true,
                        selected: false
                    },
                    {
                        name: 'Apports',
                        y: 55.0,
                        sliced: false,
                        selected: false
                    }
                ]
            }]       
        });
    });
});*/
function getMaxDivHeight(){
  var maxHeight = 0;
  $('.event-thumbnail').each(function(i){
    if(this.offsetHeight > maxHeight)
      maxHeight = this.offsetHeight;
  });
  return maxHeight;
}
$('.listing-events').height(getMaxDivHeight());
$('.add.event-thumbnail').css("line-height",getMaxDivHeight()+"px");


});
