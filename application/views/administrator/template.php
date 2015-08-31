<!DOCTYPE html>
<html>
<head lang="en">
    <title><?=get_setting("Website Name")." Administrator"?><?=isset($page)?" | ".$page:""?></title>

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

    <!-- DataTables CSS -->
    <link href="<?=base_url()?>assets/js/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?=base_url()?>assets/js/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


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

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery/jquery.min.js"></script>

    <!-- Highchart -->
    <script src="<?=base_url()?>assets/js/highchart/highcharts.js"></script>
    <script src="<?=base_url()?>assets/js/highchart/exporting.js"></script>

</head>
<body>
    <div id="wrapper">

        <?php $this->load->view("administrator/elements/sidebar") ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <?php if(isset($content)){?>

            <?php $this->load->view("administrator/elements/header") ?>

            <?php $this->load->view($content) ?>

            <?php $this->load->view("administrator/elements/footer") ?>

            <?php }?>

        </div>

        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>assets/js/bootstrap/bootstrap.min.js"></script>

    <!-- Summernote -->
    <script src="<?=base_url()?>assets/js/summernote/summernote.min.js"></script>

    <!-- DataTables -->
    <script src="<?=base_url()?>assets/js/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/js/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Jvalidation -->
    <script src="<?=base_url()?>assets/js/jvalidation/jquery.validate.min.js"></script>

    <!-- ApplicationScript -->
    <script src="<?=base_url()?>assets/js/application/backend.js"></script>

</body>
</html>