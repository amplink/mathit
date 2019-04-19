

<script src="./js/Chart.min.js"></script>
<script src="./js/utils.js?v=20190414"></script>
<link rel="stylesheet" type="text/css" href="./css/chart_style.css?v=201904011">
<style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>

<div class="content">
    <div class="wrapper col-2" style="margin-left:-20px"><canvas id="chart-0"></canvas></div>
</div>

<script>
    var presets = window.chartColors;
    var utils = Samples.utils;
    var inputs = {
        min: 0,
        max: 100,
        count: <?=$max?>,
        decimals: 20,
        continuity: 1
    };

    var MONTHS = [
        <?
        $str = "";
        foreach ($from_date as $v){
            $str .= "'".substr($v,0,5)."',";
            //$str .= "'".$v."',";
        }
        echo substr($str, 0, -1);
        ?>
    ];
    function generateData(config) {
        return utils.numbers(Chart.helpers.merge(inputs, config || {}));
    }

    function generateLabels(config) {
        return utils.months(Chart.helpers.merge({
            count: inputs.count,
            section: 10
        }, config || {}));
    }

    var options = {
        maintainAspectRatio: false,
        spanGaps: false,
        elements: {
            line: {
                tension: 0.000001
            }
        },
        plugins: {
            filler: {
                propagate: false
            }
        },
        scales: {
            xAxes: [{
                ticks: {
                    autoSkip: false,
                    maxRotation: 0
                }
            }]
        }
    };
    <? if($_GET['flag']=='2' or $_GET['flag']=='1'){?>
    Chart.defaults.global.animation.duration = 1; //속도
    <?  }  ?>


    [false, 'origin', 'start', 'end'].forEach(function(boundary, index) {

        // reset the random seed to generate the same data for all charts
        utils.srand(8);
        var datapoints = [<?=$me_score?>];
        var datapoints2 = [<?=$tot_score?>];

        new Chart('chart-' + index, {
            type: 'line',
            data: {
                labels: generateLabels(),
                datasets: [{
                    backgroundColor: utils.transparentize(presets.red),
                    borderColor: presets.red,
                    data: datapoints,
                    label: '<?=$res['student']?>',
                    fill: boundary
                },{
                    backgroundColor: utils.transparentize(presets.blue),
                    borderColor: presets.blue,
                    data: datapoints2,
                    label: '학급평균',
                    fill: boundary
                }]
            },
            options: Chart.helpers.merge(options, {
                title: {
                    text: 'fill: ' + boundary,
                    display: false
                }
            })
        });
    });

    // eslint-disable-next-line no-unused-vars
    function toggleSmooth(btn) {
        var value = btn.classList.toggle('btn-on');
        Chart.helpers.each(Chart.instances, function(chart) {
            chart.options.elements.line.tension = value ? 0.4 : 0.000001;
            chart.update();
        });
    }

</script>
