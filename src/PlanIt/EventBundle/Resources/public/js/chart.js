function getInfos(event_id){
    $.ajax({
       url : '/app_dev.php/api/events/'+event_id, //API
       type : 'GET',
       dataType : 'json', // On désire recevoir du HTML
       success : function(data, statut){ // code_html contient le HTML renvoyé
                var inflows = data.total_inflows;
                if(data.guests_inflow != undefined){
                    inflows += data.guests_inflow;
                }
                var expenses = data.total_expenses;
                var data = {xA : []};
                var empty;
                // récupération des expenses
                if (inflows == 0 && expenses == 0) {
                  var obj =  {name: "Aucune information",y: 1,sliced: false, selected: false};
                  data.xA.push(obj);
                  empty = true;
                }
                else {
                    if(expenses != 0){
                        var obj =  {name: 'Dépenses',y: expenses,sliced: false, selected: false};
                        data.xA.push(obj);
                        empty= false;
                    }

                    if(inflows!= 0){
                        var obj =  {name: 'Apports',y: inflows,sliced: false, selected: false};
                        data.xA.push(obj);
                        empty= false;
                    }
                }
                chart(data['xA'],empty);        
        
       },
       error : function(resultat, statut, erreur){
            alert(erreur);
        },
    });

}

function chart(datas,empty){
    if(empty){
        color = ['#DFDEDE'];
    }
    else {
        color = ['#e56454', '#a5cd7d'];
    }
    Highcharts.setOptions({
             colors: color
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
                        data: datas
                    }]    
                });
                
            });
}



