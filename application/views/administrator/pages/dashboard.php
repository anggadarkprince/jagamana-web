<div class="title-section">
    <div class="title">
        <h1>Control Panel</h1>
        <div class="pull-right mtxs">
            <a href="#" class="btn-circle btn-o"><i class="fa fa-file-o"></i></a>
            <a href="#" class="btn-circle btn-o"><i class="fa fa-refresh"></i></a>
            <a href="#" class="btn-circle  btn-o"><i class="fa fa-trash"></i></a>
        </div>
    </div>
    <p class="subtitle">Welcome to control panel page of Jagamana, you have configure website settings and manage master data.
    Be careful with sensitive data, because some record could be lost forever.</p>
</div>
<div class="content-section container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="chart-wrapper">
                <div class="chart"></div>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        // chart example
        $('.chart').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Website Visitor Statistic'
            },
            subtitle: {
                text: 'Visitor Monthly Accumulation'
            },
            colors: ['#4bb9fe', '#8ad2ff', '#bae4ff', '#d1ecfd'],
            xAxis: {
                categories: [
                    <?php
                    foreach($visitor as $row):
                    echo "'".$row["mth_month"]."',";
                    endforeach;
                    ?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total (visitor)',
                    visible:'false'
                }
            },
            legend: {
                layout: 'horizontal',
                x: 0,
                borderWidth: 0
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Visitor',
                data: [
                    <?php
                    foreach($visitor as $row):
                    echo $row["vst_visitor"].",";
                    endforeach;
                    ?>
                ]

            }, {
                name: 'Hit',
                data: [
                    <?php
                    foreach($visitor as $row):
                    echo $row["vst_hit"].",";
                    endforeach;
                    ?>
                ]

            }]
        });

        $(".highcharts-title").attr("y",35);
        $(".highcharts-legend-item rect").attr("rx",0).attr("ry",0).attr("width",18).attr("height",18);
        $(".highcharts-legend-item text").attr("y",18);
        $(".highcharts-legend-item text tspan").attr("x", 25);
    });

</script>