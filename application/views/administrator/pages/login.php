<!DOCTYPE html>
<html>
    <head lang="en">
        <title><?=get_setting("Website Name")?><?=isset($page)?" | ".$page:""?></title>

        <!-- basic meta description -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?=get_setting("Description")?>">
        <meta name="author" content="Sketch Project Studio">
        <meta name="url" content="<?=site_url()?>">
        <meta name="keyword" content="<?=get_setting("Keyword")?>">

        <!-- social meta description -->
        <meta property="og:title" content="<?=get_setting("Website Name")." Administrator"?><?=isset($page)?" | ".$page:""?>">
        <meta property="og:type" content="CMS">
        <meta property="og:image" content="http://www.jagamana.com/assets/img/layout/featured-3col-doctorstand.png">
        <meta property="og:url" content="<?=site_url()?>">
        <meta property="og:keyword" content="<?=get_setting("Keyword")?>">
        <meta property="og:description" content="<?=get_setting("Description")?>">

        <!-- Bootstrap -->
        <link href="<?=base_url()?>assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- Loading Flat UI -->
        <link href="<?=base_url()?>assets/css/flatui/flat-ui.min.css" rel="stylesheet">

        <!-- FontAwesome -->
        <link href="<?=base_url()?>assets/css/fontawesome/font-awesome.min.css" rel="stylesheet">

        <!-- Stylesheet -->
        <link href="<?=base_url()?>assets/css/application/private.css" rel="stylesheet" media="screen">

        <!-- Favicon -->
        <link href="<?=base_url()?>assets/img/layout/favicon.png" rel="shortcut icon">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="login">
        <div class="login-screen">
            <div class="login-icon">
                <img src="<?=base_url()?>assets/img/layout/logo-jagamana.png">
            </div>

            <div class="login-form">
                <!-- alert -->
                <?php
                if($this->session->flashdata('jm-operation')!= NULL)
                {
                    ?>
                    <div class="alert alert-<?=$this->session->flashdata('jm-operation')?> alert-block alert-dismissible mtmd" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('jm-message'); ?>
                    </div>
                <?php
                }
                ?>
                <!-- end of alert -->

                <!-- alert -->
                <?php
                if(isset($operation))
                {
                    ?>
                    <div class="alert alert-<?=$operation?> alert-block alert-dismissible mtmd" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php
                }
                ?>
                <!-- end of alert -->
                <form action="<?=site_url()?>administrator/auth" method="post" id="jm-form-authentication" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control login-field" value="<?=set_value("jm-login-username")?>" placeholder="Enter your username" id="jm-login-username" name="jm-login-username" required maxlength="45">
                        <label class="login-field-icon fui-user" for="jm-login-username"></label>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control login-field" value="<?=set_value("jm-login-password")?>" placeholder="Password" id="jm-login-password" name="jm-login-password" required maxlength="32">
                        <label class="login-field-icon fui-lock" for="jm-login-password"></label>
                    </div>

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Log in</button>
                    <a class="login-link" href="#contact-administrator" data-toggle="modal">Lost your password?</a>
                </form>
            </div>
        </div>

        <?php $this->load->view("administrator/modals/developer"); ?>

        <!-- jQuery -->
        <script src="<?=base_url()?>assets/js/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?=base_url()?>assets/js/bootstrap/bootstrap.min.js"></script>

        <!-- Jvalidation -->
        <script src="<?=base_url()?>assets/js/jvalidation/jquery.validate.min.js"></script>

        <script>
            $("#jm-form-authentication").validate({
                errorClass:"text-warning"
            });
        </script>

    </body>
</html>