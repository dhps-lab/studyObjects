<?php pageHeader($data);?>
    <div class="row justify-content-center" id="general-title">
        <div class="col-11">
            <h3><?= $data['page_title'];?></h3>
        </div>
    </div>
    <div class="row justify-content-center" id="widgets-sts">
        <div class="col-11">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary shadow">
                        <div class="inner">
                            <h3><?= $data['amount_learning_result'];?></h3>
                            <p>Resultados de aprendizaje</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-solid fa-graduation-cap fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success shadow">
                        <div class="inner">
                            <h3><?= $data['amount_subject'];?></h3>
                            <p>Espacios académicos</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-solid fa-brain fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger shadow">
                        <div class="inner">
                            <h3><?= $data['amount_teacher'];?></h3>
                            <p>Docentes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-solid fa-person-chalkboard fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning shadow">
                        <div class="inner">
                            <h3><?= $data['amount_assign_learning_result'];?></h3>
                            <p>Asignaciones</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-solid fa-arrow-right-arrow-left fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row" id="charts">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="LR_component"></div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                    <div class="card-body">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="charts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="LR_teacher_subject"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="charts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="LR_component_subject"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php footer($data);?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/cylinder.js"></script>
<script src="https://code.highcharts.com/modules/funnel3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] 
                ]
            };
        })
    });

    Highcharts.chart('LR_component', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Resultados de aprendizaje asignados por componente'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Resaultados de aprendizaje',
            data: [
                <?php foreach($data['learning_result_component'] as $value){
                    echo "{name:'".$value['nombre']."',y:".$value['amount']."},";
                } ?>
            ]
        }]
    });

</script>

<script>
        // Set up the chart
    Highcharts.chart('container', {
        chart: {
            type: 'funnel3d',
            options3d: {
                enabled: true,
                alpha: 10,
                depth: 50,
                viewDistance: 50
            }
        },
        title: {
            text: 'Asignaturas por componente'
        },
        accessibility: {
            screenReaderSection: {
                beforeChartFormat: '<{headingTagName}>{chartTitle}</{headingTagName}><div>{typeDescription}</div><div>{chartSubtitle}</div><div>{chartLongdesc}</div>'
            }
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                    allowOverlap: true,
                    y: 10
                },
                neckWidth: '30%',
                neckHeight: '25%',
                width: '80%',
                height: '80%'
            }
        },
        series: [{
            name: 'Asignaturas',
            data: [
                <?php foreach($data['subject_component'] as $value){
                    echo "['".$value['nombre']."',".$value['amount']."],";
                } ?>
            ]
        }]
    });
</script>

<script>
    Highcharts.chart('LR_teacher_subject', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Resultados de aprendizaje - Docentes y Asignaturas'
        },
        xAxis: {
            categories: [<?php foreach($data['learning_result_teacher_subject'] as $value){
                        echo "'".$value['descripcion']."',";
                    } ?>]
        },
        yAxis: {
            title: {
                text: 'Cantidad'
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                cursor: 'pointer'
            }
        },
        series: [{
            name: 'Espacios académicos',
            marker: {
                symbol: 'square'
            },
            data: [<?php foreach($data['learning_result_teacher_subject'] as $value){
                        echo $value['amount_subject'].",";
                    } ?>]

        }, {
            name: 'Docentes',
            marker: {
                symbol: 'diamond'
            },
            data: [<?php foreach($data['learning_result_teacher_subject'] as $value){
                        echo $value['amount_teacher'].",";
                    } ?>]
        }]
    });

</script>

<script>
        // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar
    // Create the chart
    Highcharts.chart('LR_component_subject', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'left',
            text: 'Resultados de aprendizaje asignados, distribuidos en componentes y asignaturas'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total resultados de aprendizaje'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
        },

        series: [
            {
                name: "Browsers",
                colorByPoint: true,
                data: [
                    <?php foreach($data['learning_result_component'] as $value){
                        echo "{name:'".$value['nombre']."',y:".$value['amount'].",drilldown: '".$value['nombre']."'},";
                    } ?>
                ]
            }
        ],
        drilldown: {
            breadcrumbs: {
                position: {
                    align: 'right'
                }
            },
            series: [
                    <?php foreach($data['learning_result_component'] as $value){
                        echo "{name:'".$value['nombre']."',id:'".$value['nombre']."', data:[";
                        foreach($data['learning_result_subject_component'] as $key=>$valueComp){
                            if($valueComp['compo'] == $value['nombre']){
                                echo "['".$valueComp['nombre']."',".$valueComp['amount']."],";
                            }
                        }
                        echo "]},";
                    } ?>
            ]
        }
    });
</script>

