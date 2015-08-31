<!-- BANNER -->
<section>
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>

<section class="section">
    <div class="container center-block">
        <div style="margin: auto; max-width: 650px">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    if($status){
                        ?>
                        <h1 class="pull-left mllg mrmd mtsm"><i class="fa fa-envelope-square"></i></h1>
                        <h3 class="mbn mtsm">Your email has unsubscribed,</h3>
                        <p class="mbn">You can subscribe anytime</p>
                    <?php
                    }
                    else{
                        ?>
                        <h1 class="pull-left mllg mrmd mtsm"><i class="fa fa-remove"></i></h1>
                        <h3 class="mbn mtsm">Something wrong,</h3>
                        <p class="mbn">We apologize, try unsubscribe you email again</p>
                    <?php
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