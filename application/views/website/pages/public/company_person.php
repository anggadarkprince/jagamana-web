<section>
    <div class="container">
        <div class="tab-navigation">
            <ul class="list-inline">
                <li><a href="<?=site_url()?>company/about/<?=permalink($company["company"], $company["company_id"])?>.html">ABOUT US</a></li>
                <li><a href="<?=site_url()?>company/office/<?=permalink($company["company"], $company["company_id"])?>.html">OFFICE</a></li>
                <li class="active"><a href="<?=site_url()?>company/people/<?=permalink($company["company"], $company["company_id"])?>.html">PEOPLE</a></li>
                <li><a href="<?=site_url()?>company/job/<?=permalink($company["company"], $company["company_id"])?>.html">JOBS</a></li>
            </ul>
        </div>
    </div>
</section>


<!-- FEATURED ABOUT -->
<section class="section text-justify overlay">
    <div class="container">
        <div class="featured-image people">
            <div class="image-wrapper">
                <img src="<?=base_url()?>assets/img/people/<?=$person["plp_cover"]?>" class="img-responsive">
            </div>
            <div class="featured-info hidden-xs">
                <h1><?=$person["plp_name"]?></h1>
                <p><?=$person["plp_position"]?></p>
                <span>
                    <?=$person["plp_caption"]?>
                </span>
            </div>
        </div>
        <div class="row mtmd">
            <div class="col-md-7">
                <ul class="list-inline mtsm">
                    <li><i class="fa fa-hospital-o mrsm"></i><?=$company["field"]?></li>
                    <li><i class="fa fa-map-marker mrsm"></i><?=$company["city"]?>, <?=$company["country"]?></li>
                    <li><i class="fa fa-group mrsm"></i><?=$company["size"]?></li>
                </ul>
            </div>
            <div class="col-md-5">
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

<section class="section text-justify">
    <div class="container">
        <section class="about-section people">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="image-wrapper people-avatar center-block">
                        <img src="<?=base_url()?>assets/img/people/<?=$person["plp_avatar"]?>" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-9 col-sm-9">
                    <h1 class="name"><?=$person["plp_name"]?></h1>
                    <h3><?=$person["plp_position"]?></h3>
                    <p class="lead">Hello There,</p>
                    <p><?=$person["plp_about"]?></p>
                    <div class="row">
                        <div class="col-md-7">
                            <a href="<?=$person["plp_facebook"]?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-facebook.png"></a>
                            <a href="<?=$person["plp_twitter"]?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-twitter.png"></a>
                            <a href="<?=$person["plp_google"]?>" target="_blank"><img src="<?=base_url()?>assets/img/layout/social-google.png"></a>
                        </div>
                        <div class="col-md-5">
                            <p class="signature"><?=$person["plp_name"]?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="about-section">
            <header>
                <p class="lead">What <?=$person["plp_name"]?> Does</p>
                <h2><?=$work["pst_title"]?></h2>
            </header>
            <section>
                <p><?=$work["pst_description"]?></p>
            </section>
        </section>
        <section class="photo-featured people">
            <div class="row">
                <?php
                if(isset($photos))
                {
                    foreach($photos as $photo):
                    ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="featured-company detail">
                                <a href="#">
                                    <div class="featured-image">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/people/<?=$photo["pph_resource"]?>" class="img-responsive center-block">
                                        </div>
                                        <div class="featured-info">
                                            <div class="wrapper">
                                                <h1><i class="fa fa-search-plus mrsm"></i> ENLARGE</h1>
                                                <p>PHOTO OFFICE</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    <?php
                    endforeach;
                }
                ?>
            </div>
        </section>
        <section class="about-section">
            <header>
                <p class="lead"><?=$person["plp_name"]?> Daily At Work</p>
                <h2><?=$daily["pst_title"]?></h2>
            </header>
            <section>
                <p><?=$daily["pst_description"]?></p>
            </section>
        </section>
        <section class="about-section">
            <header>
                <p class="lead"><?=$person["plp_name"]?> About The Company</p>
                <h2><?=$opinion["pst_title"]?></h2>
            </header>
            <section>
                <p><?=$opinion["pst_description"]?></p>
            </section>
        </section>
    </div>
</section>