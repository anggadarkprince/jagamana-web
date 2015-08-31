<section class="section">
    <div class="container">
        <div class="main-content">
            <section class="about-section people">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="image-wrapper people-avatar center-block">
                            <img src="<?=base_url()?>assets/img/avatar/<?=$employee["emp_avatar"]?>" class="img-responsive">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <h1 class="name"><?=$employee["emp_name"]?></h1>
                        <p class="lead">Hello There,</p>
                        <p><?=$employee["emp_about"]?></p>
                    </div>
                </div>
            </section>

            <div class="tab-navigation">
                <ul class="list-inline">
                    <li><a href="<?=site_url()?>account/detail/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">RESUME</a></li>
                    <li class="active"><a href="<?=site_url()?>account/following/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">FOLLOWING</a></li>
                    <li><a href="<?=site_url()?>account/thread/<?=permalink($employee["emp_name"], $employee["emp_id"])?>.html">THREAD</a></li>
                </ul>
            </div>

            <div class="mtlg">
                <?php
                if(isset($following))
                {
                    foreach($following as $row):
                        $permalink = permalink($row["company"],$row["company_id"]);
                    ?>

                        <div class="featured-company detail">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="featured-image">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/office/<?=$row["featured"]?>" class="img-responsive center-block">
                                        </div>
                                        <div class="featured-info">
                                            <div class="wrapper">
                                                <p>See Inside the Office of</p>
                                                <h1><?=$row["company"]?></h1>
                                            </div>
                                        </div>
                                        <div class="featured-label">
                                            <a href="#" class="more">SEE OUR OFFICE</a>|<a href="#" class="follower"><?=$row["follower"]?> FOLLOWER</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="featured-body">
                                        <h2 class="mtn mbxs"><a href="company_about.php"><?=$row["company"]?></a></h2>
                                        <ul class="list-inline mbxs">
                                            <li><i class="fa fa-hospital-o mrsm"></i><?=$row["field"]?></li>
                                            <li><i class="fa fa-map-marker mrsm"></i><?=$row["city"]?>, <?=$row["country"]?></li>
                                            <li><i class="fa fa-group mrsm"></i><?=$row["size"]?></li>
                                        </ul>
                                        <p class="mbxs"><?=$row["description"]?></p>
                                    </div>
                                    <div class="featured-control">
                                        <a href="#" class="btn btn-invert active btn-follow-control btn-unfollow" data-company="<?=$row["company_id"]?>"><i class="fa fa-star mrsm"></i>UNFOLLOW</a>
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
    </div>
</section>

<?php $this->load->view("website/modals/info"); ?>