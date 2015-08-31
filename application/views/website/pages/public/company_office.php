<section>
    <div class="container">
        <div class="tab-navigation">
            <ul class="list-inline">
                <li><a href="<?=site_url()?>company/about/<?=$this->uri->segment(3)?>.html">ABOUT US</a></li>
                <li class="active"><a href="<?=site_url()?>company/office/<?=$this->uri->segment(3)?>.html">OFFICE</a></li>
                <li><a href="<?=site_url()?>company/people/<?=$this->uri->segment(3)?>.html">PEOPLE</a></li>
                <li><a href="<?=site_url()?>company/job/<?=$this->uri->segment(3)?>.html">JOBS</a></li>
            </ul>
        </div>
    </div>
</section>


<!-- FEATURED ABOUT -->
<section class="section overlay">
    <div class="container">
        <div class="featured-image office">
            <div class="image-wrapper">
                <img src="<?=base_url()?>assets/img/office/<?=$primary["cph_resource"]?>" class="img-responsive">
            </div>
            <div class="featured-info block hidden-xs">
                <div class="row">
                    <div class="col-md-8 label">
                        <h1><?=$company["company"]?></h1>
                        <p>Company Headquarter located at <?=$company["city"]?>, <?=$company["country"]?></p>
                    </div>
                    <div class="col-md-4 hidden-sm hidden-xs info">
                        <h1><i class="fa fa-search-plus mrsm"></i> ENLARGE</h1>
                        <p>PHOTO OFFICE</p>
                    </div>
                </div>
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
        <section class="photo-featured">
            <div class="row">
                <?php
                if(isset($secondary))
                {
                    foreach($secondary as $photo):
                        ?>

                        <div class="col-md-4">
                            <div class="featured-company detail">
                                <a href="#">
                                    <div class="featured-image">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$photo["cph_resource"]?>" class="img-responsive center-block">
                                        </div>
                                        <div class="featured-info">
                                            <div class="wrapper">
                                                <h1><i class="fa fa-search-plus mrsm"></i> ENLARGE</h1>
                                                <p>OFFICE PHOTO</p>
                                            </div>
                                        </div>
                                        <div class="featured-label">
                                            <?=$photo["cph_title"]?>
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
            <div class="row">
                <?php
                $column = "col-md-12";
                if($world["cst_featured"] != null){
                    $column = "col-md-7";
                    ?>
                        <div class="col-md-5">
                            <img src="<?=base_url()?>assets/img/office/<?=$world["cst_featured"]?>" class="img-responsive">
                        </div>
                    <?php
                }
                ?>

                <div class="<?=$column?>">
                    <header>
                        <p class="lead"><?=$company["company"]?> In The World</p>
                        <h2><?=$world["cst_title"]?></h2>
                    </header>
                    <section>
                        <p>
                            <?=$world["cst_description"]?>
                        </p>
                    </section>
                </div>
            </div>
        </section>
        <section class="about-section">
            <div class="row">
                <?php
                $column = "col-md-12";
                if($life["cst_featured"] != null){
                    $column = "col-md-7";
                }
                ?>
                <div class="<?=$column?>">
                    <header>
                        <p class="lead">Office Life</p>
                        <h2><?=$life["cst_title"]?></h2>
                    </header>
                    <section>
                        <p><?=$life["cst_description"]?></p>
                    </section>
                </div>
                <?php
                if($column == "col-md-7"){
                    ?>
                    <div class="col-md-5">
                        <img src="<?=base_url()?>assets/img/office/<?=$life["cst_featured"]?>" class="img-responsive">
                    </div>
                    <?php
                }
                ?>

            </div>
        </section>
        <section class="about-section">
            <header>
                <p class="lead">Office Location</p>
                <h2><?=$location["cst_title"]?></h2>
            </header>
            <section>
                <p><?=$location["cst_description"]?></p>
            </section>
        </section>
    </div>
    <div class="map">
        <img src="<?=base_url()?>assets/img/office/<?=$location["cst_featured"]?>" class="img-responsive center-block">
    </div>
    <div class="container">
        <section class="about-section">
            <header>
                <p class="lead">Office Unique</p>
                <h2><?=$unique["cst_title"]?></h2>
            </header>
            <section>
                <p><?=$unique["cst_description"]?></p>
            </section>
        </section>
        <div class="photo-featured">
            <?php
            if(isset($photos))
            {
                foreach($photos as $photo):
                ?>

                    <a href="<?=base_url()?>assets/img/office/<?=$photo["cph_resource"]?>" target="_blank">
                        <div class="photo-grid">
                            <div class="image-wrapper">
                                <img src="<?=base_url()?>assets/img/office/<?=$photo["cph_resource"]?>" class="img-responsive center-block">
                            </div>
                            <div class="featured-info">
                                <div class="wrapper">
                                    <h1><i class="fa fa-search-plus mrsm"></i> ENLARGE</h1>
                                    <p>PHOTO OFFICE</p>
                                </div>
                            </div>
                        </div>
                    </a>

                <?php
                endforeach;
            }
            ?>

        </div>
    </div>
</section>