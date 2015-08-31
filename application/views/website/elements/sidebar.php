<div class="sidebar sidebar-account">
    <header>
        <div class="avatar-wrapper <?=UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE)?"avatar-circle":""?>">
            <img src="<?=base_url()?>assets/img/avatar/<?=$this->session->userdata(UserModel::$SESSION_AVATAR)?>" class="account-avatar"/>
        </div>
        <h3 class="account-name"><?=$this->session->userdata(UserModel::$SESSION_NAME)?></h3>
        <p class="account-type">
            <?php
            if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
            {
                echo "Job Seeker";
            }
            if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
            {
                echo "Job Seeder";
            }
            ?>
        </p>
    </header>
    <nav>
        <ul class="list-unstyled">
            <?php
            $menu_dashbaord = "";
            $menu_bookmark = "";
            $menu_following = "";
            $menu_application = "";
            $menu_resume = "";
            $menu_thread = "";
            $menu_setting = "";
            $menu_notification = "";
            $menu_logout = "";

            $menu_profile = "";
            $menu_office = "";
            $menu_people = "";
            $menu_job = "";
            $menu_follower = "";
            $menu_applicant = "";


            if(isset($menu))
            {
                switch($menu)
                {
                    case "dashboard":
                        $menu_dashbaord = "class='active'";
                        break;
                    case "bookmark":
                        $menu_bookmark = "class='active'";
                        break;
                    case "following":
                        $menu_following = "class='active'";
                        break;
                    case "application":
                        $menu_application = "class='active'";
                        break;
                    case "resume":
                        $menu_resume = "class='active'";
                        break;
                    case "thread":
                        $menu_thread = "class='active'";
                        break;
                    case "setting":
                        $menu_setting = "class='active'";
                        break;
                    case "notification":
                        $menu_notification = "class='active'";
                        break;
                    case "profile":
                        $menu_profile = "class='active'";
                        break;
                    case "office":
                        $menu_office = "class='active'";
                        break;
                    case "people":
                        $menu_people = "class='active'";
                        break;
                    case "job":
                        $menu_job = "class='active'";
                        break;
                    case "follower":
                        $menu_follower = "class='active'";
                        break;
                    case "applicant":
                        $menu_applicant = "class='active'";
                        break;
                }
            }

            if(UserModel::is_authorize(UserModel::$TYPE_EMPLOYEE))
            {
                ?>

                <li <?=$menu_dashbaord?>><a href="<?=site_url()?>dashboard.html"><i class="fa fa-home"></i>Dashboard</a></li>
                <li <?=$menu_bookmark?>><a href="<?=site_url()?>bookmark.html"><i class="fa fa-suitcase"></i>Saved Job</a></li>
                <li <?=$menu_following?>><a href="<?=site_url()?>follower.html"><i class="fa fa-building"></i>Followed Companies</a></li>
                <li <?=$menu_application?>><a href="<?=site_url()?>applications.html"><i class="fa fa-file"></i>Sent Applications</a></li>
                <li <?=$menu_resume?>><a href="<?=site_url()?>resume.html"><i class="fa fa-pencil-square"></i>Resumes</a></li>
                <li <?=$menu_thread?>><a href="<?=site_url()?>thread.html"><i class="fa fa-tasks"></i>Threads</a></li>
                <li <?=$menu_setting?>><a href="<?=site_url()?>setting.html"><i class="fa fa-gear"></i>Settings</a></li>
                <li <?=$menu_notification?>><a href="<?=site_url()?>notification.html"><i class="fa fa-comments"></i>Notifications</a></li>
                <li><a href="<?=site_url()?>authentication/logout.html"><i class="fa fa-sign-out"></i>Logout</a></li>

                <?php
            }
            else if(UserModel::is_authorize(UserModel::$TYPE_COMPANY))
            {
                ?>

                <li <?=$menu_dashbaord?>><a href="<?=site_url()?>dashboard.html"><i class="fa fa-home"></i>Dashboard</a></li>
                <li <?=$menu_profile?>><a href="<?=site_url()?>profile.html"><i class="fa fa-suitcase"></i>Profile</a></li>
                <li <?=$menu_office?>><a href="<?=site_url()?>office.html"><i class="fa fa-building"></i>Office</a></li>
                <li <?=$menu_people?>><a href="<?=site_url()?>people.html"><i class="fa fa-users"></i>People</a></li>
                <li <?=$menu_job?>><a href="<?=site_url()?>job.html"><i class="fa fa-briefcase"></i>Jobs</a></li>
                <li <?=$menu_follower?>><a href="<?=site_url()?>follower.html"><i class="fa fa-mail-reply-all"></i>Followers</a></li>
                <li <?=$menu_applicant?>><a href="<?=site_url()?>applicant.html"><i class="fa fa-file-text"></i>Applicants</a></li>
                <li <?=$menu_setting?>><a href="<?=site_url()?>setting.html"><i class="fa fa-gear"></i>Settings</a></li>
                <li <?=$menu_notification?>><a href="<?=site_url()?>notification.html"><i class="fa fa-comments"></i>Notifications</a></li>
                <li><a href="<?=site_url()?>authentication/logout.html"><i class="fa fa-sign-out"></i>Logout</a></li>

                <?php
            }
            else
            {
                redirect(base_url());
            }

            ?>

        </ul>
    </nav>
</div>