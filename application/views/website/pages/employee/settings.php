<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php $this->load->view("website/elements/sidebar"); ?>
            </div>
            <div class="col-md-9">
                <div class="main-content">
                    <form action="<?=site_url()?>setting/update_employee" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="jm-form-setting">
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-user-md"></i> Account</h3>
                                <p>Update user account</p>
                            </div>

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

                            <div class="form-group">
                                <label for="jm-setting-name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9 col-md-6">
                                    <input type="text" class="form-control" id="jm-setting-name" name="jm-setting-name" placeholder="Put your name" value="<?=set_value('jm-setting-name', $setting["emp_name"])?>" required="true" maxlength="45">
                                    <span class="text-muted">Input your complete name</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <label class="control-label"><?=$setting["emp_email"]?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-setting-avatar" class="col-sm-3 control-label">Avatar</label>
                                <div class="col-sm-9">
                                    <?php
                                        $default = "";
                                        if($setting["emp_avatar"] == "noimage.jpg"){
                                            $default = "empty";
                                        }
                                    ?>
                                    <div class="select-image small square <?=$default?>">
                                        <div class="image-wrapper">
                                            <img src="<?=base_url()?>assets/img/avatar/<?=$setting["emp_avatar"]?>" id="jm-setting-avatar" class="img-responsive select-image-preview"/>
                                        </div>
                                        <input type="file" class="form-control select-image-file" id="avatar-primary" name="jm-setting-avatar" placeholder="Select avatar image">
                                    </div>
                                    <span class="text-muted">Avatar image, for best view recommended 500px x 500px dimension</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                </div>
                            </div>
                            <?php
                            $notification = FALSE;
                            if($setting["emp_notification"] == 1)
                            {
                                $notification = TRUE;
                            }
                            ?>
                            <div class="form-group">
                                <label for="jm-setting-notification" class="col-sm-3 control-label">Email Notification</label>
                                <div class="col-sm-9">
                                    <div class="mbsm">
                                        <input type="checkbox" data-toggle="switch" data-on-color="info" id="jm-setting-notification" name="jm-setting-notification" <?=set_checkbox('jm-setting-notification', "on", $notification); ?> />
                                    </div>
                                    <span class="text-muted">Update news and notification by email</span>
                                </div>
                            </div>
                            <?php
                            $status = FALSE;
                            if($setting["emp_status"] == "SUSPEND")
                            {
                                $status = TRUE;
                            }
                            ?>
                            <div class="form-group">
                                <label for="jm-setting-suspend" class="col-sm-3 control-label">Account Suspend</label>
                                <div class="col-sm-9">
                                    <div class="mbsm">
                                        <input type="checkbox" data-toggle="switch" data-on-color="info" id="jm-setting-suspend" name="jm-setting-suspend" <?=set_checkbox('jm-setting-suspend', "on", $status); ?>/>
                                    </div>
                                    <span class="text-muted">Can see and search by people</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-section">
                            <div class="title">
                                <h3><i class="fa fa-lock"></i> Change Password</h3>
                                <p>Keep your security strong</p>
                            </div>

                            <div class="form-group">
                                <label for="jm-password-current" class="col-sm-3 control-label">Current Password</label>
                                <div class="col-sm-9 col-md-6">
                                    <input type="password" class="form-control" id="jm-password-current" name="jm-password-current" placeholder="Your current password" required="true" maxlength="45">
                                    <span class="text-muted">Type current password to update</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-password-new" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-9 col-md-6">
                                    <input type="password" class="form-control" id="jm-password-new" name="jm-password-new" placeholder="New password">
                                    <span class="text-muted">Type new password</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jm-password-confirm" class="col-sm-3 control-label">Confirm Password</label>
                                <div class="col-sm-9 col-md-6">
                                    <input type="password" class="form-control" id="jm-password-confirm" name="jm-password-confirm" placeholder="Confirm password">
                                    <span class="text-muted">Type same like new password</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mtlg ptmd">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="reset" class="btn btn-default">RESET</button>
                                <button type="submit" class="btn btn-primary">SAVE CHANGES</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>