<!-- SLIDER -->
<section>
    <div class="slide-container">
        <div class="slide">
            <img src="<?=base_url()?>assets/img/slide/slide1.jpg" class="img-responsive">
            <div class="visible-lg">
                <h1 class="slide-title">Job Hunter</h1>
                <div class="slide-description">
                    <span>Cari pekerjaan bidang kesehatan kini semakin</span><br>
                    <span>mudah segera daftar dan buka kesempatanmu</span><br>
                    <span>sekarang.</span>
                </div>
                <a href="<?=site_url()?>page/register" class="btn btn-lg btn-danger bold slide-link">Register Now</a>
            </div>
        </div> <!-- end of slide -->
    </div>
</section>

<!-- SEARCH -->
<section class="section">
    <div class="container">
        <header class="text-center">
            <h2 class="title-section">Medic Jobs Marketplace</h2>
            <p class="description-section">Media aplikasi yang menghimpun tenaga kerja medis untuk mendapatkan kesempatan dalam pekerjaan lebih mudah.</p>
        </header>
        <div class="row">
            <div class="col-md-4 col-xs-4">
                <img src="<?=base_url()?>assets/img/layout/featured-3col-doctorstand.png" class="img-responsive center-block">
            </div>
            <div class="col-md-4 col-xs-4">
                <img src="<?=base_url()?>assets/img/layout/featured-3col-doctortalk.png" class="img-responsive center-block">
            </div>
            <div class="col-md-4 col-xs-4">
                <img src="<?=base_url()?>assets/img/layout/featured-3col-doctormoney.png" class="img-responsive center-block">
            </div>
        </div>
        <div class="search">
            <h2>SEARCH FOR A JOB</h2>
            <form action="<?=site_url()?>page/search.html" role="form" method="get">
                <div class="search-bar">
                    <i class="fa fa-search"></i>
                    <input type="search" name="query" placeholder="Type keyword e.g. company, jobs title, resume, article, and more..."/>
                </div>
            </form>
        </div>
    </div> <!-- end of container -->
</section>

<?php
$margin = "";
if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) && !UserModel::is_authorize(UserModel::$TYPE_COMPANY)){
    ?>

    <!-- LOGIN -->
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 login-form">
                    <header>
                        <h2><i class="fa fa-sign-in mrsm"></i>Login Now!</h2>
                        <p>Access your dashboard and explore the jobs</p>
                    </header>
                    <section>
                        <div class="social-login">
                            <a href="#login-oauth" data-toggle="modal" class="btn btn-facebook center-block">
                                <i class="fa fa-facebook mrsm"></i>
                                Login with Facebook
                            </a>
                            <a href="#login-oauth" data-toggle="modal" class="btn btn-twitter center-block">
                                <i class="fa fa-twitter mrsm"></i>
                                Login with Twitter
                            </a>
                        </div>

                        <form role="form" action="<?=site_url()?>authentication/login" method="post" id="jm-form-login">
                            <div class="form-group">
                                <label for="jm-login-username"><i class="fa fa-user-md mrsm"></i>Username</label>
                                <input type="email" class="form-control" name="jm-login-email" id="jm-login-email" placeholder="Enter email or username" required="true" maxlength="45" value="<?=set_value('jm-login-email', '');?>">
                            </div>
                            <div class="form-group">
                                <label for="jm-login-password"><i class="fa fa-lock mrsm"></i>Password</label>
                                <input type="password" class="form-control" name="jm-login-password" id="jm-login-password" placeholder="Enter your secret key" required="true" maxlength="45" value="<?=set_value('jm-login-password', '');?>">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="checkbox" for="jm-login-remember">
                                            <input type="checkbox" checked="checked" value="1" id="jm-login-remember" data-toggle="checkbox" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                            Remember Me
                                        </label>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="<?=site_url()?>page/register.html">Join with us?</a>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-block btn-danger bold"><i class="fa fa-sign-in mrsm"></i>LOGIN NOW</button>
                            <a href="#" class="center-block text-center mtsm" data-toggle="modal" data-target="#forgot-password">Forgot your password?</a>
                        </form>
                    </section>
                </div>
                <div class="col-md-7 col-md-push-1 col-sm-5 col-sm-push-1 featured hidden-xs">
                    <img src="<?=base_url()?>assets/img/layout/featured-illustration-login.png" class="img-responsive">
                    <h3>Health Workers</h3>
                    <p>One-Click Step to discover all information resource and discussion</p>
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section>


<?php
}
else{
    $margin = "ptn";
}

