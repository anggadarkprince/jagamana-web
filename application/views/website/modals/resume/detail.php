<!-- MODALS -->
<div class="modal fade" id="modal-resume-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>resume/update_detail" method="post" id="jm-form-detail">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user mrsm"></i>Personal Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-resume-name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-resume-name" name="jm-resume-name" placeholder="Enter your name" required maxlength="45" value="<?=set_value('jm-resume-name', $employee["emp_name"]);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-resume-gender" class="col-sm-3 control-label">Gender</label>
                        <div class="col-sm-9">
                            <div class="mtxs">
                                <?php
                                $male = FALSE;
                                $female = FALSE;
                                if($employee["emp_gender"] == "MALE")
                                {
                                    $male = TRUE;
                                }
                                if($employee["emp_gender"] == "FEMALE")
                                {
                                    $female = TRUE;
                                }
                                if($employee["emp_gender"] == null){
                                    $male = TRUE;
                                }

                                ?>
                                <div class="radio-inline">
                                    <label class="radio" for="jm-gender-male">
                                        <input type="radio" value="MALE" id="jm-gender-male" name="jm-resume-gender" data-toggle="radio" class="custom-radio required" <?php echo set_radio('jm-resume-gender', 'MALE', $male);?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        MALE
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="radio" for="jm-gender-female">
                                        <input type="radio" value="FEMALE" id="jm-gender-female" name="jm-resume-gender" data-toggle="radio" class="custom-radio" <?php echo set_radio('jm-resume-gender', 'FEMALE', $female);?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        FEMALE
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-resume-birthday" class="col-sm-3 control-label">Day of Bird</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" id="jm-resume-birthday" name="jm-resume-birthday" placeholder="Enter your birthday" required value="<?=set_value('jm-resume-birthday', date_format(date_create($employee["emp_birthday"]),"d F Y"));?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-resume-nationality" class="col-sm-3 control-label">Nationality</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-resume-nationality" name="jm-resume-nationality" placeholder="Country where you live" required maxlength="100" value="<?=set_value('jm-resume-nationality', $employee["emp_nationality"]);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-resume-address" class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-resume-address" name="jm-resume-address" placeholder="Your complete address" required maxlength="100" value="<?=set_value('jm-resume-address', $employee["emp_address"]);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-resume-contact" class="col-sm-3 control-label">Contact</label>
                        <div class="col-sm-9">
                            <input type="tel" class="form-control" id="jm-resume-contact" name="jm-resume-contact" placeholder="Put your contact number" required maxlength="100" value="<?=set_value('jm-resume-contact', $employee["emp_contact"]);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-resume-website" class="col-sm-3 control-label">Website</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control" id="jm-resume-website" name="jm-resume-website" placeholder="Put your personal website" required maxlength="100" value="<?=set_value('jm-resume-website', $employee["emp_website"]);?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Detail</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->