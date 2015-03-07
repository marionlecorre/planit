function getListInflow(id){
    $.ajax({
       url : '/api/lists/'+id+'/inflow', //API
       type : 'GET',
       dataType : 'json', // On désire recevoir du HTML
       success : function(inflows, statut){ // code_html contient le HTML renvoyé
            $.ajax({
               url : '/api/guestsinflows/'+id, //API
               type : 'GET',
               dataType : 'json', // On désire recevoir du HTML
               success : function(guests_inflows, statut){ // code_html contient le HTML renvoyé
                var data = {xA : []};
                var empty;
                // récupération des expenses
                if (inflows.inflows.length == 0 && guests_inflows == undefined) {
                  var obj =  {name: "Aucun apport",y: 1,sliced: false, selected: false};
                  data.xA.push(obj);
                  empty = true;
                }
                else {
                    if (inflows.inflows.length != 0){
                      $.each(inflows.inflows, function(key, val) {
                        var totalprice =1;
                        // récupération du prix total d'une catégorie                
                        totalprice += (val['amount'])
                        // création de l'objet avec nom et prix
                        var obj =  {name: val['name'],y: totalprice,sliced: false, selected: false};
                        data.xA.push(obj);
                        empty= false;
                      });
                    }

                    if(inflows.base != 0){
                        var obj =  {name: 'Apport personnel',y: inflows.base,sliced: false, selected: false};
                        data.xA.push(obj);
                        empty= false;
                    }

                    if(guests_inflows != undefined){
                        var obj =  {name: 'Inscriptions',y: guests_inflows,sliced: false, selected: false};
                        data.xA.push(obj);
                        empty= false;
                    }
                }
                chartApport(data['xA'],empty);
                
                
               },
               error : function(resultat, statut, erreur){
                    alert(erreur);
                },
            });
        
        
       },
       error : function(resultat, statut, erreur){
            alert(erreur);
        },
    });
}

function chartApport(datas,empty){   
        // Build the chart
    var color;
    if(empty){
    	color = ['#DFDEDE'];
    }
    else {
    	color = ['#847299', '#4a3c63','#64527c',"#9075b1"];
    }
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
                showInLegend: false,
                fillOpacity: 0.1
            }
        },
        series: [{
            type: 'pie', 
            colors: color,   
            data: datas
        }]       
    });

}



