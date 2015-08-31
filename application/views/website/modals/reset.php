<!-- MODALS -->
<div class="modal reset-password fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" action="<?=site_url()?>authentication/forgot" method="post" id="jm-form-forgot">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-envelope-o mrsm"></i>Reset Password</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jm-forgot-email">Email address</label>
                        <input type="email" class="form-control" id="jm-forgot-email" name="jm-forgot-email" placeholder="Enter your registered email" required>
                        <span class="text-muted">We will sent your password to your email account</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->