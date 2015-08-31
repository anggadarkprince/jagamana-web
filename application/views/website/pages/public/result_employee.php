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
    </div>

    <div class="text-center">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</section>

<section class="ptlg">
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>