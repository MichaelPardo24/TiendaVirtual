<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class=" py-10" id="graphicProducts"></div>
    </div>
    <script>
        Highcharts.chart('graphicProducts', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'PRODUCTOS'
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
                    text: 'Cantidad en stock'
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
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
            },

            series: [
                {
                    colorByPoint: true,
                    data: <?= $pointsProduct ?>
                }
            ]
        });
    </script>
</x-app-layout>