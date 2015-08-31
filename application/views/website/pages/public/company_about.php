<section>
    <div class="container">
        <div class="tab-navigation">
            <ul class="list-inline">
                <li class="active"><a href="<?=site_url()?>company/about/<?=$this->uri->segment(3)?>.html">ABOUT US</a></li>
                <li><a href="<?=site_url()?>company/office/<?=$this->uri->segment(3)?>.html">OFFICE</a></li>
                <li><a href="<?=site_url()?>company/people/<?=$this->uri->segment(3)?>.html">PEOPLE</a></li>
                <li><a href="<?=site_url()?>company/job/<?=$this->uri->segment(3)?>.html">JOBS</a></li>
            </ul>
        </div>
    </div>
</section>

<!-- FEATURED ABOUT -->
<section class="section overlay">
    <div class="container text-justify">
        <div class="row">
            <div class="col-md-7">
                <div class="featured-image office">
                    <div class="image-wrapper">
                        <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="img-responsive">
                    </div>
                    <div class="featured-info">
                        <p>See Inside the Office of</p>

                        <h1><?=$company["cmp_name"]?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="featured-office-info">
                    <img src="<?=base_url()?>assets/img/avatar/<?=$company["cmp_logo"]?>" class="img-responsive logo center-block">

                    <p>
                        <?=$company["cmp_description"]?>
                    </p>
                    <ul class="list-inline text-muted">
                        <li><i class="fa fa-hospital-o mrsm"></i><?=$company["field"]?></li>
                        <li><i class="fa fa-map-marker mrsm"></i><?=$company["city"].", ".$company["country"]?></li>
                        <li><i class="fa fa-group mrsm"></i><?=$company["size"]?></li>
                    </ul>
                    <div class="featured-control">
                        <?php
                        $link = site_url()."page/login";
                        $control = "";
                        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)){
                            $link = "#";
                            $control = "btn-follow-control";
                        }
                        if($company["is_followed"])
                        {
                            ?>

                            <a href="<?=$link?>" class="btn btn-invert <?=$control?> active btn-unfollow" data-company="<?=$company["company_id"]?>"><i class="fa fa-star mrsm"></i>UNFOLLOW</a>

                        <?php
                        }
                        else{
                            ?>

                            <a href="<?=$link?>" class="btn btn-invert <?=$control?> btn-follow" data-company="<?=$company["company_id"]?>"><i class="fa fa-star-o mrsm"></i>FOLLOW</a>

                        <?php
                        }
                        ?>
                        <a href="mailto:address@domain.com;content:'Hey, take a look the awesome company <?=site_url()?>company/about/<?=permalink($company["company"], $company["company_id"])?>'" class="btn btn-danger"><i class="fa fa-envelope-o mrsm"></i>SEND TO A FRIEND</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section text-justify">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-6">
                <section class="about-section">
                    <header>
                        <p class="lead">We Are</p>

                        <h2><?=$who["cst_title"]?></h2>
                    </header>
                    <section>
                        <p>
                            <?=$who["cst_description"]?>
                        </p>
                    </section>
                </section>
                <section class="about-section">
                    <header>
                        <p class="lead">Office Culture</p>
                        <h2><?=$office["cst_title"]?></h2>
                    </header>
                    <section>
                        <p>
                            <?=$office["cst_description"]?>
                        </p>
                    </section>
                </section>
                <section class="about-section">
                    <header>
                        <p class="lead">What <?=$company["company"]?> Does</p>
                    </header>
                    <section>
                        <?php
                        if(isset($tasks))
                        {
                            foreach($tasks as $task):
                            ?>

                                <h4><?=$task["cts_task"]?></h4>

                                <p><?=$task["cts_description"]?></p>

                            <?php
                            endforeach;
                        }
                        ?>
                    </section>
                </section>
                <section class="about-section">
                    <header>
                        <p class="lead">What We Expected From You</p>
                        <h2><?=$expectation["cst_title"]?></h2>
                    </header>
                    <section>
                        <p><?=$expectation["cst_description"]?></p>
                    </section>
                </section>
                <section class="about-section">
                    <header>
                        <p class="lead">Employee Opinion</p>
                        <h2><?=$opinion["cst_title"]?></h2>
                    </header>
                    <section class="opinion">
                        <p><?=$opinion["cst_description"]?></p>

                        <div class="testimonial">
                            <?php
                            if(isset($people))
                            {
                                foreach($people as $person):
                                ?>

                                    <div class="quote">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <div class="image-wrapper people-avatar center-block">
                                                    <img src="<?=base_url()?>assets/img/people/<?=$person["plp_avatar"]?>" class="img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <p class="name"><?=$person["plp_name"]?></p>
                                                <span class="sub text-muted"><?=$person["plp_position"]?></span>
                                                <blockquote>
                                                    <p><?=$person["plp_caption"]?></p>
                                                </blockquote>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                endforeach;
                            }
                            ?>
                        </div>
                    </section>
                </section>
            </div>
            <div class="col-lg-5 col-md-6">
                <section class="about-section sidebar">
                    <header>
                        <h3>Who Followed Us</h3>

                        <p>People have following company updates</p>
                    </header>
                    <section class="applicant">
                        <?php
                        if(isset($followers))
                        {
                            foreach($followers as $follower):
                            ?>

                                <a href="<?=site_url()?>account/<?=permalink($follower["employee"],$follower["employee_id"])?>"><img src="<?=base_url()?>assets/img/avatar/<?=$follower["avatar"]?>" class="img-circle"></a>

                            <?php
                            endforeach;

                            if(count($followers) > 15){
                            ?>

                                <a href="<?=site_url()?>company/follower/<?=$this->uri->segment(3)?>" class="more"><i class="fa fa-circle"></i><i class="fa fa-circle"></i><i class="fa fa-circle"></i></a>

                            <?php
                            }
                        }
                        ?>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>Company Achievement</h3>

                        <p>Our Reward and Achievement</p>
                    </header>
                    <section class="achievement">
                        <ul>
                            <?php
                            if(isset($achievements))
                            {
                                foreach($achievements as $achievement):
                                ?>

                                    <li>
                                        <h4><?=$achievement["ach_award"]?></h4>

                                        <p><?=$achievement["ach_description"]?></p>

                                        <p class="text-muted">Achieved at <?=$achievement["ach_earned"]?></p>
                                    </li>

                                <?php
                                endforeach;
                            }
                            ?>
                        </ul>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>Get In Touch</h3>

                        <p>Don't miss our awesome updates and activity</p>
                    </header>
                    <section>
                        <a href="<?=$company["cmp_facebook"]?>" target="_blank" class="btn btn-facebook center-block">
                            <i class="fa fa-facebook mrsm"></i>
                            Meet Us On Facebook
                        </a>
                        <a href="<?=$company["cmp_twiter"]?>" target="_blank" class="btn btn-twitter center-block">
                            <i class="fa fa-twitter mrsm"></i>
                            Follow On Twitter
                        </a>
                        <a href="<?=$company["cmp_google"]?>" target="_blank" class="btn btn-google center-block">
                            <i class="fa fa-google-plus mrsm"></i>
                            Plus On Google
                        </a>
                        <a href="<?=$company["cmp_google"]?>" target="_blank" class="btn btn-facebook center-block">
                            <i class="fa fa-linkedin mrsm"></i>
                            Link With Linkedin
                        </a>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>Jobs On <?=$company["company"]?></h3>

                        <p>List job for related company</p>
                    </header>
                    <section>
                        <div class="row">
                            <?php
                            if(isset($jobs))
                            {
                                $count = 0;
                                foreach($jobs as $job):
                                    if($count++ < 3) {
                                        ?>

                                        <div class="col-md-4 col-sm-4">
                                            <div class="featured-job detail">
                                                <div class="featured-image">
                                                    <div class="image-wrapper">
                                                        <img
                                                            src="<?= base_url() ?>assets/img/office/<?= $company["featured"] ?>"
                                                            class="center-block">
                                                    </div>
                                                    <p class="company-title text-uppercase"><?= $job["field"] ?></p>
                                                    <label class="job-label <?= strtolower($job["type"]) ?>"><i
                                                            class="fa fa-clock-o mrsm"></i><?= $job["type"] ?></label>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }
                                endforeach;
                            }
                            ?>
                        </div>
                        <a href="company_jobs.php" class="seemore center-block text-center"><i class="fa fa-chevron-down mrsm"></i>SEE MORE</a>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>Offices On <?=$company["company"]?></h3>
                        <p>List Offices for related company</p>
                    </header>
                    <section>
                        <div class="row">
                            <?php
                            if(isset($photos))
                            {
                                foreach($photos as $photo):
                                    ?>

                                    <div class="col-md-4 col-sm-4">
                                        <div class="featured-company detail">
                                            <div class="featured-image">
                                                <div class="image-wrapper">
                                                    <img src="<?=base_url()?>assets/img/office/<?=$photo["cph_resource"]?>" class="center-block">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                endforeach;
                            }
                            ?>
                        </div>
                        <a href="company_people.php" class="seemore center-block text-center"><i class="fa fa-chevron-down mrsm"></i>SEE MORE</a>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>People On <?=$company["company"]?></h3>
                        <p>List People for related company</p>
                    </header>
                    <section>
                        <div class="row">
                            <?php
                            if(isset($people))
                            {
                                $counter = 0;
                                foreach($people as $person):
                                    if($counter < 3) {
                                        ?>

                                        <div class="col-md-4 col-xs-4">
                                            <div class="people-wrapper">
                                                <img
                                                    src="<?= base_url() ?>assets/img/people/<?= $person["plp_avatar"] ?>"
                                                    class="img-responsive">
                                            </div>
                                        </div>

                                    <?php
                                        $counter++;
                                    }
                                    else{
                                        break;
                                    }
                                endforeach;
                            }
                            ?>
                        </div>
                        <a href="<?=site_url()?>company/people/<?=$this->uri->segment(3)?>.html" class="seemore center-block text-center"><i class="fa fa-chevron-down mrsm"></i>SEE MORE</a>
                    </section>
                </section>
                <section class="about-section sidebar">
                    <header>
                        <h3>Contact Us</h3>
                        <p>More information and personal purpose</p>
                    </header>
                    <section>
                        <ul class="list-unstyled">
                            <li><p><i class="fa fa-map-marker mrsm"></i><?=$company["cmp_address"]?></p></li>
                            <li>
                                <p>
                                    <small><i class="fa fa-envelope mrsm"></i></small>
                                    <?=$company["cmp_email"]?>
                                </p>
                            </li>
                            <li><p><i class="fa fa-phone-square mrsm"></i><?=$company["cmp_contact"]?></li>
                            <li><p><i class="fa fa-globe mrsm"></i><?=$company["cmp_website"]?></li>
                        </ul>
                    </section>
                </section>
            </div>
        </div>

    </div>
</section>