<!-- MODALS -->
<div class="modal fade" id="modal-photo-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>photo/create" enctype="multipart/form-data" method="post" id="jm-form-photo">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-photo mrsm"></i>Photo Create</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-photo-title" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-photo-title" name="jm-photo-title" placeholder="Enter photo title" required maxlength="45" value="<?=set_value('jm-photo-title');?>">
                            <span class="text-muted">Eg: Last Week Holiday</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-photo-featured" class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-9">
                            <div class="select-image large empty">
                                <div class="image-wrapper">
                                    <img src="" class="img-responsive select-image-preview"/>
                                </div>
                                <input type="file" class="form-control select-image-file" id="jm-photo-resource" name="jm-photo-resource" required placeholder="Select featured image">
                            </div>
                            <span class="text-muted">Share your beautiful snap for company</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Photo</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->