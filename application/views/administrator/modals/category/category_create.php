<!-- MODALS -->
<div class="modal fade" id="modal-category-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>category/create" method="post" id="jm-form-category">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="myModalLabel"><i class="fa fa-list-ul mrsm"></i>Category Create</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-category-name" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-category-name" name="jm-category-name" placeholder="Enter category name" required maxlength="45" value="<?=set_value('jm-category-name');?>">
                            <span class="text-muted">Eg: Cancer, Heart</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-category-description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea rows="5" class="form-control" id="jm-category-description" name="jm-category-description" placeholder="Put your category description" required maxlength="300"><?=set_value('jm-category-description');?></textarea>
                            <span class="text-muted">Describe category content should be</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->