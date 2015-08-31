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
    </div>

    <div class="text-center">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>

<section class="ptlg">
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>