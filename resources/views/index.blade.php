<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <title>Index</title>
	    <link rel="icon" type="/image/png" href="/img/favicon.png">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>


        <script src="/js/plugins/morris/morris.js"></script>
        <script src="/js/plugins/morris/raphael-2.1.0.min.js"></script>
        <link href="/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

        <script src="/js/plugins/flot/jquery.flot.js"></script>
        <script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="/js/plugins/flot/jquery.flot.resize.js"></script>
        <script src="/js/plugins/flot/jquery.flot.time.js"></script>
        <script src="/js/plugins/flot/jquery.flot.pie.js"></script>
        <script src="/js/plugins/flot/curvedLines.js"></script>
        <script src="/js/plugins/flot/excanvas.min.js"></script>
        <script src="/js/plugins/flot/jquery.flot.spline.js"></script>
        <script src="/js/plugins/flot/jquery.flot.symbol.js"></script>
    </head>
    <body class="page-index">
            <div class="tabs-container" style="margin:40px;">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#chart_tab">Pages Visits Chart</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="chart_tab" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <label class="label label-success" style="font-weight: bold;font-size: 15px;">Pages Views Summary</label>
                                    <div id="chart1" style="margin-bottom: 30px;"></div>
                                </div>
                                <div class="col-sm-6 col-sm-offset-3 text-center">
                                    <label class="label label-success" style="font-weight: bold;font-size: 15px;">Pages Views by Country</label>
                                    <div id="plot1" style="width:100%;height:300px;margin-top: 30px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
        function renderPie(data)
        {
            var chartData = [];

            chartData.push(['Country', 'Requests']);

            $.each(data, function(index, value){
                console.log(value);
                chartData.push({label: value.label, data: value.value});
            });

            var options = {
                series: {
                    pie: {
                        offset: {
                            left: 10
                        },
                        show: true
                    }
                },
                grid: {
                    hoverable: true,
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            };

            var chart = $.plot($("#plot1"), chartData, options);
            chart.draw();
        }

        $(document).ready(function(){
            $('#period_dropdown').on('change',function(){
                $('#form_chart_filter').submit();
            });

            Morris.Line({
                data: {!! json_encode($allData[0]) !!},
                element: 'chart1',
                xkey: 'date',
                ykeys: ['total'],
                resize: true,
                lineWidth: 2,
                labels: ['Pages Views'],
                lineColors: ['#1ab394'],
                pointSize:5,
                xLabels: "day"
            });

            renderPie({!! json_encode($allData[1]) !!});
        });
    </script>
    </body>
</html>
