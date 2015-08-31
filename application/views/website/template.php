<!doctype HTML>
<html lang="en">
<head>
    <title><?=get_setting("Website Name")?><?=isset($page)?" | ".$page:""?></title>

    <!-- basic meta description -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=get_setting("Description")?>">
    <meta name="author" content="Sketch Project Studio">
    <meta name="url" content="<?=site_url()?>">
    <meta name="keyword" content="<?=get_setting("Keyword")?>">

    <!-- social meta description -->
    <meta property="og:title" content="<?=get_setting("Website Name")?><?=isset($page)?" | ".$page:""?>">
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

    <!-- SummerNote -->
    <link href="<?=base_url()?>assets/css/summernote/summernote.css" rel="stylesheet">

    <!-- DatePicker -->
    <link href="<?=base_url()?>assets/css/datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="<?=base_url()?>assets/css/application/public.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="<?=base_url()?>assets/img/layout/<?=get_setting("Favicon")?>" rel="shortcut icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- JS -->
    <script src="<?=base_url()?>assets/js/jquery/jquery.min.js"></script>

    <!-- Highchart -->
    <script src="<?=base_url()?>assets/js/highchart/highcharts.js"></script>
    <script src="<?=base_url()?>assets/js/highchart/exporting.js"></script>

    <script>
        var website_url = "<?=site_url()?>";
    </script>

</head>
<body>

    <?php if(isset($content)){?>
        <?php $this->load->view("website/elements/header") ?>
        <?php $this->load->view($content) ?>
        <?php $this->load->view("website/elements/footer") ?>
    <?php }?>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=base_url()?>assets/js/flatui/vendor/video.js"></script>
    <script src="<?=base_url()?>assets/js/flatui/flat-ui.min.js"></script>

    <!-- Summernote -->
    <script src="<?=base_url()?>assets/js/summernote/summernote.min.js"></script>

    <!-- Jvalidation -->
    <script src="<?=base_url()?>assets/js/jvalidation/jquery.validate.min.js"></script>

    <!-- JTimeago -->
    <script src="<?=base_url()?>assets/js/jtimeago/jquery.timeago.js"></script>

    <!-- Datepicker -->
    <script src="<?=base_url()?>assets/js/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!-- ApplicationScript -->
    <script src="<?=base_url()?>assets/js/application/frontend.js"></script>

</body>

</html>