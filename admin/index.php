<?php
define("BASEPATH", dirname(__FILE__));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
        <title>Login</title>

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="assets/js/modernizr.min.js"></script>

    </head>
	<?php
		include "config/connection.php";
		include "config/library.php";
	?>

    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
		<?php
			$sql = "SELECT * FROM tbl_toko";
			$tit = $conn->prepare($sql); 
			$tit->execute();
			$titel = $tit->fetch(PDO::FETCH_ASSOC);
		?>
        	<div class="account-bg">
                <div class="card-box m-b-0">
                    <div class="text-xs-center m-t-20">
                        <a href="index.html" class="logo">
                            <i class="zmdi zmdi-group-work icon-cup"></i>
                            <span><?php echo $titel['nama_toko'];?></span>
                        </a>
                    </div>
                    <div class="m-t-30 m-b-20">
                        <div class="col-xs-12 text-xs-center">
                            <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                        </div>
                        <form class="form-horizontal m-t-20" action="proseslogin.php" method="post">

                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Masukkan Username" name="uname">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required="" placeholder="Masukkan Password" name="pword">
                                </div>
                            </div>


                            <div class="form-group text-center m-t-30">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" name="login" type="submit">Log In</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- end card-box-->

           
        </div>
        <!-- end wrapper page -->


        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>