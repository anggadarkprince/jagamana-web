<!-- MODALS -->
<div class="modal login-oauth fade" id="login-oauth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock mrsm"></i>OAuth Login</h4>
            </div>
            <div class="modal-body">
                <p>OAuth just works for <span class="text-primary">Employee</span> type account, if you want to login as <span class="text-primary">Company</span> account,
                    just follow this link to <a href="<?=site_url()?>page/register.html" class="text-primary">Register</a></p>
                <div class="social-login">
                    <a href="<?=site_url()?>oauth/facebook_auth" data-toggle="modal" class="btn btn-facebook center-block">
                        <i class="fa fa-facebook mrsm"></i>
                        Login with Facebook
                    </a>
                    <a href="<?=site_url()?>oauth/twitter_auth" data-toggle="modal" class="btn btn-twitter center-block">
                        <i class="fa fa-twitter mrsm"></i>
                        Login with Twitter
                    </a>
                </div>
                <p class="text-center">Or just use
                    <span class="text-primary"><a href="<?=site_url()?>page/login.html"><i class="fa fa-lock mrsm mlsm"></i>JAGAMANA LOGIN</a></span>
                </p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger bold btn-block" data-dismiss="modal">Return</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->