?>

<!-- JOBS RELATION -->
<section class="section job-relation <?=$margin?>">
    <div class="container">
        <header class="text-center">
            <h2 class="title-section">Build Your Professional Career</h2>
            <p class="description-section">Bergabunglah dengan kami dan raih kesempatan untuk berkarir di dunia yang anda cintai, temukan partner yang cocok untuk anda.</p>
        </header>
    </div>
    <img src="<?=base_url()?>assets/img/layout/featured-block-medicjob.png" class="img-responsive">
</section>

<?php

if(!UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) && !UserModel::is_authorize(UserModel::$TYPE_COMPANY)) {
    ?>
    <!-- REGISTER -->
    <section class="register-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 featured hidden-xs">
                    <img src="<?= base_url() ?>assets/img/layout/featured-illustration-register.png"
                         class="img-responsive">

                    <h3>Hello World</h3>
                    <h4>Let's Join with Us</h4>

                    <p>Hundred people found new jobs everyday, what you waiting for?</p>
                </div>
                <div class="col-lg-6 col-md-7">
                    <header>
                        <h2><i class="fa fa-check-square-o mrsm"></i>Register Now!</h2>

                        <p>Register yourself and explore your talent.</p>
                    </header>
                    <section>
                        <form action="<?= site_url() ?>register" method="post" role="form" class="form-horizontal"
                              id="jm-form-register">
                            <div class="form-group">
                                <label for="jm-register-name" class="col-lg-3 col-md-3"><i class="fa fa-user mrsm"></i>Name</label>

                                <div class="col-lg-9 col-md-9">
                                    <input type="text" class="form-control" name="jm-register-name"
                                           id="jm-register-name" placeholder="Put your name here" required="true"
                                           maxlength="45" value="<?php echo set_value('jm-register-name', '');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-register-email" class="col-lg-3 col-md-3"><i
                                        class="fa fa-envelope mrsm"></i>Email</label>

                                <div class="col-lg-9 col-md-9">
                                    <input type="email" class="form-control" name="jm-register-email"
                                           id="jm-register-email" placeholder="Enter email as user ID" required="true"
                                           maxlength="45" value="<?php echo set_value('jm-register-email', '');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-register-password" class="col-lg-3 col-md-3"><i
                                        class="fa fa-lock mrsm"></i>Password</label>

                                <div class="col-lg-9 col-md-9">
                                    <input type="password" class="form-control" name="jm-register-password"
                                           id="jm-register-password" placeholder="Enter your secret key" required="true"
                                           maxlength="45" value="<?php echo set_value('jm-register-password', '');?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-register-employee" class="col-lg-3 col-md-3"><i
                                        class="fa fa-briefcase mrsm"></i>Register As</label>

                                <div class="col-lg-9 col-md-9">
                                    <div class="radio-inline">
                                        <input type="radio" name="jm-register-role" id="jm-register-employee"
                                               value="jm-role-employee" class="required" checked>
                                        <label for="jm-register-employee" class="select-employee"><i
                                                class="fa fa-user-md"></i> Job Seeker</label>
                                    </div>
                                    <div class="radio-inline">
                                        <input type="radio" name="jm-register-role" id="jm-register-company"
                                               value="jm-role-company">
                                        <label for="jm-register-company" class="select-company"><i
                                                class="fa fa-briefcase"></i> Company</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mn">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-block btn-lg btn-danger bold"><i
                                            class="fa fa-check-square-o mrsm"></i>REGISTER
                                    </button>
                                    <a href="<?= site_url() ?>page/login.html" class="center-block text-center mtsm">Have
                                        an account? <strong>Login Now</strong></a>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container -->
    </section>

<?php
}
    ?>
