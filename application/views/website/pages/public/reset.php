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
                    if(isset($account)){
                        if($account && $account != null){
                            ?>

                            <h1 class="pull-left mllg mrmd mtsm"><i class="fa fa-lock"></i></h1>
                            <h3 class="mbn mtsm">Password Reset Link Sent,</h3>
                            <p class="mbn">Check your email <?=$account["email"]?> to reset</p>
                            <p class="text-muted"><a href="<?=base_url()?>page/login.html">Click here,</a> to access login page</p>

                            <?php
                        }
                        else{
                            ?>

                            <h1 class="pull-left mllg mrmd mtsm"><i class="fa fa-remove"></i></h1>
                            <h3 class="mbn mtsm">Reset Password Failed,</h3>
                            <p class="mbn">We apologize, our system doesn't work correctly</p>
                            <p class="text-muted"><a href="<?=base_url()?>">Click here,</a> to return</p>

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