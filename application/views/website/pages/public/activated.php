<!-- BANNER -->
<section>
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>

<section class="section">
    <div class="container center-block">
        <div style="margin: auto; max-width: 600px">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    if(isset($status)){
                        if($status){
                            ?>

                            <h1 class="pull-left mllg mrmd mtsm"><i class="fa fa-check-circle-o"></i></h1>
                            <h3 class="mbn mtsm">Activated Success,</h3>
                            <p class="mbn">Now you can using your account to access your dashboard</p>
                            <p class="text-muted"><a href="<?=base_url()?>page/login.html">Click here,</a> to access login page</p>

                            <?php
                        }
                        else{
                            ?>

                            <h1 class="pull-left mllg mrmd mtsm"><i class="fa fa-remove"></i></h1>
                            <h3 class="mbn mtsm">Activated Failed,</h3>
                            <p class="mbn">Make sure you have registered</p>
                            <p class="text-muted"><a href="<?=base_url()?>page/register.html">Click here,</a> to access register page</p>

                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- JOBS RELATION -->
<section class="section">
    <img src="<?=base_url()?>assets/img/layout/featured-block-medicjob.png" class="img-responsive">
</section>