<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <div class="tab-navigation guided">
                        <ul class="list-inline">
                            <li>
                                <div class="image-wrapper">
                                    <img width="80" src="<?=base_url()?>assets/img/people/<?=$people["plp_avatar"]?>" id="jm-people-avatar" class="select-image-preview"/>
                                </div>
                            </li>
                            <li><a href="<?=site_url()?>people/profile/<?=$this->uri->segment(3)?>.html">PROFILE</a></li>
                            <li class="active"><a href="<?=site_url()?>people/contact/<?=$this->uri->segment(3)?>.html">CONTACT</a></li>
                            <li><a href="<?=site_url()?>people/work/<?=$this->uri->segment(3)?>.html">WORK</a></li>
                            <li><a href="<?=site_url()?>people/photo/<?=$this->uri->segment(3)?>.html">MORE PHOTO</a></li>
                        </ul>
                    </div>
                    <!-- alert -->
                    <?php
                    if($this->session->flashdata('jm-operation')!= NULL)
                    {
                        ?>
                        <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible mtmd" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('jm-message'); ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- end of alert -->

                    <!-- alert -->
                    <?php
                    if(isset($operation))
                    {
                        ?>
                        <div class="alert alert-<?=$operation?> alert-block alert-dismissible mtmd" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- end of alert -->
                    <form action="<?=site_url()?>people/update_contact/<?=$this->uri->segment(3)?>.html" method="post" class="form-horizontal" role="form" id="jm-form-people">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-facebook"></i> Social</h3>
                                <p>People contact via social network</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-social-facebook" class="col-sm-2 control-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="jm-social-facebook" name="jm-social-facebook" placeholder="Facebook complete url" maxlength="100" value="<?=set_value("jm-social-facebook", $people["plp_facebook"])?>">
                                    <span class="text-muted">e.g. http://www.facebook.com/sketchproject</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-social-twitter" class="col-sm-2 control-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="jm-social-twitter" name="jm-social-twitter" placeholder="Twitter complete url" maxlength="100" value="<?=set_value("jm-social-twitter", $people["plp_twitter"])?>">
                                    <span class="text-muted">e.g. http://www.twitter.com/sketchproject</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-social-google" class="col-sm-2 control-label">Google+</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="jm-social-google" name="jm-social-google" placeholder="Google+ complete url" maxlength="100" value="<?=set_value("jm-social-google", $people["plp_google"])?>">
                                    <span class="text-muted">e.g. http://plus.gogole.com/sketchproject</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-social-linkedin" class="col-sm-2 control-label">LinkedIn</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="jm-social-linkedin" name="jm-social-linkedin" placeholder="LinkedIn complete url" maxlength="100" value="<?=set_value("jm-social-linkedin", $people["plp_linkedin"])?>">
                                    <span class="text-muted">e.g. http://www.linkedin.com/sketchproject</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-home"></i> Contact</h3>
                                <p>Stay keep in touch</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-contact-phone" class="col-sm-2 control-label">Contact</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" id="jm-contact-phone" name="jm-contact-phone" placeholder="Your contact number" required maxlength="100" value="<?=set_value("jm-contact-phone", $people["plp_contact"])?>">
                                    <span class="text-muted">e.g. (+62)85655479868</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-contact-address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jm-contact-address" name="jm-contact-address" placeholder="Your home address" required maxlength="100" value="<?=set_value("jm-contact-address", $people["plp_address"])?>">
                                    <span class="text-muted">e.g. Avenue Street 14</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-contact-email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="jm-contact-email" name="jm-contact-email" placeholder="Your email address" required maxlength="100" value="<?=set_value("jm-contact-email", $people["plp_email"])?>">
                                    <span class="text-muted">e.g. jhon.doe@company.com</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-website-email" class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="url" class="form-control" id="jm-cotact-website" name="jm-contact-website" placeholder="Your personal website" maxlength="100" value="<?=set_value("jm-contact-website", $people["plp_website"])?>">
                                    <span class="text-muted">e.g. http://www.sketchproject.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mtlg ptmd">
                            <div class="col-sm-offset-2 col-sm-10">
                                <a href="<?=site_url()?>people" class="btn btn-default">BACK TO LIST</a>
                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>