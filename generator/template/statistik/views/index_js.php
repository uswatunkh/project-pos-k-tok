<script type="text/javascript">
$(function () {
    // Create the chart
    $('.loader').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Statistik'
        },
        subtitle: {
            text: 'Pengunjung Website'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Jumlah'
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
                    format: '{point.y:f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> <br/>'
        },

        series: [{
            name: 'Pengunjung',
            colorByPoint: true,
            data: [{
                name: 'Hari ini',
                y: <?= $this->data["this_day"]?>,
            }, {
                name: 'Minggu ini', 
                y: <?= $this->data["this_week"]?>,
            }, {
                name: 'Bulan ini',
                y: <?= $this->data["this_month"]?>,
            }]
        }]
    });
});
        </script>
    </head>
    <body>
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script> -->
<script src="<?= $this->config->item('assets')?>hightchart/highcharts.js"></script>
<script src="<?= $this->config->item('assets')?>hightchart/modules/data.js"></script>