<section class="section">
    <div class="container">
        <div class="main-content">
            <section class="about-section people">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="image-wrapper people-avatar center-block">
                            <img src="<?=base_url()?>assets/img/avatar/<?=$employee["emp_avatar"]?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <h1 class="name"><?=$employee["emp_name"]?></h1>
                        <p class="lead">Hello There,</p>
                        <p><?=$employee["emp_about"]?></p>
                    </div>
                </div>
            </section>

            <div class="tab-navigation">
                <ul class="list-inline">
                    <li class="active"><a href="<?=site_url()?>account/detail/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">RESUME</a></li>
                    <li><a href="<?=site_url()?>account/following/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">FOLLOWING</a></li>
                    <li><a href="<?=site_url()?>account/thread/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">THREAD</a></li>
                </ul>
            </div>

            <div class="form-section">
                <div class="title">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            $current_file = "No file resume available, make the new one";
                            $empty = true;
                            if(isset($employee)){
                                if($employee["emp_resume"] != null){
                                    $current_file = $employee["emp_resume"];
                                    $empty = false;
                                }
                            }
                            ?>
                            <h3><?=$employee["emp_name"]?> Resume Profile</h3>
                            <?php
                            if(!$empty){
                                ?>

                                <p>Download resume file <a href="<?=base_url()?>assets/data/<?=$current_file?>">HERE</a></p>

                            <?php
                            }
                            else{
                                ?>

                                <p>This account doesn't have CV file</p>

                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="<?=site_url()?>resume/generate/<?=$employee["emp_id"]?>.html" class="btn btn-primary pull-right"><i class="fa fa-print"></i> PRINT RESUME</a>
                        </div>
                    </div>
                </div>
                <div class="resume pn">
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

                    <div class="resume-section">
                        <h3>PERSONAL PROFILE</h3>
                        <p><?=($employee["emp_about"]!=null)?$employee["emp_about"]:"No Profile Written"?></p>
                    </div>

                    <div class="resume-section">
                        <h3>EDUCATION</h3>
                        <div class="activity">
                            <ul class="list-unstyled list-border">
                                <?php
                                if(isset($educations)){
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

                    <div class="resume-section">
                        <h3>EXPERIENCE</h3>
                        <div class="activity">
                            <ul class="list-unstyled list-border">
                                <?php
                                if(isset($experiences))
                                {
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
                    <div class="resume-section">
                        <h3>SKILLS & ATTRIBUTES</h3>
                        <div class="activity">
                            <?php
                            if(isset($skills)){
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
                                                <a href="#" class="mlxs">VIEW PORTFOLIO</a>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endforeach;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>