<!-- FEATURED COMPANIES -->
<section class="section">
    <div class="container">
        <header class="text-center">
            <h2 class="title-section">Profile Office & Companies</h2>
            <p class="description-section">Perusahaan dan organisasi job seeder, kenali lebih dekat dan temukan informasi karir, lokasi, serta hal menarik lainnya.</p>
        </header>
        <section>
            <div class="row">
                <?php
                if(isset($companies)){
                    if(count($companies) == 0){
                        echo "<p class='text-center center-block'>No companies available</p>";
                    }
                    foreach($companies as $company):
                        $permalink = permalink($company["company"],$company["company_id"]);
                        ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="featured-company">
                                <div class="featured-image">
                                    <div class="image-wrapper">
                                        <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="img-responsive center-block">
                                    </div>
                                    <div class="featured-label">
                                        <a href="#" class="more">SEE OUR OFFICE</a>|<a href="#" class="follower"><?=$company["follower"]?> FOLLOWER</a>
                                    </div>
                                </div>
                                <div class="featured-body">
                                    <h2><a href="<?=site_url()?>company/about/<?=$permalink?>.html"><?=$company["company"]?></a></h2>
                                    <ul class="list-inline">
                                        <li><i class="fa fa-hospital-o mrsm"></i><?=$company["field"]?></li>
                                        <li><i class="fa fa-map-marker mrsm"></i><?=$company["city"]?></li>
                                        <li><i class="fa fa-group mrsm"></i><?=$company["size"]?></li>
                                    </ul>
                                    <p><?=character_limiter(strip_tags($company["description"]),220)?></p>
                                </div>
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

                                    <a href="#" class="btn btn-primary"><i class="fa fa-navicon mrsm"></i>JOBS</a>
                                    <a href="#" class="btn btn-warning"><i class="fa fa-search mrsm"></i>INFO</a>
                                </div>
                            </div>
                        </div> <!-- end of company column -->

                        <?php
                    endforeach;
                }
                ?>
            </div> <!-- end of row -->
            <div class="text-center mblg">
                <a href="<?=base_url()?>company.html" class="btn btn-lg btn-invert"><i class="fa fa-building mrsm"></i>SEE ALL COMPANIES</a>
            </div>
        </section>
    </div>
</section>

<!-- FEATURED JOBS -->
<section class="section overlay">
    <div class="container">
        <header class="text-center">
            <h2 class="title-section">Ready Jobs For Everyone</h2>
            <p class="description-section">Persiapkan dirimu dan temukan spesifikasi yang cocok untuk memulai karir dan membuka kesempatan menuju masa depan yang cerah.</p>
        </header>
        <section>
            <?php

                if(isset($jobs))
                {
                    if(count($jobs) == 0){
                        echo "<p class='text-center center-block'>No jobs available</p>";
                    }
                    foreach($jobs as $job):
                        $permalink = permalink($job["vacancy"],$job["job_id"]);
                        ?>

                        <div class="featured-job">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="featured-image">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$job["featured"]?>" class="center-block">
                                        </div>
                                        <p class="company-title text-uppercase"><?=strtoupper($job["company"])?></p>
                                        <label class="job-label <?=strtolower($job["type"])?>"><i class="fa fa-clock-o mrsm"></i><?=strtoupper($job["type"])?></label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="featured-body">
                                        <h2><a href="<?=site_url()?>job/detail/<?=$permalink?>.html"><?=ucwords($job["vacancy"])?></a></h2>
                                        <p><?=strip_tags($job["description"])?> <a href="<?=site_url()?>job/detail/<?=$permalink?>.html">Details</a></p>
                                    </div>
                                    <div class="featured-control">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-7 col-sm-7">
                                                <ul class="list-inline mtsm">
                                                    <li><i class="fa fa-map-marker mrsm"></i><?=$job["city"].", ".$job["country"]?></li>
                                                    <li><i class="fa fa-pencil mrsm"></i><?=$job["field"]?></li>
                                                    <li><i class="fa fa-check mrsm"></i><?=$job["level"]?></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-4 col-md-5 col-sm-5 button">
                                                <?php
                                                    $link = site_url()."page/login";
                                                    $control = "";
                                                    if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)){
                                                        $link = "#";
                                                        $control = "btn-bookmark-control";
                                                    }
                                                    if($job["is_bookmarked"])
                                                    {
                                                        ?>
                                                        <a href="<?=$link?>" class="btn btn-invert <?=$control?> active btn-remove-bookmark" data-job="<?=$job["job_id"]?>"><i class="fa fa-star mrsm"></i>SAVED</a>
                                                        <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <a href="<?=$link?>" class="btn btn-invert <?=$control?>  btn-save-bookmark" data-job="<?=$job["job_id"]?>"><i class="fa fa-star-o mrsm"></i>SAVE JOB</a>
                                                        <?php
                                                    }
                                                ?>
                                                <a href="<?=site_url()?>job/detail/<?=$permalink?>.html" class="btn btn-danger"><i class="fa fa-search mrsm"></i>SEE JOB</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end of featured job -->

                        <?php
                    endforeach;
                }
            ?>

            <div class="text-center">
                <a href="<?=base_url()?>job/all.html" class="btn btn-lg btn-invert"><i class="fa fa-file mrsm"></i>SEE ALL JOBS</a>
            </div>
        </section>
    </div>
