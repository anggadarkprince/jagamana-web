<!-- FEATURED ABOUT -->
<section class="section overlay">
    <div class="container">
        <div class="row">
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
            <div class="col-md-7">
                <div class="featured-image office">
                    <div class="image-wrapper">
                        <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="img-responsive">
                    </div>
                    <div class="featured-info">
                        <p>See Inside the Office of</p>
                        <h1><?=$company["company"]?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="featured-office-info">
                    <img src="<?=base_url()?>assets/img/avatar/<?=$company["logo"]?>" class="img-responsive logo center-block">
                    <p><?=$company["description"]?></p>
                    <?php
                    $is_logged_in = UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE);
                    $link = site_url()."page/login";
                    $class = "btn-bookmark";
                    $icon = "fa-star-o";
                    $text = "SAVE JOB";
                    if($is_logged_in){
                        $link = "#";
                        $class .= " btn-bookmark-control";
                        if($job["is_bookmarked"]){
                            $class .= " active btn-remove-bookmark";
                            $icon = "fa-star";
                            $text = "SAVED";
                        }
                    }
                    ?>
                    <div class="featured-control">
                        <a href="<?=$link?>" class="btn btn-invert <?=$class?>" data-job="<?=$job["job_id"]?>"><i class="fa <?=$icon?> mrsm"></i><?=$text?></a>
                        <a href="mailto:mailto:address@domain.com;content:'Hey, take a look the awesome job <?=site_url()?>job/detail/<?=permalink($job["vacancy"], $job["job_id"])?>'" class="btn btn-danger"><i class="fa fa-envelope-o mrsm"></i>SEND TO A FRIEND</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container text-justify">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <section class="about-section">
                    <header>
                        <h2><?=$job["vacancy"]?></h2>
                        <p class="text-muted">Published by  <?=$company["company"]?>   |  <?=date_format(date_create($job["created_at"]),"d F, Y h:m A")?></p>
                    </header>
                    <section>
                        <h6>About This Job</h6>
                        <ul class="list-inline text-muted">
                            <li><i class="fa fa-map-marker mrsm"></i><?=$job["city"]?>, <?=$job["country"]?></li>
                            <li><i class="fa fa-pencil mrsm"></i><?=$job["field"]?></li>
                            <li><i class="fa fa-check mrsm"></i><?=$job["level"]?></li>
                        </ul>
                        <p><?=$job["description"]?></p>
                    </section>
                </section>
                <section class="about-section">
                    <section>
                        <h6>Responsibility</h6>
                        <?=$job["job_responsibility"]?>
                        <h6>Qualification</h6>
                        <?=$job["job_qualification"]?>
                        <h6>Vacancy Active</h6>
                        <p class="lead"><?=$job["job_open"]." - ".$job["job_close"]?></p>
                    </section>
                </section>
                <section class="about-section">
                    <section>
                        <h6>About The Company</h6>
                        <p><?=$company["description"]?></p>
                        <a href="<?=site_url()?>company/about/<?=permalink($company["company"], $company["company_id"])?>.html">Visit <?=$company["company"]?> Profile</a>
                        <h6>Contact</h6>
                        <ul class="list-unstyled">
                            <li><i class="fa fa-map-marker mrsm"></i><?=$company["cmp_address"]?></li>
                            <li>
                                <small><i class="fa fa-envelope mrsm"></i></small>
                                <?=$company["cmp_email"]?>
                            </li>
                            <li><i class="fa fa-phone-square mrsm"></i><?=$company["cmp_contact"]?></li>
                        </ul>
                    </section>
                    <div class="center-block text-center">
                        <?php
                        if($job["type"] != "FREELANCE"){
                            $link = site_url()."page/login";
                            if($is_logged_in){
                                $link = site_url()."job/apply/".permalink($job["vacancy"],$job["job_id"]);
                            }
                            if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)){
                                if($job["is_applied"])
                                {
                                    ?>

                                    <button class="btn btn-danger" disabled><i class="fa fa-check-square-o mrsm"></i>YOU HAVE APPLIED</button>

                                <?php
                                }
                                else
                                {
                                    ?>

                                    <a href="<?=$link?>" class="btn btn-danger"><i class="fa fa-check-square-o mrsm"></i>APPLY THIS JOB</a>

                                <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </section>
            </div>
            <div class="col-lg-5 col-md-6">
                <section class="about-section sidebar">
                    <header>
                        <h3>Applied Job Seeker</h3>

                        <p>People have sent job request</p>
                    </header>
                    <section class="applicant">
                        <?php
                        if(isset($applicants))
                        {
                            foreach($applicants as $applicant):
                                ?>

                                <a href="<?=site_url()?>account/detail/<?=permalink($applicant["employee"],$applicant["employee_id"])?>"><img src="<?=base_url()?>assets/img/avatar/<?=$applicant["employee_avatar"]?>" class="img-circle"></a>

                            <?php
                            endforeach;

                            if(count($applicants) > 15){
                                ?>

                                <a href="<?=site_url()?>job/applicant/<?=$this->uri->segment(3)?>" class="more"><i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i></a>

                            <?php
                            }
                        }
                        ?>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>Another Jobs On <?=$company["company"]?></h3>
                        <p>List job for related company</p>
                    </header>
                    <section>
                        <div class="row">
                            <?php
                            if(isset($related))
                            {
                                $count = 0;
                                foreach($related as $row):
                                    if($count++ < 3){
                                    ?>

                                        <div class="col-md-4 col-sm-4">
                                            <div class="featured-job detail">
                                                <div class="featured-image">
                                                    <div class="image-wrapper">
                                                        <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="center-block">
                                                    </div>
                                                    <p class="company-title text-uppercase"><?=$row["field"]?></p>
                                                    <label class="job-label <?=strtolower($row["type"])?>"><i class="fa fa-clock-o mrsm"></i><?=$row["type"]?></label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                    else{
                                        break;
                                    }
                                endforeach;
                            }
                            ?>
                        </div>
                        <a href="<?=site_url()?>company/job/<?=permalink($company["company"], $company["company_id"])?>.html" class="seemore center-block text-center"><i class="fa fa-chevron-down mrsm"></i>SEE MORE</a>
                    </section>
                </section>

                <section class="about-section sidebar">
                    <header>
                        <h3>Similar Job</h3>
                        <p>Related requirement, qualification and type of job</p>
                    </header>
                    <section>
                        <div class="row">
                            <?php
                            if(isset($similar))
                            {
                                foreach($similar as $row):
                                    ?>

                                    <div class="col-md-4 col-sm-4">
                                        <div class="featured-job detail">
                                            <div class="featured-image">
                                                <div class="image-wrapper">
                                                    <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="center-block">
                                                </div>
                                                <p class="company-title text-uppercase"><?=$row["field"]?></p>
                                                <label class="job-label <?=strtolower($row["type"])?>"><i class="fa fa-clock-o mrsm"></i><?=$row["type"]?></label>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endforeach;
                            }
                            ?>
                        </div>
                        <a href="<?=site_url()?>company/job/<?=permalink($company["company"], $company["company_id"])?>.html" class="seemore center-block text-center"><i class="fa fa-chevron-down mrsm"></i>SEE MORE</a>
                    </section>
                </section>

                <section class="about-section sidebar">
                    <header>
                        <h3>Random Job</h3>
                        <p>Related requirement, qualification and type of job</p>
                    </header>
                    <section>
                        <div class="row">
                            <?php
                            if(isset($random))
                            {
                                foreach($random as $row):
                                    ?>

                                    <div class="col-md-4 col-sm-4">
                                        <div class="featured-job detail">
                                            <div class="featured-image">
                                                <div class="image-wrapper">
                                                    <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="center-block">
                                                </div>
                                                <p class="company-title text-uppercase"><?=$row["field"]?></p>
                                                <label class="job-label <?=strtolower($row["type"])?>"><i class="fa fa-clock-o mrsm"></i><?=$row["type"]?></label>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endforeach;
                            }
                            ?>
                        </div>
                        <a href="<?=site_url()?>company/job/<?=permalink($company["company"], $company["company_id"])?>.html" class="seemore center-block text-center"><i class="fa fa-chevron-down mrsm"></i>SEE MORE</a>
                    </section>
                </section>
            </div>
        </div>
    </div>
</section>