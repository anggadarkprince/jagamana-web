<!-- Sidebar -->
<div id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="<?=site_url()?>">
            <img src="<?=base_url()?>assets/img/layout/logo-jagamana-administrator.png">
        </a>
    </div>
    <?php
        $menu_dashbaord = "";
        $menu_employee = "";
        $menu_company = "";
        $menu_job = "";
        $menu_application = "";
        $menu_thread = "";
        $menu_feedback = "";

        $menu_setting = "";
        $menu_help = "";
        $menu_about = "";

        if(isset($menu)) {
            switch ($menu) {
                case "dashboard":
                    $menu_dashbaord = "class='active'";
                    break;
                case "employee":
                    $menu_employee = "class='active'";
                    break;
                case "company":
                    $menu_company = "class='active'";
                    break;
                case "job":
                    $menu_job = "class='active'";
                    break;
                case "application":
                    $menu_application = "class='active'";
                    break;
                case "thread":
                    $menu_thread = "class='active'";
                    break;
                case "feedback":
                    $menu_feedback = "class='active'";
                    break;
                case "setting":
                    $menu_setting = "class='active'";
                    break;
                case "help":
                    $menu_help = "class='active'";
                    break;
                case "about":
                    $menu_about = "class='active'";
                    break;
            }
        }

        $new_company = "";
        $new_employee = "";
        $new_job = "";
        $new_application = "";

        $company_new_total = get_new_company();
        $employee_new_total = get_new_employee();
        $job_new_total = get_new_job();
        $application_new_total = get_new_application();

        if($this->session->userdata("jm_new_company") && $company_new_total > 0){
            $new_company = "new";
        }
        if($this->session->userdata("jm_new_employee") && $employee_new_total > 0){
            $new_employee = "new";
        }
        if($this->session->userdata("jm_new_job") && $job_new_total > 0){
            $new_job = "new";
        }
        if($this->session->userdata("jm_new_application") && $application_new_total > 0){
            $new_application = "new";
        }


    ?>
    <ul class="sidebar-nav">
        <li <?=$menu_dashbaord?>><a href="<?=site_url()?>dashboard.html"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li <?=$menu_employee?>><a href="<?=site_url()?>employee.html"><i class="fa fa-user-md"></i>Employees<span class="badge pull-right <?=$new_employee?>"><?=$employee_new_total?></span></a></li>
        <li <?=$menu_company?>><a href="<?=site_url()?>companies.html"><i class="fa fa-building"></i>Companies<span class="badge pull-right <?=$new_company?>"><?=$company_new_total?></span></a></li>
        <li <?=$menu_job?>><a href="<?=site_url()?>jobs.html"><i class="fa fa-briefcase"></i>Jobs<span class="badge pull-right <?=$new_job?>"><?=$job_new_total?></span></a></li>
        <li <?=$menu_application?>><a href="<?=site_url()?>applications.html"><i class="fa fa-file"></i>Applications<span class="badge pull-right <?=$new_application?>"><?=$application_new_total?></span></a></li>
        <li <?=$menu_thread?>><a href="<?=site_url()?>threads.html"><i class="fa fa-list"></i>Threads</a></li>
        <li <?=$menu_feedback?>><a href="<?=site_url()?>feedback.html"><i class="fa fa-comments"></i>Feedback</a></li>
    </ul>
    <div class="divider"></div>
    <ul class="sidebar-nav">
        <li <?=$menu_setting?>><a href="<?=site_url()?>setting.html"><i class="fa fa-gear"></i>Settings</a></li>
        <li <?=$menu_help?>><a href="<?=site_url()?>help.html"><i class="fa fa-question-circle"></i>Help</a></li>
        <li <?=$menu_about?>><a href="<?=site_url()?>about.html"><i class="fa fa-heart"></i>About</a></li>
    </ul>
</div>
<!-- /#sidebar-wrapper -->