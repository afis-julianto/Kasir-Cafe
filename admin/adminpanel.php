<?php
session_start();
error_reporting(0);

include "timeout.php";

if($_SESSION[login]==1){
  if(!cek_login()){
    $_SESSION[login] = 0;
  }
}

if($_SESSION[login]==0){
  header('location:logout.php');
}

else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}

else{
define("BASEPATH", dirname(__FILE__));
  
?>

<!DOCTYPE html>
<html>
    <head>
	

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
		
		<?php
			include "config/connection.php";
			include "config/library.php";
		?>
        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<?php
			$sql = "SELECT * FROM tbl_toko";
			$tit = $conn->prepare($sql); 
			$tit->execute();
			$titel = $tit->fetch(PDO::FETCH_ASSOC);
		?>
        <!-- App title -->
        <title><?php echo $titel['nama_toko'];?></title>
		
		<!-- Plugins css -->
        <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
		<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		
		<!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
		
		

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="#" class="logo">
                        <i class="icon-cup"></i>
                        <span><?php echo $titel['nama_toko'];?></span></a>
                </div>

                <nav class="navbar navbar-custom"> 
					<ul class="nav navbar-nav">
                        <li class="nav-item">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="zmdi zmdi-menu"></i>
                            </button>
                        </li>
                    </ul>				

                    <ul class="nav navbar-nav pull-right">
                        <li class="nav-item dropdown notification-list">
						
							<?php
								$user = $_SESSION['id_user'];
								
								$sql = "SELECT * FROM tbl_users
										WHERE id_user='$user' ";
								$a = $conn->prepare($sql); 
								$a->execute();
								$b = $a->fetch(PDO::FETCH_ASSOC);
							?>
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="uploads/img_user/<?php echo $b['foto']; ?>" alt="user" class="img-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
						
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small><?php echo $_SESSION['namalengkap']; ?></small> </h5>
                                </div>

                                <!-- item-->
                                <a href="index.php" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>
                    </ul>
                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                <?php 
					
					
					if(file_exists("menu.php"))
						include "menu.php"; 
					
				?>
                  
                </div>

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
   
                        <?php 
							if(file_exists("content.php"))
								include "content.php"; 
						?>

                    </div> <!-- container -->
                </div> <!-- content -->
            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <div class="nicescroll">
                    <ul class="nav nav-tabs text-xs-center">
                        <li class="nav-item">
                            <a href="#home-2"  class="nav-link active" data-toggle="tab" aria-expanded="false">
                                Activity
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">
                                Settings
                            </a>
                        </li>
                    </ul>

                    
            </div>
            <!-- /Right-bar -->

            <?php
				if(file_exists("footer.php"))
					include "footer.php"; 
			?>


        </div>
        <!-- END wrapper -->


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
		
		<link href="assets/css/select2.min.css" rel="stylesheet" />
		<script src="assets/js/select2.min.js"></script>
		
		<script>
			$(document).ready(function() {
				$('.js-example-basic-single').select2();
			});
		</script>
		
		<script src="assets/plugins/chart.js/chart.min.js"></script>

		<!-- Date Pickers js -->
		<script src="assets/plugins/moment/moment.js"></script>
     	<script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
     	<script src="assets/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
     	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
     	<script src="assets/plugins/clockpicker/bootstrap-clockpicker.js"></script>
     	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="assets/pages/jquery.form-pickers.init.js"></script>
		
        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>
		<!--script src="statistik-penjualan.js"></script-->

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
		
		<!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
		
		<!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
		
		<!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>
		<script src="assets/js/highcharts.js"></script>
		

		
		<!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
		
		<!--GAJI-->
		<script>
			$(function() {
						
				$("#karyawan").change(function(){
					var nama_karyawan = $("#karyawan option:selected").val();
					$.ajax({
						url: 'module/gaji/getkaryawan.php',
						type: 'POST',
						dataType: 'json',
					
						data: {
							'id_karyawan': nama_karyawan
						},
						success: function (lem) {
							$("#nama_karyawan").val(lem['nama_karyawan']);
							$("#gaji_pokok").val(lem['gaji_pokok']);
							$("#id_lembur").val(lem['id_lembur']);
							
						}
					});
				});
			});
		</script>
		<!--/GAJI-->
		
		<!--Transaksi Penjualan-->
		<script>
			$(function() {
				$("#kategori").change(function(){
					var id_kategori = $(this).val();  
					  $.ajax({
						type: "POST",
						dataType: "html",
						url: "module/tmasuk/getkategori.php",
						data: "id_kategori="+id_kategori,
						success: function(msg){
							if(msg == ''){
								$("select#menu").html('<option value="">-- Pilih Menu --</option>');							 
							}
							else{
								$("select#menu").html(msg);  					   
							}
							getAjaxMenu();	
						}
					});                    
				});
						
				$("#menu").change(getAjaxMenu);
					function getAjaxMenu(){
						var nama_menu = $("#menu option:selected").val();
						$.ajax({
							url: 'module/tmasuk/getmenu.php',
							type: 'POST',
							dataType: 'json',
							data: {
								'id_menu': nama_menu
							},
							success: function (makan) {
								$("#id_menu").val(makan['id_menu']);
								$("#nama_menu").val(makan['nama_menu']);
								$("#harga").val(makan['harga_menu']);
								$("#diskon").val(makan['diskon_menu']);
							}
						});
					}
			});
		</script>
		<!--/Transaksi Penjualan-->
	
		<script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>
		
		<!--Statitik Tahun-->
		<script type="text/javascript">
		  $(document).ready(function() {
			Highcharts.chart('container', {
				chart: {
					type: 'line'
				},
				title: {
						<?php
							$tahun = isset($_POST['tahun'])?$_POST['tahun']:"";
							
							try {
								$sql = "SELECT DISTINCT(MONTH(tgl_pembelian)) AS bulan, YEAR(tgl_pembelian) AS tahun
										FROM tbl_pembelian
										WHERE YEAR(tgl_pembelian)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$r = $stmt->fetch(PDO::FETCH_ASSOC);
								
						?>	
					text: 'Total Transaksi Masuk dan Keluar Tahun <?php echo $r['tahun'];?>'
						<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>	
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: [ 
						<?php
							$tahun = isset($_POST['tahun'])?$_POST['tahun']:"";
							
							try {
								$sql = "SELECT DISTINCT(MONTH(tgl_pembelian)) AS bulan, YEAR(tgl_pembelian) AS tahun
										FROM tbl_pembelian
										WHERE YEAR(tgl_pembelian)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								$row = $stmt->rowCount();
						?>				
					
							<?php
								if($row>0) {
									$no=0;
									foreach($stmt->fetchAll() as $k=>$r){
										$no++;
							?>	
								
										'<?php echo ambilbulan($r['bulan']);?>',
								<?php												
									}
								}
							?>	
						<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>					
						
								]
				},
				yAxis: {
					title: {
						text: 'Jumlah (Rp)'
					}
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				series: [{
					name: 'Transaksi Pembelian',
					data: [	
					
						<?php
							$tahun = isset($_POST['tahun'])?$_POST['tahun']:"";
							
							try {
								$sql = "SELECT DISTINCT(MONTH(tgl_pembelian)) AS bulan, YEAR(tgl_pembelian) AS tahun
										FROM tbl_pembelian
										WHERE YEAR(tgl_pembelian)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								$row = $stmt->rowCount();
						?>				
					
							<?php
								if($row>0) {
									$no=0;
									foreach($stmt->fetchAll() as $k=>$r){
										$no++;
							?>	
								<?php
									$xa 	= $r['bulan'];
									$ya 	= $r['tahun'];
									$sql 	= " SELECT MONTH(tgl_pembelian), 	SUM(tbl_pembelian.total_transaksi) as t_pembelian, 
																				SUM(total_transaksi) as total 				
												FROM tbl_pembelian
												WHERE MONTH(tgl_pembelian)='$xa' AND YEAR(tgl_pembelian)='$ya'";
									$a		= $conn->prepare($sql); 
									$a->execute();
									$b 		= $a->Fetch(PDO::FETCH_ASSOC);
								?>
								
										<?php echo $b['total'];?>,
								<?php												
									}
								}
							?>	
						<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>
					
						  ]
				}, {
					name: 'Transaksi Penjualan',
					data: [	
					
						<?php
							$tahun = isset($_POST['tahun'])?$_POST['tahun']:"";
							
							try {
								$sql = "SELECT DISTINCT(MONTH(tgl_penjualan)) AS bulan, YEAR(tgl_penjualan) AS tahun
										FROM tbl_penjualan
										WHERE YEAR(tgl_penjualan)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								$row = $stmt->rowCount();
						?>				
					
							<?php
								if($row>0) {
									$no=0;
									foreach($stmt->fetchAll() as $k=>$r){
										$no++;
							?>	
								<?php
									$xa 	= $r['bulan'];
									$ya 	= $r['tahun'];
									$sql 	= " SELECT MONTH(tgl_penjualan), 	SUM(tbl_penjualan.total_transaksi) as t_penjualan, 
																				SUM(total_transaksi) as total 				
												FROM tbl_penjualan 				
												WHERE MONTH(tgl_penjualan)='$xa' AND YEAR(tgl_penjualan)='$ya'";
									$c	= $conn->prepare($sql); 
									$c->execute();
									$d = $c->Fetch(PDO::FETCH_ASSOC);
								?>	
								
									<?php echo $d['total'];?>,
										
								<?php												
									}
								}
							?>	
						<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>							
						  ]
				}]
			});
		  } );
		</script>
		<!--/Statitik Tahun-->
		
		<!--Statitik Bulan-->
		<script type="text/javascript">
		  $(document).ready(function() {
			Highcharts.chart('harian', {
				chart: {
					type: 'line'
				},
				title: {
					<?php
							$bulan = isset($_POST['b'])?$_POST['b']:"";
							$tahun = isset($_POST['t'])?$_POST['t']:"";
							
							try {
								$sql = "SELECT DISTINCT(MONTH(tgl_pembelian)) AS bulan, YEAR(tgl_pembelian) AS tahun
										FROM tbl_pembelian
										WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$r = $stmt->fetch(PDO::FETCH_ASSOC);
								
						?>	
					text: 'Total Transaksi Masuk dan Keluar Bulan <?php echo $r['bulan'];?> Tahun <?php echo $r['tahun'];?>'
					
					<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>	
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories: [ 1, 2, 3,4, 5, 6, 7, 8, 9, 10,11 ,12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31 ]
				},
				yAxis: {
					title: {
						text: 'Jumlah (Rp)'
					}
				},
				plotOptions: {
					line: {
						dataLabels: {
							enabled: true
						},
						enableMouseTracking: false
					}
				},
				series: [{
					name: 'Transaksi Pembelian',
					data: [
					
						<?php
							$bulan = isset($_POST['b'])?$_POST['b']:"";
							$tahun = isset($_POST['t'])?$_POST['t']:"";
							
							try {
								$sql = "SELECT DISTINCT(DAY(tgl_pembelian)) as hari, MONTH(tgl_pembelian) AS bulan, YEAR(tgl_pembelian) AS tahun
										FROM tbl_pembelian
										WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								$row = $stmt->rowCount();
						?>				
					
							<?php
								if($row>0) {
									$no=0;
									foreach($stmt->fetchAll() as $k=>$r){
										$no++;
							?>	
								<?php
									$za 	= $r['hari'];
									$xa 	= $r['bulan'];
									$ya 	= $r['tahun'];
									$sql 	= " SELECT MONTH(tgl_pembelian), 	SUM(tbl_pembelian.total_transaksi) as t_pembelian, 
																				SUM(total_transaksi) as total 				
												FROM tbl_pembelian
												WHERE DAY(tgl_pembelian)='$za' AND MONTH(tgl_pembelian)='$xa' AND YEAR(tgl_pembelian)='$ya'";
									$a		= $conn->prepare($sql); 
									$a->execute();
									$b 		= $a->Fetch(PDO::FETCH_ASSOC);
								?>
								
										<?php echo $b['total'];?>,
								<?php												
									}
								}
							?>	
						<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>
					
					
					]
				}, {
					name: 'Transaksi Penjualan',
					data: [ 
					
					<?php
							$bulan = isset($_POST['b'])?$_POST['b']:"";
							$tahun = isset($_POST['t'])?$_POST['t']:"";
							
							try {
								$sql = "SELECT DISTINCT(DAY(tgl_penjualan)) AS hari, MONTH(tgl_penjualan) AS bulan, YEAR(tgl_penjualan) AS tahun
										FROM tbl_penjualan
										WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun'";
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								$row = $stmt->rowCount();
						?>				
					
							<?php
								if($row>0) {
									$no=0;
									foreach($stmt->fetchAll() as $k=>$r){
										$no++;
							?>	
								<?php
									$za 	= $r['hari'];
									$xa 	= $r['bulan'];
									$ya 	= $r['tahun'];
									$sql 	= " SELECT MONTH(tgl_penjualan), 	SUM(tbl_penjualan.total_transaksi) as t_penjualan, 
																				SUM(total_transaksi) as total 				
												FROM tbl_penjualan 				
												WHERE DAY(tgl_penjualan)='$za' AND MONTH(tgl_penjualan)='$xa' AND YEAR(tgl_penjualan)='$ya'";
									$c	= $conn->prepare($sql); 
									$c->execute();
									$d = $c->Fetch(PDO::FETCH_ASSOC);
								?>	
								
									<?php echo $d['total'];?>,
										
								<?php												
									}
								}
							?>	
						<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}	
						?>
					
					]
				}]
			});
		  } );
		</script>
		<!--/Statitik Bulan-->
		
		<script>
            var resizefunc = [];
        </script>


    </body>
</html>

<?php
$conn=null;
}
}
?>