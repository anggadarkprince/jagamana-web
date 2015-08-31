<!-- MODALS -->
<div class="modal fade" id="modal-task-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>task/update" enctype="multipart/form-data" method="post" id="jm-form-task-edit">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tasks mrsm"></i>Task Edit</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-task-title" class="col-sm-3 control-label">Task</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control task-title" id="jm-task-title" name="jm-task-title" placeholder="Enter company task title" required maxlength="45" value="<?=set_value('jm-task-title');?>">
                            <span class="text-muted">Eg: Saving People, Develop Drugs</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-task-institution" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control wysiwyg-mini task-description" id="jm-task-description" name="jm-task-description" placeholder="Explain company task description" required maxlength="500"><?=set_value('jm-task-description');?></textarea>
                            <span class="text-muted">Tell short description about the task</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-task-featured" class="col-sm-3 control-label">Featured</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control select-image-file" id="jm-task-featured" name="jm-task-featured" placeholder="Select featured image">
                            <span class="text-muted">Optional image for featured image</span>
                            <img src="" id="jm-task-image" class="img-responsive mtxs">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->