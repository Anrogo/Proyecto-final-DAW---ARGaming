<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Page Title -->
    <title>
        <?php
        echo $title_for_layout;
        ?>
    </title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/v4-shims.css">

    <!-- Bootstrap Core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/estilos.css" rel="stylesheet">
    <link href="/css/fondos.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="registro">

    <!-- Navigation -->
    <?php //require_once dirname( dirname( dirname(__FILE__))) . "/views/includes/header.php"; 
    ?>

    <!-- Page Content -->
    <?php
    echo $content_for_layout;
    ?>

    <!-- Footer -->
    <?php //require_once dirname( dirname( dirname(__FILE__))) . "/views/includes/footer.php"; 
    ?>

    <!-- jQuery Version 3.4.1 -->
    <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>

    <!-- Popper JS 1.16.0 -->
    <script src="/bootstrap/js/popper.min.js" defer></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/bootstrap/js/bootstrap.min.js" defer></script>

</body>

</html>