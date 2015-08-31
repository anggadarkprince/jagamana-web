<!-- REGISTER -->
<section class="register-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 featured">
                <img src="<?=base_url()?>assets/img/layout/featured-illustration-register.png" class="img-responsive">
                <h3>Hello World</h3>
                <h4>Let health workers</h4>
                <p>Hundreds people found new jobs everyday, so what are you waiting for?</p>
            </div>
            <div class="col-lg-6 col-md-7">
                <header>
                    <h2><i class="fa fa-check-square-o mrsm"></i>Register Now!</h2>
                    <p>Register yourself and explore your talent.</p>
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
                    <form action="<?=site_url()?>register" method="post" role="form" class="form-horizontal" id="jm-form-register">
                        <div class="form-group">
                            <label for="jm-register-name" class="col-lg-3 col-md-3"><i class="fa fa-user mrsm"></i>Name</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="text" class="form-control" name="jm-register-name" id="jm-register-name" placeholder="Put your name here" required="true" maxlength="45" value="<?php echo set_value('jm-register-name', '');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jm-register-email" class="col-lg-3 col-md-3"><i class="fa fa-envelope mrsm"></i>Email</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="email" class="form-control" name="jm-register-email" id="jm-register-email" placeholder="Enter email as user ID" required="true" maxlength="45" value="<?php echo set_value('jm-register-email', '');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jm-register-password" class="col-lg-3 col-md-3"><i class="fa fa-lock mrsm"></i>Password</label>
                            <div class="col-lg-9 col-md-9">
                                <input type="password" class="form-control" name="jm-register-password" id="jm-register-password" placeholder="Enter your secret key" required="true" maxlength="45" value="<?php echo set_value('jm-register-password', '');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jm-register-employee" class="col-lg-3 col-md-3"><i class="fa fa-briefcase mrsm"></i>Register As</label>
                            <div class="col-lg-9 col-md-9">
                                <div class="radio-inline">
                                    <input type="radio" name="jm-register-role" id="jm-register-employee" value="jm-role-employee" class="required" checked>
                                    <label for="jm-register-employee" class="select-employee"><i class="fa fa-user-md"></i> Job Seeker</label>
                                </div>
                                <div class="radio-inline">
                                    <input type="radio" name="jm-register-role" id="jm-register-company" value="jm-role-company">
                                    <label for="jm-register-company" class="select-company"><i class="fa fa-briefcase"></i> Company</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mn">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-block btn-lg btn-danger bold"><i class="fa fa-check-square-o mrsm"></i>REGISTER</button>
                                <a href="<?=site_url()?>page/login.html" class="center-block text-center mtsm">Have an account? <strong>Login Now</strong></a>
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