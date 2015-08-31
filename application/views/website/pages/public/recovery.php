<!-- RESET -->
<section class="register-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 featured hidden-xs">
                <img src="<?=base_url()?>assets/img/layout/featured-illustration-register.png" class="img-responsive">
                <h3>Hello World</h3>
                <h4>Let's Join with Us</h4>
                <p>Hundred people found new jobs everyday, what you waiting for?</p>
            </div>
            <div class="col-lg-6 col-md-7">
                <header>
                    <h2><i class="fa fa-repeat mrsm"></i>Reset Your Password!</h2>
                    <p>Put your new password below</p>
                </header>
                <section>
                    <!-- alert -->
                    <?php
                    if(isset($operation))
                    {
                        ?>
                        <div class="alert alert-<?=$operation?> alert-block alert-dismissible" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- end of alert -->
                    <form action="<?=site_url()?>authentication/reset" method="post" role="form" class="form-horizontal" id="jm-form-recovery">
                        <div class="form-group">
                            <label for="jm-register-email" class="col-lg-4 col-md-4"><i class="fa fa-envelope mrsm"></i>Email</label>
                            <div class="col-lg-8 col-md-8">
                                <label class="form-control-static"><?=$account["email"]?></label>
                                <input type="hidden" class="form-control" name="jm-reset-token" id="jm-reset-token" required="true" value="<?php echo set_value('jm-reset-token', $account["token"]);?>">
                                <input type="hidden" class="form-control" name="jm-reset-email" id="jm-reset-email" required="true" value="<?php echo set_value('jm-reset-email', $account["email"]);?>">
                                <input type="hidden" class="form-control" name="jm-reset-role" id="jm-reset-role" required="true" value="<?php echo set_value('jm-reset-role', $account["role"]);?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jm-reset-password" class="col-lg-4 col-md-4"><i class="fa fa-lock mrsm"></i>New Password</label>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control" name="jm-reset-password" id="jm-reset-password" placeholder="Enter your secret key" required="true" maxlength="45" value="<?php echo set_value('jm-reset-password', '');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jm-reset-confirm" class="col-lg-4 col-md-4"><i class="fa fa-lock mrsm"></i>Confirm</label>
                            <div class="col-lg-8 col-md-8">
                                <input type="password" class="form-control" name="jm-reset-confirm" id="jm-reset-confirm" placeholder="Repeat your secret key" required="true" maxlength="45" value="<?php echo set_value('jm-reset-confirm', '');?>">
                            </div>
                        </div>
                        <div class="form-group mn">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-block btn-lg btn-danger bold"><i class="fa fa-check-square-o mrsm"></i>RESET PASSWORD</button>
                                <a href="<?=site_url()?>page/login.html" class="center-block text-center mtsm">Remember your password? <strong>Login Now</strong></a>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section> <!-- end of register -->

<!-- JOBS RELATION -->
<section class="section">
    <img src="<?=base_url()?>assets/img/layout/featured-block-medicjob.png" class="img-responsive">
</section>