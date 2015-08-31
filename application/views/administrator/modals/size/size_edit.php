<!-- MODALS -->
<div class="modal fade" id="modal-size-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>size/update" method="post" id="jm-form-size-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel"><i class="fa fa-list-ul mrsm"></i>Size Edit</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-size-name" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-size-name" name="jm-size-name" placeholder="Enter size name" required maxlength="45" value="<?=set_value('jm-size-name');?>">
                            <span class="text-muted">Eg: Large, Small</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-size-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea rows="5" class="form-control" id="jm-size-description" name="jm-size-description" placeholder="Put your size description" required maxlength="200"><?=set_value('jm-size-description');?></textarea>
                            <span class="text-muted">Describe size content should be</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Size</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->