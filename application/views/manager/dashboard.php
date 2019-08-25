<?php $this->load->view('managertemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px; z-index:initial;">
    <?php $this->load->view('managertemplate/navbar') ?>
    <div style="margin-left:60px; margin-top:40px; height:100%;padding-top:20px;">
        <div class="row" style="padding-top: 20px; text-align:center; margin-right:4px;">
            <div class="col-md-12">
                <div class="panel">
                    <div class="jumbotron" id="chart" style="padding-top:36px; padding-bottom:36px; padding-left:32px;padding-right:48px;">
                        <?php foreach ($data1 as $d1) { }; ?>
                        <?php foreach ($data2 as $d2) { }; ?>
                        <?php foreach ($data3 as $d3) { }; ?>
                        <?php foreach ($data4 as $d4) { }; ?>
                        <?php foreach ($data5 as $d5) { }; ?>
                        <?php foreach ($data6 as $d6) { }; ?>
                        <?php foreach ($data7 as $d7) { }; ?>
                        <?php foreach ($data8 as $d8) { }; ?>
                        <?php foreach ($data9 as $d9) { }; ?>
                        <?php foreach ($data10 as $d10) { }; ?>
                        <?php foreach ($data11 as $d11) { }; ?>
                        <?php foreach ($data12 as $d12) { }; ?>
                        <?php foreach ($data13 as $d13) { }; ?>
                        <?php foreach ($data14 as $d14) { }; ?>
                        <?php foreach ($data15 as $d15) { }; ?>
                        <script type="text/javascirpt">

                        </script>
                        <p style="font-size: 40px;">...</p>
                    </div>
                    <script type="text/javascript">
                        Highcharts.chart('chart', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Task'
                            },
                            xAxis: {
                                categories: ['<?php echo $tglm14 ?> - <?php echo $tglm8 ?>', '<?php echo $tglm7 ?> - <?php echo $tglm1 ?>', '<?php echo $today ?> - <?php echo $tgl6 ?>', '<?php echo $tgl7 ?> - <?php echo $tgl13 ?>', '<?php echo $tgl14 ?> - <?php echo $tgl20 ?>']
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Jumlah Task'
                                },
                                stackLabels: {
                                    enabled: true,
                                    style: {
                                        fontWeight: 'bold',
                                        color: ( // theme
                                            Highcharts.defaultOptions.title.style &&
                                            Highcharts.defaultOptions.title.style.color
                                        ) || 'gray'
                                    }
                                }
                            },
                            legend: {
                                align: 'right',
                                x: -30,
                                verticalAlign: 'top',
                                y: 25,
                                floating: true,
                                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                                borderColor: '#CCC',
                                borderWidth: 0,
                                shadow: false
                            },
                            tooltip: {
                                headerFormat: '<b>{point.x}</b><br/>',
                                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [{
                                name: 'Task Sedang Dikerjakan',
                                data: [<?php echo $d1->total ?>, <?php echo $d4->total ?>, <?php echo $d7->total ?>, <?php echo $d10->total ?>, <?php echo $d13->total ?>],
                                color: '#7ACBEE'
                            }, {
                                name: 'Task Menunggu Persetujuan Manager',
                                data: [<?php echo $d2->total ?>, <?php echo $d5->total ?>, <?php echo $d8->total ?>, <?php echo $d11->total ?>, <?php echo $d13->total ?>],
                                color: '#A3C86D'
                            }, {
                                name: 'Task Menunggu Persetujuan General Manager',
                                data: [<?php echo $d3->total ?>, <?php echo $d6->total ?>, <?php echo $d9->total ?>, <?php echo $d12->total ?>, <?php echo $d15->total ?>],
                                color: '#FF7857'
                            }]
                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
</body>