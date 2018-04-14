<?php
defined("BASEPATH") or exit(header("location: adminpanel.php?page=home"));

$page = isset($_GET['page'])? filcar($_GET['page']):"home";

switch ($page){
	case "pekerjaan":
		if(file_exists("module/pekerjaan/pekerjaan.php"))
			include "module/pekerjaan/pekerjaan.php";
		else
			include "404.php";
		break;
	case "toko":
		if(file_exists("module/toko/toko.php"))
			include "module/toko/toko.php";
		else
			include "404.php";
		break;
	case "karyawan":
		if(file_exists("module/karyawan/karyawan.php"))
			include "module/karyawan/karyawan.php";
		else
			include "404.php";
		break;
	case "kategori":
		if(file_exists("module/kategori/kategori.php"))
			include "module/kategori/kategori.php";
		else
			include "404.php";
		break;
	case "vo":
		if(file_exists("module/voucher/voucher.php"))
			include "module/voucher/voucher.php";
		else
			include "404.php";
		break;
	case "menu":
		if(file_exists("module/menu/menu.php"))
			include "module/menu/menu.php";
		else
			include "404.php";
		break;
	case "ttagihan":
		if(file_exists("module/ttagihan/ttagihan.php"))
			include "module/ttagihan/ttagihan.php";
		else
			include "404.php";
		break;
	case "tkeluar":
		if(file_exists("module/tkeluar/tkeluar.php"))
			include "module/tkeluar/tkeluar.php";
		else
			include "404.php";
		break;
	case "tmasuk":
		if(file_exists("module/tmasuk/tmasuk.php"))
			include "module/tmasuk/tmasuk.php";
		else
			include "404.php";
		break;
	case "gaji":
		if(file_exists("module/gaji/gaji.php"))
			include "module/gaji/gaji.php";
		else
			include "404.php";
		break;
	case "pendapatan":
		if(file_exists("module/pendapatan/pendapatan.php"))
			include "module/pendapatan/pendapatan.php";
		else
			include "404.php";
		break;
	case "ltt":
		if(file_exists("module/ltt/ltt.php"))
			include "module/ltt/ltt.php";
		else
			include "404.php";
		break;
	case "ltk":
		if(file_exists("module/ltk/ltk.php"))
			include "module/ltk/ltk.php";
		else
			include "404.php";
		break;
	case "ltm":
		if(file_exists("module/ltm/ltm.php"))
			include "module/ltm/ltm.php";
		else
			include "404.php";
		break;
	case "lg":
		if(file_exists("module/lg/lg.php"))
			include "module/lg/lg.php";
		else
			include "404.php";
		break;
	case "galery":
		if(file_exists("module/galery/galery.php"))
			include "module/galery/galery.php";
		else
			include "404.php";
		break;
	case "slider":
		if(file_exists("module/slider/slider.php"))
			include "module/slider/slider.php";
		else
			include "404.php";
		break;
	case "partner":
		if(file_exists("module/partner/partner.php"))
			include "module/partner/partner.php";
		else
			include "404.php";
		break;
	case "ks":
		if(file_exists("module/ks/ks.php"))
			include "module/ks/ks.php";
		else
			include "404.php";
		break;
	case "berita":
		if(file_exists("module/berita/berita.php"))
			include "module/berita/berita.php";
		else
			include "404.php";
		break;
	case "user":
		if(file_exists("module/user/user.php"))
			include "module/user/user.php";
		else
			include "404.php";
		break;


	default:
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
                                        <li class="active">
                                            Dashboard
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
	
						<div class="row">
							<?php
							try{
								$sql 	= " SELECT SUM(pendapatan_bersih) as total 
											FROM tbl_penjualan 				
											WHERE tgl_penjualan=DATE(NOW())";
								$a		= $conn->prepare($sql); 
								$a->execute();
								$b 		= $a->Fetch(PDO::FETCH_ASSOC);
							?>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class=" icon-arrow-down-circle pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Pendapatan</h6>
                                    <h2 class="m-b-20">Rp. <?php echo rupiah($b['total']); ?></h2>
									</span> <span class="text-muted">/ Hari</span>
                                </div>
                            </div>
							
							<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							?>
							
							<?php
							try{
								$sql 	= " SELECT SUM(tbl_pembelian.total_transaksi) as total 
											FROM tbl_pembelian 				
											WHERE tgl_pembelian=DATE(NOW())";
								$c		= $conn->prepare($sql); 
								$c->execute();
								$d 		= $c->Fetch(PDO::FETCH_ASSOC);
							?>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-arrow-up-circle pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Pengeluaran</h6>
                                    <h2 class="m-b-20">Rp. <?php echo rupiah($d['total']); ?></h2>
									<span class="text-muted">/ Hari</span>
                                </div>
                            </div>
							<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							?>

                            <?php
							try{
								$sql 	= " SELECT SUM(tbl_detail_penjualan.jumlah) as total 
											FROM tbl_penjualan JOIN tbl_detail_penjualan
											ON tbl_penjualan.id_penjualan=tbl_detail_penjualan.id_penjualan
											WHERE tgl_penjualan=DATE(NOW())";
								$e		= $conn->prepare($sql); 
								$e->execute();
								$f 		= $e->Fetch(PDO::FETCH_ASSOC);
							?>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class="icon-basket pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Penjualan Barang</h6>
                                    <center><h2 class="m-b-20"><?php echo $f['total']; ?></h2></center>
									<span class="text-muted">Menu / Hari</span>
                                </div>
                            </div>
							<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							?>

                            <?php
							try{
								$sql 	= " SELECT COUNT(tbl_menu.id_menu) as total 
											FROM tbl_menu";
								$e		= $conn->prepare($sql); 
								$e->execute();
								$f 		= $e->Fetch(PDO::FETCH_ASSOC);
							?>
                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
                                <div class="card-box tilebox-one">
                                    <i class=" icon-book-open pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20"> Jumlah Menu</h6>
                                    <center><h2 class="m-b-20"><?php echo $f['total']; ?></h2></center>
									<span class="text-muted">Makanan Dan Minuman</span>
                                </div>
                            </div>
							<?php
							} 
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							?>
                        </div>
						
						<div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="card-box">
                                    
									
									
									<div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                            <h4 class="header-title m-t-0"><b>Statistik Penjualan Bulanan</b></h4><br>
		
												<?php
													$sql = "SELECT DISTINCT(YEAR(tgl_penjualan)) as tahun FROM tbl_penjualan ORDER BY tgl_penjualan ASC";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
												?>
												
												<form method="post" action="adminpanel.php" enctype="multipart/form-data" class="col-md-2">	
													<div class="row">
														<div class="form-group col-sm-2">
															<fieldset class="form-group">
																<select class="form-control" name="tahun" required>
																	<option>Pilih Tahun</option>
																	<?php
																		foreach($stmt->fetchAll() as $k=>$r){
																			echo "<option value=\"$r[tahun]\">$r[tahun]</option>";
																		}
																	?>
																</select>
															</fieldset>
														</div>
															
														<div class="form-group col-sm-2">
															<button type="submit" class="btn btn-primary">Lihat</button>
														</div>
													</div>
												</form>
												
											<div id="container" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
									
									<!--
									<div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                            <h4 class="header-title m-t-0"><b>Statistik Penjualan Harian</b></h4><br>
		
												
												<form method="post" action="adminpanel.php" enctype="multipart/form-data" class="col-md-2">	
													<div class="row">
														<div class="form-group col-sm-2">
															<fieldset class="form-group">
																<select class="form-control" name="b" required>
																	<option>Pilih Bulan</option>
																		<option value="1">Januari</option>
																		<option value="2">Februari</option>
																		<option value="3">Maret</option>
																		<option value="4">April</option>
																		<option value="5">Mei</option>
																		<option value="6">Juni</option>
																		<option value="7">Juli</option>
																		<option value="8">Agustus</option>
																		<option value="9">September</option>
																		<option value="10">Oktober</option>
																		<option value="11">November</option>
																		<option value="12">Desember</option>
																</select>
															</fieldset>
														</div>
													
												<?php
													$sql = "SELECT DISTINCT(YEAR(tgl_penjualan)) as tahun FROM tbl_penjualan ORDER BY tgl_penjualan ASC";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
												?>
												
														<div class="form-group col-sm-2">
															<fieldset class="form-group">
																<select class="form-control" name="t" required>
																	<option>Pilih Tahun</option>
																	<?php
																		foreach($stmt->fetchAll() as $k=>$r){
																			echo "<option value=\"$r[tahun]\">$r[tahun]</option>";
																		}
																	?>
																</select>
															</fieldset>
														</div>
															
														<div class="form-group col-sm-2">
															<button type="submit" class="btn btn-primary">Lihat</button>
														</div>
													</div>
												</form>
												
											<div id="harian" style="width:100%; height:400px;"></div>
                                        </div>
                                    </div>
									
									-->
									
	
                                    <!-- end row -->

                        		</div>
                            </div><!-- end col-->

                        </div>
                        <!-- end row -->

   
<!-- end row -->
<?php
}
?>