<img src="<?=base_url()?>assets/img/layout/map.jpg" class="center-block img-responsive">

<section class="container contact">
    <div class="row">
        <div class="col-md-6">
            <h4>MAIL US</h4>
            <h1>FILL THE FORM</h1>
            <p class="mbmd">Untuk memberikan feedback kepada administrator dan pengembang, silakan isi contact form berikut ini secara lengkap dan jelas.</p>
            <!-- alert -->
            <?php
            if($this->session->flashdata('jm-operation')!= NULL)
            {
                ?>
                <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('jm-message'); ?>
                </div>
            <?php
            }
            ?>
            <!-- end of alert -->
            <form action="<?=site_url()?>feedback/submit_feedback" method="post" id="jm-form-feedback">
                <div class="form-group">
                    <label class="control-label" for="sl-feedback-name">Name</label>
                    <input type="text" name="jm-feedback-name" id="jm-feedback-name" class="form-control" value="<?=isset($data_contact)?$data_contact["fdb_name"]:""?>" placeholder="Enter your name" required />
                </div>
                <div class="form-group">
                    <label class="control-label" for="sl-feedback-email">Email</label>
                    <input type="email" name="jm-feedback-email" id="jm-feedback-email" class="form-control" value="<?=isset($data_contact)?$data_contact["fdb_email"]:""?>" placeholder="Enter your email" required />
                </div>
                <div class="form-group">
                    <label class="control-label" for="sl-feedback-message">Message</label>
                    <textarea name="jm-feedback-message" id="jm-feedback-message" rows="5" class="form-control" placeholder="Enter your name" required><?=isset($data_contact)?$data_contact["fdb_message"]:""?></textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary bold">SUBMIT FEEDBACK</button>
                </div>
            </form>
        </div>
        <div class="col-md-5 col-md-push-1">
            <h4>CONTACT US</h4>
            <h1>MEET US AT</h1>
            <h6 class="mtlg mbxs">Sketch Project Studio</h6>
            <p>We are provide support system for your business solutions</p>


            <ul class="list-unstyled">
                <li class="mbxs"><strong class="mrsm"><span class="icon-envelope2 mrsm"></span> Email </strong> <a href="mailto:sketchprojectstudio@gmail.com">sketchprojectstudio@gmail.com</a></li>
                <li class="mbxs"><strong class="mrsm"><span class="icon-phone mrsm"></span> Telephone </strong> <a href="tel:+6285655479868">+6285655479868</a></li>
                <li class="mbxs"><strong class="mrsm"><span class="icon-location mrsm"></span> Address </strong> Jl Jawa 6 No 5 Jember Indonesia</li>
            </ul>

            <h5 class="mbxs mtlg">JAGAMANA</h5>
            <p class="text-muted mbxs">Medical Jobs Marketplace</p>
            <p><?=get_setting("Description")?></p>

            <ul class="list-inline">
                <li class="mrsm"><a href="<?=site_url()?>jobs.html">Jobs</a></li>
                <li class="mrsm"><a href="<?=site_url()?>company.html">Company</a></li>
                <li class="mrsm"><a href="<?=site_url()?>page/privacy.html">Privacy</a></li>
                <li class="mrsm"><a href="<?=site_url()?>page/disclaimer.html">Disclaimer</a></li>
                <li class="mrsm"><a href="<?=site_url()?>page/help.html">Help</a></li>
            </ul>

            <br>
            <p class="hidden-xs mbxs">&copy; Copyright <?=date("Y")?> Sketch Project Studio</p>
        </div>
    </div>
</section>

<section class="ptlg">
    <img src="<?=base_url()?>assets/img/layout/section-header-bg.png" class="img-responsive">
</section>