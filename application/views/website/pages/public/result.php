<section class="container contact">
    <div class="search">
        <h2>SEARCH FOR ANYTHING</h2>
        <form action="<?=site_url()?>page/search.html" role="form" method="get">
            <div class="search-bar">
                <i class="fa fa-search"></i>
                <input type="search" name="query" value="<?=isset($keyword)?$keyword:""?>" placeholder="Type keyword e.g. company, jobs title, resume, article, and more..."/>
            </div>
        </form>
    </div>

    <div>
        <hr>
        <h5><i class="fa fa-briefcase"></i> Job Result (<?=$jobs_total?> founds)</h5>
        <hr>
        <div>
            <?php

            if(isset($jobs))
            {
                if(count($jobs) == 0){
                    echo "<p class='text-center center-block'>No jobs found, try another keyword</p>";
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
        </div>
        <?php
        if(isset($jobs) && count($jobs) != 0){
            ?>

            <a href="<?=site_url()?>page/search.html?query=<?=$keyword?>&section=job" class="center-block text-center lead"><i class="fa fa-chevron-down mrsm"></i>SEE MORE JOBS</a>

        <?php
        }
        ?>
    </div>

    <div>
        <hr>
        <h5><i class="fa fa-building"></i> Company Result (<?=$companies_total?> founds)</h5>
        <hr>
        <div>
            <?php
            if(isset($companies))
            {
                if(count($companies) == 0){
                    echo "<p class='text-center center-block'>No companies found, try another keyword</p>";
                }
                foreach($companies as $company):
                    $permalink = permalink($company["company"],$company["company_id"]);
                    ?>

                    <div class="featured-company detail">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="featured-image">
                                    <div class="image-wrapper">
                                        <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="img-responsive center-block">
                                    </div>
                                    <div class="featured-info">
                                        <div class="wrapper">
                                            <p>See Inside the Office of</p>
                                            <h1><?=strtoupper($company["company"])?></h1>
                                        </div>
                                    </div>
                                    <div class="featured-label">
                                        <a href="<?=site_url()?>company/office/<?=$permalink?>.html" class="more">SEE OUR OFFICE</a>|<a href="<?=site_url()?>company/follower/<?=$permalink?>.html" class="follower"><?=$company["follower"]?> FOLLOWER</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="featured-body">
                                    <h2 class="mtn mbxs"><a href="<?=site_url()?>company/about/<?=$permalink?>.html"><?=$company["company"]?></a></h2>
                                    <ul class="list-inline mbxs">
                                        <li><i class="fa fa-hospital-o mrsm"></i><?=$company["field"]?></li>
                                        <li><i class="fa fa-map-marker mrsm"></i><?=$company["city"].", ".$company["country"]?></li>
                                        <li><i class="fa fa-group mrsm"></i><?=$company["size"]?></li>
                                    </ul>
                                    <p class="mbxs"><?=character_limiter($company["description"],180)?></p>
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
                                    <a href="<?=site_url()?>company/jobs/<?=$permalink?>.html" class="btn btn-primary"><i class="fa fa-navicon mrsm"></i>JOBS</a>
                                    <a href="<?=site_url()?>company/detail/<?=$permalink?>.html" class="btn btn-warning"><i class="fa fa-search mrsm"></i>INFO</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end of featured company -->

                <?php
                endforeach;
            }
            ?>
        </div>
        <?php
        if(isset($companies) && count($companies) != 0){
            ?>

            <a href="<?=site_url()?>page/search.html?query=<?=$keyword?>&section=company" class="center-block text-center lead"><i class="fa fa-chevron-down mrsm"></i>SEE MORE COMPANIES</a>

        <?php
        }
        ?>
    </div>
    <div>
        <hr>
        <h5><i class="fa fa-user-md"></i> Employee Result (<?=$employees_total?> founds)</h5>
        <hr>
        <div>
            <?php
            if(isset($employees))
            {
                foreach($employees as $employee):
                    ?>
                    <section class="about-section people">
                        <div class="row">
                            <div class="col-md-2 col-sm-3">
                                <div class="image-wrapper people-avatar center-block" style="width: 100px; height: 100px;">
                                    <img src="<?=base_url()?>assets/img/avatar/<?=$employee["emp_avatar"]?>" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-9">
                                <h1 class="name mn"><a href="<?=site_url()?>account/detail/<?=permalink($employee["emp_name"],$employee["emp_id"])?>"><?=$employee["emp_name"]?></a></h1>
                                <p class="lead">Hello There,</p>
                                <p><?=$employee["emp_about"]?></p>
                            </div>
                        </div>
                    </section>
                    <hr>
                <?php
                endforeach;
            }
            ?>
        </div>
        <?php
        if(isset($employees) && count($employees) != 0){
            ?>

            <a href="<?=site_url()?>page/search.html?query=<?=$keyword?>&section=employee" class="center-block text-center lead"><i class="fa fa-chevron-down mrsm"></i>SEE MORE EMPLOYEES</a>

        <?php
        }
        ?>
    </div>
</section>

<section class="ptlg">
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>