</section>

<!-- FEATURED FORUM -->
<section class="section">
    <div class="container">
        <header class="text-center">
            <h2 class="title-section">Discuss Everything In Forum</h2>
            <p class="description-section">Forum merupakan media berbagi informasi antar pengguna, membahas topik medis dan membangun ikatan sosial satu sama lain.</p>
        </header>
    </div>
    <section class="forum-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-sm-7">
                    <div class="featured-forum hidden-xs">
                        <img src="<?=base_url()?>assets/img/layout/featured-block-doctors.png" class="img-responsive">
                        <div class="label">
                            <h3>Medical Forum Guidance</h3>
                            <p>Discover new knowledge and research</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5 col-sm-5">
                    <div class="title">
                        <h3>Join The Most Comprehensive</h3>
                        <p>Health Discussion Forums</p>
                    </div>
                    <img src="<?=base_url()?>assets/img/layout/featured-illustration-forum.png" class="img-responsive illustration">
                </div>
            </div>
        </div> <!-- end of container -->
    </section>
    <section class="container">
        <div class="row forum-summary">
            <div class="col-md-6 last-thread">
                <div class="title">
                    <h4 class="pull-left"><i class="fa fa-file-text-o mrsm"></i>Last Thread</h4>
                    <a href="<?=site_url()?>forum/threads.html" class="pull-right">Browse All</a>
                    <div class="clearfix"></div>
                </div>
                <div class="content">
                    <ul class="list-unstyled">
                        <?php
                        if(isset($threads)){
                            if(count($threads) == 0){
                                echo "<p class='text-left'>No threads available</p>";
                            }
                            foreach($threads as $thread):
                                $permalink = $thread["permalink"];
                                $date = date_format(date_create($thread["created_at"]),"Y-m-dTh:m:sZ")
                            ?>

                            <li>
                                <a href="<?=site_url()?>forum/thread/<?=$permalink?>.html"><i class="fa fa-check-square-o"></i><?=$thread["title"]?></a>
                                <time class="pull-right timeago" datetime="<?=$thread["created_at"]?>"><?=$thread["created_at"]?></time>
                            </li>

                            <?php
                            endforeach;
                        }
                        ?>
                    </ul>
                </div>
            </div>  <!-- end of last thread -->
            <div class="col-md-6 categories">
                <div class="title">
                    <h4 class="pull-left"><i class="fa fa-list mrsm"></i>Categories</h4>
                    <a href="<?=site_url()?>forum/categories.html" class="pull-right">All Category</a>
                    <div class="clearfix"></div>
                </div>
                <?php
                $counter = 0;
                $category_left = "";
                $category_right = "";
                if(isset($categories)){
                    if(count($categories) == 0){
                        echo "<p class='text-left'>No categories available</p>";
                    }
                    foreach($categories as $category):
                        $permalink = site_url().'forum/category/'.$category["permalink"].'.html';
                        $category_text = '<li><a href="'.$permalink.'">'.$category["category"].'<span class="counter">['.$category["thread"].']</span></a></li>';
                        if($counter++ < 13){
                            $category_left.=$category_text;
                        }
                        else{
                            $category_right.=$category_text;
                        }
                    endforeach;
                }
                ?>
                <div class="row content">
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <?=$category_left?>
                        </ul>
                    </div>
                    <div class="col-sm-6 hidden-xs">
                        <ul class="list-unstyled">
                            <?=$category_right?>
                        </ul>
                    </div>
                </div>
            </div> <!-- end of category -->
        </div>
    </section>
</section>


<?php $this->load->view("website/modals/reset"); ?>
<?php $this->load->view("website/modals/oauth"); ?>