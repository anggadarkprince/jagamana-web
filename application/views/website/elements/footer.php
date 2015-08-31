<footer>
    <div class="container">
        <div class="row main-footer">
            <div class="col-md-3 col-sm-6">
                <h2 class="title">ABOUT US</h2>
                <img src="<?=base_url()?>assets/img/layout/logo-jagamana.png" class="img-responsive logo">
                <p class="about">Media aplikasi yang menghimpun tenaga kerja medis untuk mendapatkan kesempatan dalam pekerjaan lebih mudah.</p>
                <ul class="list-unstyled hidden-xs">
                    <li><i class="fa fa-map-marker mrsm"></i> <?=get_setting("Address")?></li>
                    <li><small><i class="fa fa-envelope mrsm"></i></small><?=get_setting("Contact")?></li>
                </ul>
            </div>  <!-- end of about us -->
            <div class="col-md-2 col-sm-6 hidden-xs">
                <h2 class="title">QUICK LINKS</h2>
                <nav class="quick-links">
                    <ul>
                        <?php
                        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)){
                            $name = $this->session->userdata(UserModel::$SESSION_NAME);
                            $id = $this->session->userdata(UserModel::$SESSION_ID);
                            $link = "account/detail/".permalink($name, $id);
                        }
                        else{
                            $link = "login";
                        }
                        ?>
                        <li><a href="<?=site_url()?>">Home</a></li>
                        <li><a href="<?=site_url()?>company.html">Companies</a></li>
                        <li><a href="<?=site_url()?>jobs.html">Jobs</a></li>
                        <li><a href="<?=site_url()?>forum.html">Forum</a></li>
                        <li><a href="<?=site_url().$link?>">Account</a></li>
                        <li><a href="<?=site_url()?>page/privacy.html">Privacy</a></li>
                        <li><a href="<?=site_url()?>page/disclaimer.html">Disclaimer</a></li>
                        <li><a href="<?=site_url()?>page/contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>  <!-- end of links -->
            <div class="col-md-4 col-sm-6 hidden-xs">
                <h2 class="title">LATEST JOBS</h2>
                <ul class="list-unstyled latest-jobs">
                    <?php
                        $jobs = last_job();
                        if(count($jobs) > 0)
                        {
                            foreach($jobs as $job):
                            ?>

                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="featured-image">
                                            <img src="<?=base_url()?>assets/img/office/<?=$job["featured"]?>" class="center-block">
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <h2><a href="<?=site_url()?>job/detail/<?=permalink($job["vacancy"],$job["job_id"])?>.html"><?=$job["vacancy"]?></a></h2>
                                        <p><?=date_format(date_create($job["created_at"]),"d F, Y")?></p>
                                    </div>
                                </div>
                            </li>

                            <?php
                            endforeach;
                        }
                        else{
                            ?>

                        <li>No Jobs Entry Available</li>

                        <?php
                        }
                    ?>
                </ul>
            </div> <!-- end of latest job -->
            <div class="col-md-3 col-sm-6">
                <h2 class="title">GET IN TOUCH</h2>
                <p>Get new update via Email, we don't spam</p>
                <form action="<?=site_url()?>page/subscribe" role="form" method="post" id="jm-form-subscribe">
                    <div class="form-group subscribe">
                        <input type="email" name="jm-subscribe-email" id="jm-subscribe-email" class="form-control" required placeholder="Enter your email address">
                        <i class="fa fa-envelope text-primary"></i>
                    </div>
                </form>

                <div class="support hidden-xs">
                    <p class="title">Customer Support</p>
                    <i class="fa fa-phone-square pull-left"></i>
                    <p class="lead"><?=get_setting("Contact")?></p>
                    <p class="small"><?=get_setting("Email")?></p>
                </div>
            </div> <!-- end of get in touch -->
        </div>
        <div class="row bottom-footer">
            <div class="col-md-6 copyright">
                &copy; Copyright 2015 <strong>Jagamana</strong> by Sketch Project Studio.
            </div>
            <div class="col-md-6 social hidden-xs">
                <span class="hidden-xs">Follow Us :</span>
                <a href="<?=get_setting("Facebook")?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-facebook.png"></a>
                <a href="<?=get_setting("Twitter")?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-twitter.png"></a>
                <a href="<?=get_setting("Google")?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-google.png"></a>
            </div>
        </div>
    </div>
</footer>