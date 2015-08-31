<section>
    <div class="container">
        <div class="tab-navigation">
            <ul class="list-inline">
                <li><a href="<?=site_url()?>company/about/<?=$this->uri->segment(3)?>.html">ABOUT US</a></li>
                <li><a href="<?=site_url()?>company/office/<?=$this->uri->segment(3)?>.html">OFFICE</a></li>
                <li class="active"><a href="<?=site_url()?>company/people/<?=$this->uri->segment(3)?>.html">PEOPLE</a></li>
                <li><a href="<?=site_url()?>company/job/<?=$this->uri->segment(3)?>.html">JOBS</a></li>
            </ul>
        </div>
    </div>
</section>

<section class="section text-justify">
    <div class="container">
        <?php
        if(isset($people))
        {
            foreach($people as $person):
            ?>
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
                                <div class="col-md-12">
                                    <p class="lead"><a href="<?=site_url()?>company/person/<?=permalink($person["plp_name"], $person["plp_id"])?>/<?=$company["company_id"]?>">SEE MORE ABOUT <strong><?=strtoupper($person["plp_name"])?></strong></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <hr>
            <?php
            endforeach;
        }
        ?>
    </div>
</section>