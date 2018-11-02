<script src="/js/highcharts/highcharts.js"></script>
<script src="/js/highcharts/modules/exporting.js"></script>
<script src="/js/highcharts/modules/offline-exporting.js"></script>
<body>
<section id="prove-product-cat-config">
<div class="container">
    <div class="page-header">
        <h1>Panel de Reportes <small><?php echo EMPRESA; ?></small></h1>
    </div>
    <?php if (!empty($this->msg->hasMessages())) { $this->msg->display(); }
    include VIEWS.'/reportes/helper/navegacion.php';
    ?>



    <div class="row">
        <div class="col-xs-12">
            <br>
            <div id="reportes">
                <div id="reportes">
                    <div class="col-sm-12">
                        <div class="text-primary text-center"><h1>Estadisca de ventas de Hoy</h1></div>
                            <div id="hoy" style="min-width: 310px; height: 400px; "></div>
                    </div>
                </div>
                <div id="reportes">
                    <div class="col-sm-12">
                        <div class="text-primary text-center"><h1> Estadisca de ventas Ultimo 7 Dias</h1></div>
                        <div id="semana" style="min-width: 310px; height: 400px; "></div>
                    </div>
                </div>
                <div id="reportes">
                    <div class="col-sm-12">
                        <div class="text-primary text-center"><h1> Estadisca de ventas del ultimo Mes</h1></div>
                        <div id="mes" style="min-width: 310px; height: 400px; "></div>
                    </div>
                </div>
            <!--
                <div id="reportes">
                    <div class="col-sm-12">
                        <div class="text-primary text-center"><h1> Estadisca de ventas del ultimo Trimestre</h1></div>
                        <div id="trimestre" style="min-width: 310px; height: 400px; "></div>
                    </div>
                </div>
            -->
            </div>
        </div>
    </div>
</div>
</section>
</body>
<?php


    $semana = array (
      array(''.$reporte_dia1[0].'',0),
      array(''.$reporte_dia2[0].'',1),
      array(''.$reporte_dia3[0].'',2),
      array(''.$reporte_dia4[0].'',3),
      array(''.$reporte_dia5[0].'',4),
      array(''.$reporte_dia6[0].'',5),
      array(''.$reporte_dia7[0].'',6)
    );
    $trimestre = array (
        array (''.$reporte_mes3[0].'',0),
        array (''.$reporte_mes2[0].'',1),
        array (''.$reporte_mes1[0].'',2)
    );
    $mes = array (
        array(''.$reporte_semana1[0].'',0),
        array(''.$reporte_semana2[0].'',1),
        array(''.$reporte_semana3[0].'',2),
        array(''.$reporte_semana4[0].'',3)
    );


?>

<script type="text/javascript">

   Highcharts.chart('hoy', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo EMPRESA; ?>'
    },
    subtitle: {
        text: 'Estadistica de Ventas'
    },
    xAxis: {
       categories:[
        'Hoy'
        ],
        crosshair: true,

    },

    yAxis: {
        min: 0,
        title: {
            text: 'Rango (B.F)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            pointStart:0
        }
    },
    series: [  {
                name: 'Total',
                     data: (function() {
                        var data = [<?php echo $repo_dia[0]; ?>];

                return data;
                     })()
                }
            ]

});
   Highcharts.chart('semana', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo EMPRESA; ?>'
    },
    subtitle: {
        text: 'Estadistica de Ventas'
    },
    xAxis: {
       categories:[
        'Dia 1',
        'Dia 2',
        'Dia 3',
        'Dia 4',
        'Dia 5',
        'Dia 6',
        'Dia 7'
        ],
        crosshair: true,

    },

    yAxis: {
        min: 0,
        title: {
            text: 'Rango (B.F)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            pointStart:0
        }
    },
    series: [  {
                name: 'Total',
                     data: (function() {
                        var data = [];
                    <?php
                        for($i = 0 ;$i<count($semana);$i++){
                    ?>
                    data.push([<?php echo $semana[$i][0];?>]);
                    <?php } ?>
                return data;
                     })()
            }]

});
      Highcharts.chart('mes', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo EMPRESA; ?>'
    },
    subtitle: {
        text: 'Estadistica de Ventas'
    },
    xAxis: {
       categories:[
        'Semana1',
        'Semana2',
        'Semana3',
        'Semana4'

        ],
        crosshair: true,
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Rango (B.F)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            pointStart:0
        }
    },
    series: [  {
                name: 'Total',
                     data: (function() {
                        var data = [];
                    <?php
                        for($i = 0 ;$i<count($mes);$i++){
                    ?>
                    data.push([<?php echo $mes[$i][0];?>]);
                    <?php } ?>
                return data;
                     })()
            }]

});
      /*
      Highcharts.chart('trimestre', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo EMPRESA; ?>'
    },
    subtitle: {
        text: 'Estadistica de Ventas'
    },
    xAxis: {
       categories:[
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
        ],
        crosshair: true,
        //min:0,
        //max:11,


    },

    yAxis: {
        min: 0,
        title: {
            text: 'Rango (B.F)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0,
            pointStart:<?php echo $mesIni -1; ?>
        }
    },
    series: [  {
                name: 'Total',
                     data: (function() {
                        var data = [];
                    <?php
                        for($i = 0 ;$i<count($trimestre);$i++){
                    ?>
                    data.push([<?php echo $trimestre[$i][0];?>]);
                    <?php } ?>
                return data;
                     })()
            }]

});*/
</script>
