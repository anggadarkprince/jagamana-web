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
    </div>

    <div class="text-center">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>

<section class="ptlg">
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>