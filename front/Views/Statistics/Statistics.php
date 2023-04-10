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
                            <h3 id="StudyObject"></h3>
                            <p>Objetos de estudio</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-solid fa-graduation-cap fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success shadow">
                        <div class="inner">
                            <h3 id="Subject"></h3>
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
                            <h3 id="Teacher" ></h3>
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
                            <h3 id="AssignStudyObject"></h3>
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
                            <div id="SO_component"></div>
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
                            <div id="SO_teacher_subject"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="charts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="SO_component_subject"></div>
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

    
    function SO_component(data) {
        data = data.map(function (obj) {
            let item ={};
            item.name = obj.nombre;
            item.y = parseInt(obj.amount);
            return item;
        });
        Highcharts.chart('SO_component', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Objetos de estudio asignados por componente'
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
                name: 'Objetos de estudio',
                data: data
            }]
        });
    }
    getStatisticWithFunction('studyObjectComponent', SO_component);

</script>

<script>
        // Set up the chart

    function subject_component(data){
        data = data.map(function (obj) {
            let item =[obj.nombre, parseInt(obj.amount)];
            //item[obj.nombre] = parseInt(obj.amount);
            return item;
        });
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
                data: data
            }]
        });
    }
    getStatisticWithFunction('subjectComponent', subject_component);
</script>

<script>
    function study_object_teacher_subject(arrData){
        let study_object_teacher_subject = arrData;
        let description = study_object_teacher_subject.map(obj =>{
            return obj.descripcion;
        });
        let amount_subject = study_object_teacher_subject.map(obj =>{
            return parseInt(obj.amount_subject);
        });
        let amount_teacher = study_object_teacher_subject.map(obj =>{
            return parseInt(obj.amount_teacher);
        });
        Highcharts.chart('SO_teacher_subject', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Objetos de estudio - Docentes y Asignaturas'
            },
            xAxis: {
                categories: description
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
                data: amount_subject
    
            }, {
                name: 'Docentes',
                marker: {
                    symbol: 'diamond'
                },
                data: amount_teacher
            }]
        });
    }
    getStatisticWithFunction('studyObjectTeacherSubject', study_object_teacher_subject);

</script>

<script>
        // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar
    // Create the chart
    function study_object_component(data){
        let study_object_component = data[0].map(obj =>{
            return {name: obj.nombre, y: parseInt(obj.amount), drilldown: obj.nombre};
        });
        let study_object_subject_component =[];
        for (const key in data[0]) {
            const component = data[0][key];
            let filter = data[1].filter(obj =>{
                return obj.compo === component.nombre;
            });
            filter = filter.map(obj=>{
                return [obj.nombre,parseInt(obj.amount)];
            });
            study_object_subject_component.push({name: component.nombre, id: component.nombre, data: filter});
        }
        Highcharts.chart('SO_component_subject', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Objetos de estudio asignados, distribuidos en componentes y asignaturas'
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
                    text: 'Total objetos de estudio'
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
                    data: study_object_component
                }
            ],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: study_object_subject_component
                        <?php /*foreach($data['study_object_component'] as $value){
                            echo "{name:'".$value['nombre']."',id:'".$value['nombre']."', data:[";
                            foreach($data['study_object_subject_component'] as $key=>$valueComp){
                                if($valueComp['compo'] == $value['nombre']){
                                    echo "['".$valueComp['nombre']."',".$valueComp['amount']."],";
                                }
                            }
                            echo "]},";*/
                        //} ?>
                
            }
        });
    }
    let arrMethods = new Array('studyObjectComponent','studyObjectSubjectComponent');
    getStatisticWithFunctionMultipleParams(arrMethods, study_object_component);
</script>

