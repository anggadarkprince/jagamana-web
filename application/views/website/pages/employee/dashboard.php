<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <script>
                        $(document).ready(function(){
                            var chart = $('.chart-employee');
                            if(chart.length){
                                chart.highcharts({
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Job Search Statistic'
                                    },
                                    subtitle: {
                                        text: 'Applied Request Monthly'
                                    },
                                    colors: ['#4bb9fe', '#8ad2ff', '#bae4ff', '#d1ecfd'],
                                    xAxis: {
                                        categories: [
                                            'Jan',
                                            'Feb',
                                            'Mar',
                                            'Apr',
                                            'May',
                                            'Jun',
                                            'Jul',
                                            'Aug',
                                            'Sep',
                                            'Oct',
                                            'Nov',
                                            'Dec'
                                        ]
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: 'Total (Accumulation)',
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
                                        name: 'Accept',
                                        data: [
                                            <?php
                                            if(isset($chart)){
                                            foreach($chart as $data):
                                                echo $data["accept"].",";
                                            endforeach;
                                            }
                                            ?>
                                        ]

                                    }, {
                                        name: 'Pending',
                                        data: [
                                            <?php
                                            if(isset($chart)){
                                            foreach($chart as $data):
                                                echo $data["pending"].",";
                                            endforeach;
                                            }
                                            ?>
                                        ]

                                    }, {
                                        name: 'Reject',
                                        data: [
                                            <?php
                                            if(isset($chart)){
                                            foreach($chart as $data):
                                                echo $data["reject"].",";
                                            endforeach;
                                            }
                                            ?>
                                        ]

                                    }]
                                });


                            }
                        })
                    </script>
                    <div class="chart chart-wrapper">
                        <div class="chart-employee"></div>
                    </div>
                    <div class="statistic">
                        <div class="statistic-item">
                            <i class="fa fa-file-text"></i>
                            <p class="counter">
                                <?php
                                if(isset($statistic_applied))
                                {
                                    echo $statistic_applied;
                                }
                                ?>
                            </p>
                            <p class="title">APPLIED</p>
                        </div>
                        <div class="statistic-item">
                            <i class="fa fa-medkit"></i>
                            <p class="counter">
                                <?php
                                if(isset($statistic_saved))
                                {
                                    echo $statistic_saved;
                                }
                                ?>
                            </p>
                            <p class="title">SAVED JOBS</p>
                        </div>
                        <div class="statistic-item">
                            <i class="fa fa-building"></i>
                            <p class="counter">
                                <?php
                                if(isset($statistic_following))
                                {
                                    echo $statistic_following;
                                }
                                ?>
                            </p>
                            <p class="title">FOLLOWING</p>
                        </div>
                    </div>
                    <div class="activity">
                        <p class="lead">Last Activity</p>
                        <ul class="list-unstyled list-border">
                            <?php
                                if(isset($activities)) {
                                    if(count($activities) == 0){
                                        echo "<p class='text-left'>No activities available</p>";
                                    }
                                    foreach ($activities as $activity):
                                        ?>

                                        <li>
                                            <span><?=$activity["eac_message"]?></span>
                                            <time class="pull-right timeago" datetime="<?=$activity["eac_created_at"]?>"><?=$activity["eac_created_at"]?></time>
                                        </li>

                                        <?php
                                    endforeach;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>