<!-- MODALS -->
<div class="modal fade" id="modal-field-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>field/update" method="post" id="jm-form-field-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel"><i class="fa fa-list-ul mrsm"></i>Field Edit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-field-name" class="col-sm-3 control-label">Field</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-field-name" name="jm-field-name" placeholder="Enter field name" required maxlength="45" value="<?=set_value('jm-field-name');?>">
                            <span class="text-muted">Eg: Hospital, Pharmacy</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-field-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea rows="5" class="form-control" id="jm-field-description" name="jm-field-description" placeholder="Put your field description" required maxlength="200"><?=set_value('jm-field-description');?></textarea>
                            <span class="text-muted">Describe field content should be</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Field</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->