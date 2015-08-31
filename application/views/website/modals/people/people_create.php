<!-- MODALS -->
<div class="modal fade" id="modal-people-create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>people/create" method="post" enctype="multipart/form-data" id="jm-form-people">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user mrsm"></i>People</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-people-name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-people-name" name="jm-people-name" placeholder="Enter your employee name" required maxlength="50" value="<?=set_value('jm-people-name');?>">
                            <span class="text-muted">Eg: Angga Ari Wijaya</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-people-position" class="col-sm-3 control-label">Position</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jm-people-position" name="jm-people-position" placeholder="Enter your employee position" required maxlength="50" value="<?=set_value('jm-people-position');?>">
                            <span class="text-muted">Eg: Accounting Manager</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-people-about" class="col-sm-3 control-label">About</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="jm-people-about" name="jm-people-about" placeholder="Put your employee story" required maxlength="50"><?=set_value('jm-people-about');?></textarea>
                            <span class="text-muted">Short description about this person</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jm-people-avatar" class="col-sm-3 control-label">Avatar</label>
                        <div class="col-sm-9">
                            <div class="select-image small square empty">
                                <div class="image-wrapper">
                                    <img src="" class="img-responsive select-image-preview"/>
                                </div>
                                <input type="file" class="form-control select-image-file" id="jm-people-avatar" name="jm-people-avatar" placeholder="Select avatar image">
                            </div>
                            <span class="text-muted">For best view recommended 500px x 500px dimension</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add People and Continue</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->