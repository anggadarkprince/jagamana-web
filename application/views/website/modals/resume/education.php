<!-- MODALS -->
<div class="modal fade" id="modal-resume-education" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>education/create" method="post" id="jm-form-education">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user mrsm"></i>Education</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-education-grade" class="col-sm-3 control-label">Education</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-education-grade" name="jm-education-grade" placeholder="Enter your education grade" required maxlength="45" value="<?=set_value('jm-education-grade');?>">
                            <span class="text-muted">Eg: Bachelors Degree</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-education-institution" class="col-sm-3 control-label">Institution</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-education-institution" name="jm-education-institution" placeholder="Put your education institution" required maxlength="45" value="<?=set_value('jm-education-institution');?>">
                            <span class="text-muted">Eg: University of Jember - Informatics</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-education-location" class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-education-location" name="jm-education-location" placeholder="Where is your institution" required maxlength="45" value="<?=set_value('jm-education-location');?>">
                            <span class="text-muted">Eg: Jember, Indonesia</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-education-begin" class="col-sm-3 control-label">From</label>
                        <div class="col-sm-9">
                            <select class="form-control select select-primary mbl required" title="This field is required." id="jm-education-begin" name="jm-education-begin" required>
                                <option value="" <?php echo set_select('jm-education-begin', '', TRUE); ?>>Select Year</option>
                                <?php
                                for($i = date("Y"); $i > (date("Y")-60); $i--):
                                    ?>

                                    <option value="<?=$i?>" <?php echo set_select('jm-education-begin', $i); ?>><?=$i?></option>

                                    <?php
                                endfor;
                                ?>
                            </select>
                            <span class="text-muted">Eg: 2010</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-education-until" class="col-sm-3 control-label">Until</label>
                        <div class="col-sm-9">
                            <select class="form-control select select-primary mbl required" title="This field is required." id="jm-education-until" name="jm-education-until" required>
                                <option value="" <?php echo set_select('jm-education-until', '', TRUE); ?>>Select Year</option>
                                <option value="Now" <?php echo set_select('jm-education-until', 'Now'); ?>>Now</option>
                                <?php
                                for($i = date("Y"); $i > (date("Y")-60); $i--):
                                    ?>

                                    <option value="<?=$i?>" <?php echo set_select('jm-education-until', $i); ?>><?=$i?></option>

                                <?php
                                endfor;
                                ?>
                            </select>
                            <span class="text-muted">Eg: 2015</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Education</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->