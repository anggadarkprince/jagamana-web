<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <form class="form-horizontal" role="form">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-user-md"></i> Our People</h3>
                                <p>List of people you want applicants meet</p>
                            </div>

                            <div class="mblg">
                                <table class="table table-striped table-hover table-responsive table-custom">
                                    <thead>
                                    <tr>
                                        <th width="10%" class="text-center"><i class="fa fa-circle-o"></i></th>
                                        <th width="25%" class="text-left">Candidate</th>
                                        <th width="20%" class="text-center">Job</th>
                                        <th width="15%" class="text-center">Sent Date</th>
                                        <th width="15%" class="text-center">CV</th>
                                        <th width="15%" class="text-center">Resume</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if(isset($applicants))
                                    {
                                        if(count($applicants) == 0){
                                            echo "<tr><td colspan='6' class='text-center'>No job vacancy applied</td><tr>";
                                        }
                                        foreach($applicants as $applicant):
                                        ?>

                                            <tr>
                                                <td class="text-center"><i class="fa fa-circle-o"></i></td>
                                                <td>
                                                    <a href="<?=site_url()?>account/detail/<?=permalink($applicant["employee"],$applicant["employee_id"])?>.html" target="_blank">
                                                        <img src="<?=base_url()?>assets/img/avatar/<?=$applicant["employee_avatar"]?>" class="img-responsive img-circle avatar-table">
                                                        <span style="line-height: 30px"><?=$applicant["employee"]?></span>
                                                    </a>
                                                </td>
                                                <td><a href="<?=site_url()?>job/detail/<?=permalink($applicant["vacancy"],$applicant["job_id"])?>.html" target="_blank"><?=$applicant["vacancy"]?></a></td>
                                                <td class="text-center"><?=date_format(date_create($applicant["created_at"]),"d F Y")?></td>
                                                <td class="text-center">
                                                    <?php
                                                    $file = "No File";
                                                    if($applicant["employee_resume"] != null){
                                                        $file = "<a href='".base_url()."assets/data/".$applicant["employee_resume"]."'><i class='fa fa-file-o'></i> VIEW</a>";
                                                    }
                                                    ?>
                                                    <?=$file?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?=site_url()?>applicant/resume/<?=$applicant["employee_id"]?>.html"><i class="fa fa-file-pdf-o"></i> JAGAMANA</a>
                                                </td>
                                            </tr>

                                        <?php
                                        endforeach;
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>