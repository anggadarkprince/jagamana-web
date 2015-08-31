<!-- MODALS -->
<div class="modal fade" id="modal-level-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>level/create" method="post" id="jm-form-level">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel"><i class="fa fa-list-ul mrsm"></i>Level Create</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-level-name" class="col-sm-3 control-label">Level</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-level-name" name="jm-level-name" placeholder="Enter level name" required maxlength="45" value="<?=set_value('jm-level-name');?>">
                            <span class="text-muted">Eg: Entry, Middle</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-level-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea rows="5" class="form-control" id="jm-level-description" name="jm-level-description" placeholder="Put your level description" required maxlength="200"><?=set_value('jm-level-description');?></textarea>
                            <span class="text-muted">Describe level content should be</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Level</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->