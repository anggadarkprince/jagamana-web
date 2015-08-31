<!-- HEADER -->
<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-7 hidden-xs">
                    <ul class="list-inline contact">
                        <li><a href="tel:+6285655479868"><i class="fa fa-phone-square mrsm"></i><?=get_setting("Contact")?></a></li>
                        <li><a href="mailto:support@jagamana.com"><i class="fa fa-envelope mrsm"></i><?=get_setting("Email")?></a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-5 col-xs-12">
                    <ul class="list-inline control">
                        <?php
                        if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE) || UserModel::is_authorize(UserModel::$TYPE_COMPANY))
                        {
                            ?>

                            <li><a href="<?=site_url()?>dashboard.html"><img src="<?=base_url()?>assets/img/avatar/<?=$this->session->userdata(UserModel::$SESSION_AVATAR)?>" class="header-avatar">Hi, <?=$this->session->userdata(UserModel::$SESSION_NAME)?></a></li>
                            <li><a href="<?=site_url()?>page/search.html"><i class="fa fa-search mrsm"></i>Search</a></li>

                        <?php
                        }
                        else{
                            ?>

                            <li><a href="<?=site_url()?>page/login.html"><i class="fa fa-sign-in mrsm"></i>Login</a></li>
                            <li><a href="<?=site_url()?>page/register.html"><i class="fa fa-male mrsm"></i>Register</a></li>

                        <?php
                        }
                        ?>

                        <li><a href="<?=site_url()?>page/help.html"><i class="fa fa-question-circle mrsm"></i>Help</a></li>
                    </ul>
                </div>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of top header -->

    <div class="main-header">
        <div class="container">
            <nav class="navbar" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#jm-navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <h1 class="logo"><a href="<?=site_url()?>" class="navbar-brand"><img src="<?=base_url()?>assets/img/layout/logo-jagamana.png" class="img-responsive"></a></h1>
                </div>
                <div class="collapse navbar-collapse" id="jm-navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        $menu_home = "";
                        $menu_company = "";
                        $menu_fulltime = "";
                        $menu_freelance = "";
                        $menu_voluntary = "";
                        $menu_intern = "";
                        $menu_course = "";
                        $menu_forum = "";

                        if(isset($menu))
                        {
                            switch($menu)
                            {
                                case "home":
                                    $menu_home = "class='active'";
                                    break;
                                case "company":
                                    $menu_company = "class='active'";
                                    break;
                                case "fulltime":
                                    $menu_fulltime = "class='active'";
                                    break;
                                case "freelance":
                                    $menu_freelance = "class='active'";
                                    break;
                                case "voluntary":
                                    $menu_voluntary = "class='active'";
                                    break;
                                case "intern":
                                    $menu_intern = "class='active'";
                                    break;
                                case "course":
                                    $menu_course = "class='active'";
                                    break;
                                case "forum":
                                    $menu_forum = "class='active'";
                                    break;
                            }
                        }

                        ?>
                        <li <?=$menu_home?>><a href="<?=site_url()?>">Home</a></li>
                        <li <?=$menu_company?>><a href="<?=site_url()?>company.html">Companies</a></li>
                        <li <?=$menu_freelance?>><a href="<?=site_url()?>job/freelance.html">Freelance</a></li>
                        <li <?=$menu_fulltime?>><a href="<?=site_url()?>job/fulltime.html">Fulltime</a></li>
                        <li <?=$menu_voluntary?>><a href="<?=site_url()?>job/voluntary.html">Voluntary</a></li>
                        <li <?=$menu_intern?>><a href="<?=site_url()?>job/intern.html">Intern</a></li>
                        <li <?=$menu_course?>><a href="<?=site_url()?>job/course.html">Courses</a></li>
                        <li <?=$menu_forum?>><a href="<?=site_url()?>forum.html">Forum</a></li>
                    </ul>
                </div>
            </nav>
        </div> <!-- end of container -->
    </div> <!-- end of main header -->
</header>