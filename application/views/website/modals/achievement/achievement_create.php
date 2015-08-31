<!-- MODALS -->
<div class="modal fade" id="modal-achievement-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>achievement/create" method="post" id="jm-form-achievement">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-medkit mrsm"></i>Achievement Create</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-achievement-award" class="col-sm-3 control-label">Achievement</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-achievement-award" name="jm-achievement-award" placeholder="Enter your achievement award" required maxlength="45" value="<?=set_value('jm-achievement-award');?>">
                            <span class="text-muted">Eg: The Best Company Ever</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-achievement-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="jm-achievement-description" name="jm-achievement-description" placeholder="Put your achievement description" required maxlength="150"><?=set_value('jm-achievement-description');?></textarea>
                            <span class="text-muted">Eg: Professional award international level</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-achievement-earned" class="col-sm-3 control-label">From</label>
                        <div class="col-sm-9">
                            <select class="form-control select select-primary mbl required" title="This field is required." id="jm-achievement-earned" name="jm-achievement-earned" required>
                                <option value="" <?php echo set_select('jm-achievement-earned', '', TRUE); ?>>Select Year</option>
                                <?php
                                for($i = date("Y"); $i > (date("Y")-60); $i--):
                                    ?>

                                    <option value="<?=$i?>" <?php echo set_select('jm-achievement-earned', $i); ?>><?=$i?></option>

                                <?php
                                endfor;
                                ?>
                            </select>
                            <span class="text-muted">Eg: Achieved at 2010</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Achievement</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->