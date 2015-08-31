<!-- MODALS -->
<div class="modal fade" id="modal-resume-skill" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>skill/create" method="post" id="jm-form-skill">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user mrsm"></i>Skill</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-skill-begin" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <select class="form-control select select-primary mbl required" title="This field is required." id="jm-skill-category" name="jm-skill-category" required>
                                <option value="" <?php echo set_select('jm-skill-category', '', TRUE); ?>>Select Skill Category</option>
                                <?php
                                if(isset($skill_categories)){
                                    foreach($skill_categories as $category):
                                    ?>

                                    <option value="<?=$category["sct_id"]?>" <?php echo set_select('jm-skill-category', $category["sct_id"]); ?>><?=$category["sct_category"]?></option>

                                    <?php
                                    endforeach;
                                    }
                                ?>
                            </select>
                            <span class="text-muted">Eg: Arts, Sport, Medic</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-skill-skill" class="col-sm-3 control-label">Skill</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-skill-skill" name="jm-skill-skill" placeholder="Enter your skill" required maxlength="30" value="<?=set_value('jm-skill-skill');?>">
                            <span class="text-muted">Eg: Drawing, Programming, Music</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-skill-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-skill-description" name="jm-skill-description" placeholder="Field that you mastered" required maxlength="50" value="<?=set_value('jm-skill-description');?>">
                            <span class="text-muted">Eg: Illustration, Abstract, Brush Paint</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-skill-value" class="col-sm-3 control-label">Skill Level</label>
                        <div class="col-sm-9">
                            <div class="mtxs">
                                <div class="radio-inline">
                                    <label class="radio" for="jm-value-1">
                                        <input type="radio" value="1" id="jm-value-1" name="jm-skill-value" data-toggle="radio" class="custom-radio required" <?php echo set_radio('jm-skill-level', '1');?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        1
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="radio" for="jm-value-2">
                                        <input type="radio" value="2" id="jm-value-2" name="jm-skill-value" data-toggle="radio" class="custom-radio" <?php echo set_radio('jm-skill-level', '2');?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        2
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="radio" for="jm-value-3">
                                        <input type="radio" value="3" id="jm-value-3" name="jm-skill-value" data-toggle="radio" class="custom-radio" <?php echo set_radio('jm-skill-level', '3', TRUE);?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        3
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="radio" for="jm-value-4">
                                        <input type="radio" value="4" id="jm-value-4" name="jm-skill-value" data-toggle="radio" class="custom-radio" <?php echo set_radio('jm-skill-level', '4');?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        4
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="radio" for="jm-value-5">
                                        <input type="radio" value="5" id="jm-value-5" name="jm-skill-value" data-toggle="radio" class="custom-radio" <?php echo set_radio('jm-skill-level', '5');?>>
                                        <span class="icons">
                                            <span class="icon-unchecked"></span>
                                            <span class="icon-checked"></span>
                                        </span>
                                        5
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Skill</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->