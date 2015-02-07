
function getListExpense(id){
    $.ajax({
       url : '/app_dev.php/api/lists/'+id+'/expense', //API
       type : 'GET',
       dataType : 'json', // On désire recevoir du HTML
       success : function(list, statut){ // code_html contient le HTML renvoyé
        var data = {xA : []};
        var totalprice =1;
        var empty;
        // récupération des expenses
        if (list.length == 0) {
          var obj =  {name: "Aucun apport",y: totalprice,sliced: false, selected: false};
          data.xA.push(obj);
          empty = true;
        }
        else {
          $.each(list, function(key, val) {
            // récupération du prix total d'une catégorie
            if (val['expenses'].length != 0){
              $.each(val['expenses'],function(key,val){
                totalprice += (val['price']*(val['quantity']-val['stock']));
              });
            }
            // création de l'objet avec nom et prix
            var obj =  {name: val['name'],y: totalprice,sliced: false, selected: false};
            data.xA.push(obj);
            empty = false;
          });
        }
        chartDepense(data['xA'], empty); 
        
        
       },
       error : function(resultat, statut, erreur){
            alert(erreur);
        },
    });
}

function chartDepense(datas, empty){
  var color;
    if(empty){
      color = ['#DFDEDE'];
    }
    else {
      color = ['#b6413b', '#e56454','#ef7e75'];
    }
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
            colors: color,     
            data: datas
        }]       
    });
}








