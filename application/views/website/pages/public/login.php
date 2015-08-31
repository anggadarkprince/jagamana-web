<!-- BANNER -->
<section>
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>


<!-- LOGIN -->
<section class="login-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 login-form">
                <header>
                    <h2><i class="fa fa-sign-in mrsm"></i>Login Now!</h2>
                    <p>Access your dashboard and explore the jobs</p>
                </header>
                <section>

                    <div class="social-login">
                        <a href="#login-oauth" data-toggle="modal" class="btn btn-facebook center-block">
                            <i class="fa fa-facebook mrsm"></i>
                            Login with Facebook
                        </a>
                        <a href="#login-oauth" data-toggle="modal" class="btn btn-twitter center-block">
                            <i class="fa fa-twitter mrsm"></i>
                            Login with Twitter
                        </a>
                    </div>

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
                    <form role="form" action="<?=site_url()?>authentication/login" method="post" id="jm-form-login">
                        <div class="form-group">
                            <label for="jm-login-username"><i class="fa fa-user-md mrsm"></i>Username</label>
                            <input type="email" class="form-control" name="jm-login-email" id="jm-login-email" placeholder="Enter email or username" required="true" maxlength="45" value="<?=set_value('jm-login-email', '');?>">
                        </div>
                        <div class="form-group">
                            <label for="jm-login-password"><i class="fa fa-lock mrsm"></i>Password</label>
                            <input type="password" class="form-control" name="jm-login-password" id="jm-login-password" placeholder="Enter your secret key" required="true" maxlength="45" value="<?=set_value('jm-login-password', '');?>">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="checkbox" for="jm-login-remember">
                                        <input type="checkbox" checked="checked" value="1" id="jm-login-remember" data-toggle="checkbox" class="custom-checkbox"><span class="icons"><span class="icon-unchecked"></span><span class="icon-checked"></span></span>
                                        Remember Me
                                    </label>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a href="<?=site_url()?>page/register.html">Join with us?</a>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-danger bold"><i class="fa fa-sign-in mrsm"></i>LOGIN NOW</button>
                        <a href="#" class="center-block text-center mtsm" data-toggle="modal" data-target="#forgot-password">Forgot your password?</a>
                    </form>
                </section>
            </div>
            <div class="col-md-7 col-md-push-1 col-sm-5 col-sm-push-1 featured hidden-xs">
                <img src="<?=base_url()?>assets/img/layout/featured-illustration-login.png" class="img-responsive">
                <h3>Health Workers</h3>
                <p>One-Click Step to discover all information resource and discussion</p>
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section> <!-- end of login -->

<!-- JOBS RELATION -->
<section class="section">
    <img src="<?=base_url()?>assets/img/layout/featured-block-medicjob.png" class="img-responsive">
</section>


<?php $this->load->view("website/modals/reset"); ?>
<?php $this->load->view("website/modals/oauth"); ?>