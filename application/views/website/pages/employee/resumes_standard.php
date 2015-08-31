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
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Create JagaMana Resume</h3>
                                    <p>JagaMana Standard Resumes</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="<?=site_url()?>resume/generate.html" class="btn btn-primary pull-right"><i class="fa fa-print"></i> PRINT RESUME</a>
                                </div>
                            </div>
                        </div>
                        <!-- alert -->
                        <?php
                        if($this->session->flashdata('jm-operation')!= NULL)
                        {
                            ?>
                            <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php echo $this->session->flashdata('jm-message'); ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- end of alert -->

                        <!-- alert -->
                        <?php
                        if(isset($operation))
                        {
                            ?>
                            <div class="alert alert-<?=$operation?> alert-block alert-dismissible" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- end of alert -->
                        <div class="resume">
                            <div class="resume-section">
                                <h3>PERSONAL DETAIL</h3>
                                <div class="activity">
                                    <ul class="list-unstyled list-border">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Name</div>
                                                <div class="col-md-8"><strong><?=$employee["emp_name"]?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Day of Birthday</div>
                                                <?php
                                                $birthday = "-";
                                                if($employee["emp_birthday"] != null){
                                                    $birthday = date_format(date_create($employee["emp_birthday"]), "d F Y");
                                                }
                                                ?>
                                                <div class="col-md-8"><strong><?=$birthday?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Nationality</div>
                                                <div class="col-md-8"><strong><?=($employee["emp_nationality"]!=null)?$employee["emp_nationality"]:"-"?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Gender</div>
                                                <div class="col-md-8"><strong><?=($employee["emp_gender"]!=null)?ucfirst(strtolower($employee["emp_gender"])):"-"?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Address</div>
                                                <div class="col-md-8"><strong><?=($employee["emp_address"]!=null)?$employee["emp_address"]:"-"?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Contact</div>
                                                <div class="col-md-8"><strong><?=($employee["emp_contact"]!=null)?$employee["emp_contact"]:"-"?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Email</div>
                                                <div class="col-md-8"><strong><?=($employee["emp_email"]!=null)?$employee["emp_email"]:"-"?></strong></div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-md-4">Website</div>
                                                <div class="col-md-8"><strong><?=($employee["emp_website"]!=null)?$employee["emp_website"]:"-"?></strong></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn btn-dash btn-block" data-toggle="modal" data-target="#modal-resume-detail"><i class="fa fa-pencil-square-o"></i> EDIT PERSONAL</button>
                            <div class="resume-section">
                                <h3>PERSONAL PROFILE</h3>
                                <p><?=($employee["emp_about"]!=null)?$employee["emp_about"]:"No Profile Written"?></p>
                            </div>
                            <button type="button" class="btn btn-dash btn-block" data-toggle="modal" data-target="#modal-resume-profile"><i class="fa fa-pencil-square-o"></i> EDIT PROFILE</button>
                            <div class="resume-section">
                                <h3>EDUCATION</h3>
                                <div class="activity">
                                    <ul class="list-unstyled list-border">
                                        <?php
                                        if(isset($educations))
                                        {
                                            if(count($educations) == 0){
                                                echo "No educations written";
                                            }
                                            foreach($educations as $education):
                                                ?>

                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <p><strong class="row-title"><?=$education["edc_education"]?></strong></p>
                                                            <p><?=$education["edc_institution"]?></p>
                                                        </div>
                                                        <div class="col-sm-5 text-right">
                                                            <p><?=$education["edc_year_begin"]?> - <?=$education["edc_year_until"]?></p>
                                                            <p><?=$education["edc_location"]?></p>
                                                            <a href="<?=site_url()?>education/delete/" class="text-muted remove-list delete" data-id="<?=$education["edc_id"]?>" data-title="Education"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </li>

                                                <?php
                                            endforeach;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn btn-dash btn-block" data-toggle="modal" data-target="#modal-resume-education"><i class="fa fa-plus-circle"></i> ADD NEW EDUCATION</button>
                            <div class="resume-section">
                                <h3>EXPERIENCE</h3>
                                <div class="activity">
                                    <ul class="list-unstyled list-border">
                                        <?php
                                        if(isset($experiences))
                                        {
                                            if(count($experiences) == 0){
                                                echo "No experiences written";
                                            }
                                            foreach($experiences as $experience):
                                                ?>

                                                <li>
                                                    <div class="row">
                                                        <div class="col-sm-7">
                                                            <p><strong class="row-title"><?=$experience["exp_company"]?></strong></p>
                                                            <p><?=$experience["exp_description"]?></p>
                                                        </div>
                                                        <div class="col-sm-5 text-right">
                                                            <p><?=$experience["exp_year_begin"]?> - <?=$experience["exp_year_until"]?></p>
                                                            <p><?=$experience["exp_position"]?></p>
                                                            <a href="<?=site_url()?>experience/delete/" class="text-muted remove-list delete" data-id="<?=$experience["exp_id"]?>" data-title="Experience"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </li>

                                                <?php
                                            endforeach;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn btn-dash btn-block" data-toggle="modal" data-target="#modal-resume-experience"><i class="fa fa-plus-circle"></i> ADD NEW EXPERIENCE</button>
                            <div class="resume-section">
                                <h3>SKILLS & ATTRIBUTES</h3>
                                <div class="activity">
                                    <?php
                                    if(isset($skills))
                                    {
                                        if(count($skills) == 0){
                                            echo "No skills written";
                                        }
                                        foreach($skills as $skill):
                                            ?>

                                            <strong><?=$skill["category"]?></strong>
                                            <ul class="list-unstyled list-border">
                                                <?php
                                                foreach($skill["skill"] as $row):
                                                    ?>

                                                    <li>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <p class="row-title"><?=$row["skl_skill"]?></p>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <p><?=$row["skl_description"]?></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="skill-level text-right" data-skill="<?=$row["skl_value"]?>"></div>
                                                                <a href="<?=site_url()?>skill/delete/" class="text-muted remove-list delete" data-id="<?=$row["skl_id"]?>" data-title="Skill"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <?php
                                                endforeach;
                                                ?>

                                            </ul>
                                            <?php
                                        endforeach;
                                    }
                                    ?>

                                </div>
                            </div>
                            <button type="button" class="btn btn-dash btn-block" data-toggle="modal" data-target="#modal-resume-skill"><i class="fa fa-plus-circle"></i> ADD NEW SKILL</button>
                            <div class="resume-section">
                                <h3>PORTFOLIO</h3>
                                <p class="mbmd">I have been school, work and join training and this is my achievement and portfolio.</p>
                                <div class="row">
                                    <?php
                                    if(isset($portfolios))
                                    {
                                        $count = 0;
                                        foreach($portfolios as $portfolio):
                                            ?>

                                            <div class="col-md-4">
                                                <div class="select-image portfolio small mbmd">
                                                    <div class="image-wrapper">
                                                        <span class="row-title hidden"><?=$portfolio["prt_title"]." ".++$count?></span>
                                                        <img src="<?=base_url()?>assets/img/portfolio/<?=$portfolio["prt_screenshot"]?>" class="img-responsive select-image-preview"/>
                                                    </div>
                                                    <div class="link">
                                                        <a href="<?=site_url()?>portfolio/delete/" class="mrxs delete" data-id="<?=$portfolio["prt_id"]?>">REMOVE</a> | <a href="#" class="mlxs">VIEW</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        endforeach;
                                    }
                                    ?>

                                    <div class="col-md-4">
                                        <div class="select-image small empty mbmd">
                                            <div class="image-wrapper">
                                                <img src="" class="img-responsive select-image-preview"/>
                                            </div>
                                            <form id="jm-form-portfolio" action="<?=site_url()?>portfolio/upload" method="post" enctype="multipart/form-data">
                                                <input type="file" class="form-control" id="jm-portfolio-upload" name="jm-portfolio-upload" placeholder="Select portfolio image">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        $(".delete").click(function(e){
            e.preventDefault();
            var id = $(this).data("id");
            var link = $(this).attr("href")+id;
            var title = $(this).data("title");
            var message = "Are You Sure Want To Delete <strong>'"+$(this).parent().parent().find(".row-title").text()+"'</strong>?";
            $("#jm-form-delete").attr("action", link);
            $("#jm-delete-title").html(title);
            $("#jm-delete-message").html(message);
            $("#confirm-delete").modal("show");
        });

        $("#jm-portfolio-upload").change(function(){
            $("#jm-form-portfolio").submit();
        });
    });
</script>

<?php $this->load->view("website/modals/confirm_delete"); ?>
<?php $this->load->view("website/modals/resume/detail"); ?>
<?php $this->load->view("website/modals/resume/profile"); ?>
<?php $this->load->view("website/modals/resume/education"); ?>
<?php $this->load->view("website/modals/resume/experience"); ?>
<?php $this->load->view("website/modals/resume/skill"); ?>