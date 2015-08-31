<!-- MODALS -->
<div class="modal fade" id="modal-resume-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" class="form-horizontal" action="<?=site_url()?>resume/update_profile" method="post" id="jm-form-profile">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user mrsm"></i>Personal Profile</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control wysiwyg height" id="jm-resume-about" name="jm-resume-about" placeholder="Tell about yourself" required maxlength="2000"><?=set_value('jm-resume-about', $employee["emp_about"]);?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->