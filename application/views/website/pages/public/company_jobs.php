<section>
    <div class="container">
        <div class="tab-navigation">
            <ul class="list-inline">
                <li><a href="<?=site_url()?>company/about/<?=permalink($company["company"], $company["company_id"])?>.html">ABOUT US</a></li>
                <li><a href="<?=site_url()?>company/office/<?=permalink($company["company"], $company["company_id"])?>.html">OFFICE</a></li>
                <li><a href="<?=site_url()?>company/people/<?=permalink($company["company"], $company["company_id"])?>.html">PEOPLE</a></li>
                <li class="active"><a href="<?=site_url()?>company/job/<?=permalink($company["company"], $company["company_id"])?>.html">JOBS</a></li>
            </ul>
        </div>
    </div>
</section>


<!-- FEATURED ABOUT -->
<section class="section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="image-wrapper">
                    <img src="<?=base_url()?>assets/img/avatar/<?=$company["logo"]?>" class="img-responsive">
                </div>
            </div>
            <div class="col-md-6">
                <div class="featured-job mbn">
                    <div class="featured-control">
                        <div class="button">
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
    </div>
</section>

<section class="section">
    <div class="container">
        <?php
        if(isset($jobs))
        {
            foreach($jobs as $job):
            ?>

                <div class="featured-job detail">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="featured-image">
                                <div class="image-wrapper">
                                    <img src="<?=base_url()?>assets/img/office/<?=$company["featured"]?>" class="center-block">
                                </div>
                                <p class="company-title text-uppercase"><?=$company["company"]?></p>
                                <small class="info"><?=$job["applicant"]?> APPLIED THIS JOB</small>
                                <label class="job-label <?=strtolower($job["type"])?>"><i class="fa fa-clock-o mrsm"></i><?=$job["type"]?></label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="featured-body">
                                <h2><a href="<?=site_url()?>job/detail/<?=permalink($job["vacancy"],$job["job_id"])?>"><?=$job["vacancy"]?></a></h2>
                                <p><?=$job["description"]?> <a href="<?=site_url()?>job/detail/<?=permalink($job["vacancy"],$job["job_id"])?>">Details</a></p>
                            </div>
                            <div class="featured-control">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="list-inline">
                                            <li><i class="fa fa-map-marker mrsm"></i><?=$job["city"]?></li>
                                            <li><i class="fa fa-pencil mrsm"></i><?=$job["field"]?></li>
                                            <li><i class="fa fa-check mrsm"></i><?=$job["level"]?></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12">
                                        <a href="#" class="btn btn-invert"><i class="fa fa-star-o mrsm"></i>SAVE JOB</a>
                                        <a href="#" class="btn btn-danger"><i class="fa fa-search mrsm"></i>SEE JOB</a>
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
</section>