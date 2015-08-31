<div class="title-section">
    <div class="title">
        <h1>Setings</h1>
    </div>
    <p class="subtitle">This template has a responsive menu toggling system.
        The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens.</p>

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

    <div class="mblg">
        <form action="<?=site_url()?>setting/update_administrator" method="post" enctype="multipart/form-data" id="jm-form-setting" role="form">
            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend>Website Settings</legend>
                    </fieldset>
                    <div class="form-group">
                        <label for="jm-setting-website">Website Name</label>
                        <input id="jm-setting-website" name="jm-setting-website" class="form-control" type="text" required placeholder="Name of site" value="<?=set_value("jm-setting-website",$setting["Website Name"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-description">Description</label>
                        <textarea id="jm-setting-description" name="jm-setting-description" class="form-control" required placeholder="Description of site" rows="3"><?=set_value("jm-setting-description",$setting["Description"])?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-keyword">Keyword</label>
                        <input id="jm-setting-keyword" name="jm-setting-keyword" class="form-control" type="text" required placeholder="Keyword separated by coma" value="<?=set_value("jm-setting-keyword",$setting["Keyword"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-email">Email</label>
                        <input id="jm-setting-email" name="jm-setting-email" class="form-control" type="email" required placeholder="Email address contact" value="<?=set_value("jm-setting-email",$setting["Email"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-contact">Contact</label>
                        <input id="jm-setting-contact" name="jm-setting-contact" class="form-control" type="text" required placeholder="Email contact number" value="<?=set_value("jm-setting-contact",$setting["Contact"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-address">Address</label>
                        <input id="jm-setting-address" name="jm-setting-address" class="form-control" type="text" required placeholder="Business office address" value="<?=set_value("jm-setting-address",$setting["Address"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-facebook">Facebook</label>
                        <input id="jm-setting-facebook" name="jm-setting-facebook" class="form-control" type="url" placeholder="Put official facebook account" value="<?=set_value("jm-setting-facebook",$setting["Facebook"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-twitter">Twitter</label>
                        <input id="jm-setting-twitter" name="jm-setting-twitter" class="form-control" type="url" placeholder="Put official twitter account" value="<?=set_value("jm-setting-twitter",$setting["Twitter"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-google">Google+</label>
                        <input id="jm-setting-google" name="jm-setting-google" class="form-control" type="url" placeholder="Put official google+ account" value="<?=set_value("jm-setting-google",$setting["Google"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-favicon">Favicon</label>
                        <div class="row">
                            <div class="col-md-2">
                                <img src="<?=base_url()?>assets/img/layout/<?=$setting["Favicon"]?>" class="img-responsive" width="50">
                            </div>
                            <div class="col-md-10">
                                <input id="jm-setting-favicon" name="jm-setting-favicon" type="file">
                                <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">SAVE CHANGES</button>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <legend>Profile Settings</legend>
                    </fieldset>
                    <div class="form-group">
                        <?php
                        $default = "";
                        if($administrator["adm_avatar"] == "noimage.jpg" || $administrator["adm_avatar"] == null){
                            $default = "empty";
                        }
                        ?>
                        <label for="jm-setting-avatar">Avatar</label>
                        <div class="select-image small square <?=$default?>">
                            <div class="image-wrapper">
                                <img src="<?=base_url()?>assets/img/avatar/<?=$administrator["adm_avatar"]?>" class="img-responsive select-image-preview"/>
                            </div>
                            <input type="file" class="form-control select-image-file" id="jm-setting-avatar" name="jm-setting-avatar" placeholder="Select avatar image">
                        </div>
                        <span class="text-muted">Avatar image, for best view recommended 500px x 500px dimension</span>
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-name">Name</label>
                        <input id="jm-setting-name" name="jm-setting-name" class="form-control" type="text" required maxlength="50" placeholder="Your complete name" value="<?=set_value("jm-setting-about", $administrator["adm_name"])?>">
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-about">About</label>
                        <textarea id="jm-setting-about" name="jm-setting-about" class="form-control" rows="3" placeholder="Tell short story about your self" required maxlength="200"><?=set_value("jm-setting-about", $administrator["adm_about"])?></textarea>
                    </div>
                    <div class="form-group">
                        <?php
                        $male = false;
                        $female = false;
                        if($administrator["adm_gender"] == "MALE"){
                            $male = true;
                        }
                        if($administrator["adm_gender"] == "FEMALE"){
                            $female = true;
                        }
                        ?>
                        <label class="mrmd" for="jm-gender-male">Gender</label>
                        <input type="radio" name="jm-setting-gender" value="MALE" id="jm-gender-male" class="required" <?=set_radio("jm-setting-gender", "MALE", $male)?>> <label for="jm-gender-male">Male</label>
                        <input type="radio" name="jm-setting-gender" value="FEMALE" id="jm-gender-female" class="mlmd" <?=set_radio("jm-setting-gender","FEMALE",$female)?>> <label for="jm-gender-female">Female</label>
                    </div>
                    <div class="form-group">
                        <label for="jm-setting-current">Current Password</label>
                        <input id="jm-setting-current" name="jm-setting-current" class="form-control" required maxlength="32" value="<?=set_value("jm-setting-current")?>" type="password" placeholder="Put your current secret key">
                    </div>

                    <div class="form-group">
                        <label for="jm-setting-new">New Password</label>
                        <input id="jm-setting-new" name="jm-setting-new" class="form-control" maxlength="32" value="<?=set_value("jm-setting-new")?>" type="password" placeholder="Put your new secret key">
                    </div>

                    <div class="form-group">
                        <label for="jm-setting-confirm">Confirm Password</label>
                        <input id="jm-setting-confirm" name="jm-setting-confirm" maxlength="32" value="<?=set_value("jm-setting-confirm")?>" class="form-control" type="password" placeholder="Confirm your secret key">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>