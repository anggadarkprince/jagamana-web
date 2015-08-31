<!-- MODALS -->
<div class="modal fade" id="modal-resume-experience" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>experience/create" method="post" id="jm-form-experience">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user mrsm"></i>Experience</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-experience-company" class="col-sm-3 control-label">Experience</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-experience-company" name="jm-experience-company" placeholder="Enter company or experience" required maxlength="45" value="<?=set_value('jm-experience-company');?>">
                            <span class="text-muted">Eg: Sketch Project Studio</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-experience-position" class="col-sm-3 control-label">Position</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-experience-position" name="jm-experience-position" placeholder="Your position or role" required maxlength="45" value="<?=set_value('jm-experience-position');?>">
                            <span class="text-muted">Eg: Programming Assistance</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-experience-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-experience-description" name="jm-experience-description" placeholder="Your work activity" required maxlength="50" value="<?=set_value('jm-experience-description');?>">
                            <span class="text-muted">Eg: Teaching, develop, maintenance</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-experience-begin" class="col-sm-3 control-label">From</label>
                        <div class="col-sm-9">
                            <select class="form-control select select-primary mbl required" title="This field is required." id="jm-experience-begin" name="jm-experience-begin" required>
                                <option value="" <?php echo set_select('jm-experience-begin', '', TRUE); ?>>Select Year</option>
                                <?php
                                for($i = date("Y"); $i > (date("Y")-60); $i--):
                                    ?>

                                    <option value="<?=$i?>" <?php echo set_select('jm-experience-begin', $i); ?>><?=$i?></option>

                                    <?php
                                endfor;
                                ?>
                            </select>
                            <span class="text-muted">Eg: 2010</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-experience-until" class="col-sm-3 control-label">Until</label>
                        <div class="col-sm-9">
                            <select class="form-control select select-primary mbl required" title="This field is required." id="jm-experience-until" name="jm-experience-until" required>
                                <option value="" <?php echo set_select('jm-experience-until', '', TRUE); ?>>Select Year</option>
                                <option value="Now" <?php echo set_select('jm-experience-until', 'Now'); ?>>Now</option>
                                <?php
                                for($i = date("Y"); $i > (date("Y")-60); $i--):
                                    ?>

                                    <option value="<?=$i?>" <?php echo set_select('jm-experience-until', $i); ?>><?=$i?></option>

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
                    <button type="submit" class="btn btn-primary">Add Experience</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->