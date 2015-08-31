<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="form-section">
                        <div class="title">
                            <h3><i class="fa fa-file"></i> Applications</h3>
                            <p>Your job proposal has sent</p>
                        </div>
                        <div class="mblg">
                            <table class="table table-striped table-hover table-responsive table-custom">
                                <thead>
                                <tr>
                                    <th width="10%" class="text-center"><i class="fa fa-circle-o"></i></th>
                                    <th width="25%" class="text-left">Job Title</th>
                                    <th width="25%" class="text-center">Company</th>
                                    <th width="20%" class="text-center">Sent Date</th>
                                    <th width="20%" class="text-center">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(isset($applications))
                                    {
                                        if(count($applications) == 0){
                                            echo "<tr><td colspan='5' class='text-center'>No job vacancy applied</td><tr>";
                                        }
                                        foreach($applications as $application):
                                            $permalink_job = permalink($application["vacancy"],$application["job_id"]);
                                            $permalink_company = permalink($application["company"],$application["company_id"]);
                                            ?>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                    <?php
                                                    if($application["job_id"] == null){
                                                        ?>

                                                        <td><span class="text-danger">This job has been removed</span></td>
                                                        <td class="text-center">-</td>

                                                    <?php
                                                    }
                                                    else{
                                                        ?>

                                                        <td><a href="<?=site_url()?>job/detail/<?=$permalink_job?>.html" target="_blank"><?=$application["vacancy"]?></a></td>
                                                        <td class="text-center"><a href="<?=site_url()?>company/detail/<?=$permalink_company?>.html" target="_blank"><?=$application["company"]?></a></td>


                                                    <?php
                                                    }
                                                    ?>

                                                    <td class="text-center"><?=date_format(date_create($application["created_at"]),"d F, Y")?></td>
                                                    <?php
                                                    $label = "";
                                                    if($application["status"] == "ACCEPT"){
                                                        $label = "label-success";
                                                    }
                                                    if($application["status"] == "PENDING"){
                                                        $label = "label-warning";
                                                    }
                                                    if($application["status"] == "REJECT"){
                                                        $label = "label-danger";
                                                    }
                                                    ?>
                                                    <td class="text-center"><span class="label <?=$label?>"><?=$application["status"]?></span></td>
                                                </tr>

                                            <?php
                                        endforeach;
                                    }
                                ?>
                                </tbody>
                            </table>
                            <a href="<?=site_url()?>job/all.html" class="btn btn-dash btn-block"><i class="fa fa-plus-circle"></i> MORE VACANCY</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>