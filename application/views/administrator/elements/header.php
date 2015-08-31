<header class="header">
    <a href="#menu-toggle" class="toggle-nav" id="menu-toggle"><i class="fa fa-bars"></i></a>
    <div class="avatar">
        <div class="avatar-wrapper">
            <img src="<?=base_url()?>assets/img/avatar/<?=$this->session->userdata(UserModel::$SESSION_AVATAR)?>">
        </div>
        <div class="notify"><?=get_new_application()>99?99:get_new_application()?></div>
    </div>
    <p class="avatar-greeting pull-left">Hello, <strong><?=$this->session->userdata(UserModel::$SESSION_NAME)?></strong></p>
    <div class="control">
        <a href="<?=site_url()?>feedback" class="btn-circle"><i class="fa fa-comments"></i></a>
        <a href="<?=site_url()?>administrator/logout" class="btn-circle"><i class="fa fa-sign-out"></i></a>
    </div>
</header>