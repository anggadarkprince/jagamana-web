<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="form-section">
                        <div class="title">
                            <h3><i class="fa fa-building"></i> Bookmark</h3>
                            <p>Jobs list you have saved</p>
                        </div>
                        <?php
                        if(isset($bookmarks))
                        {
                            if(count($bookmarks) == 0){
                                echo "<hr><p class='text-center'>No jobs saved</p><hr>";
                            }
                            foreach($bookmarks as $bookmark):
                                $permalink = permalink($bookmark["vacancy"],$bookmark["job_id"]);
                                if($bookmark["job_id"] == null)
                                {
                                    ?>

                                    <hr>
                                    <div class="featured-job">
                                        <div class="featured-body">
                                            <p><span class="job-title">This job has been removed by company</p>
                                            <a href="<?=base_url()?>bookmark/delete/" class="text-muted delete" data-id="<?=$bookmark["bookmark_id"]?>"><i class="fa fa-remove"></i> REMOVE</a>
                                        </div>
                                    </div>
                                    <hr>

                                <?php
                                }
                                else{
                                    ?>

                                    <div class="featured-job">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="featured-image">
                                                    <div class="image-wrapper">
                                                        <img src="<?=base_url()?>assets/img/office/<?=$bookmark["featured"]?>" class="center-block">
                                                    </div>
                                                    <p class="company-title text-uppercase"><?=$bookmark["company"]?></p>
                                                    <label class="job-label <?=strtolower($bookmark["type"])?>"><i class="fa fa-clock-o mrsm"></i><?=strtoupper($bookmark["type"])?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="featured-body">
                                                    <h2><a href="<?=site_url()?>job/detail/<?=$permalink?>.html" class="job-title"><?=ucwords($bookmark["vacancy"])?></a></h2>
                                                    <p><?=character_limiter($bookmark["description"], 250)?> <a href="<?=site_url()?>job/detail/<?=$permalink?>.html">Details</a></p>
                                                </div>
                                                <div class="featured-control">
                                                    <ul class="list-inline mtsm">
                                                        <li><i class="fa fa-map-marker mrsm"></i><?=$bookmark["city"]?> ,<?=$bookmark["country"]?></li>
                                                        <li><i class="fa fa-pencil mrsm"></i><?=$bookmark["field"]?></li>
                                                        <li><i class="fa fa-check mrsm"></i><?=$bookmark["level"]?></li>
                                                    </ul>
                                                    <a href="#" class="btn btn-invert btn-bookmark-control btn-remove-bookmark active" data-job="<?=$bookmark["job_id"]?>"><i class="fa fa-star mrsm"></i>SAVED</a>
                                                    <a href="<?=site_url()?>job/detail/<?=$permalink?>.html" class="btn btn-danger"><i class="fa fa-search mrsm"></i>SEE JOB</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end of featured job -->

                                <?php
                                }
                            endforeach;
                        }
                        ?>

                        <a href="<?=site_url()?>job/all.html" class="btn btn-dash btn-block"><i class="fa fa-plus-circle"></i> MORE JOBS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>