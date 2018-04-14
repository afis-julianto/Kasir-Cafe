<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=pendapatan"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Pendapatan
                                        </li>
                                        <li>
											<a href="adminpanel.php?page=home">Dashboard</a>
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->
						
<?php
$aksi = "module/pendapatan/pendapatanpro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT DISTINCT(MONTH(tgl_pembelian)) AS bulan, YEAR(tgl_pembelian) AS tahun
				FROM tbl_pembelian
				ORDER BY tahun DESC";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Pendapatan</b></h4>
                                    
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Keterangan</th>
                                                <th>Tools</th>
                                            </tr>
                                        </thead>
										
                                        <tbody>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$r){
														$no++;
											?>	
                                            <tr>										
                                                <td><center><?php echo $no;?></center></td>
                                                <td><?php echo ambilbulan($r['bulan']);?> <?php echo $r['tahun'];?></td>
												
												<?php
													$x	= $r['bulan'];
													$y	= $r['tahun'];
													$sql 				= " SELECT MONTH(tgl_pembelian), SUM(tbl_pembelian.total_transaksi) as t_pembelian FROM tbl_pembelian
																			WHERE MONTH(tgl_pembelian)='$x' AND YEAR(tgl_pembelian)='$y'";
													$a	= $conn->prepare($sql); 
													$a->execute();
													$b = $a->Fetch(PDO::FETCH_ASSOC);
												?>
											
												<?php
													
													$sql 				= " SELECT MONTH(tgl_penjualan), SUM(tbl_penjualan.pendapatan_bersih) as t_penjualan 
																			FROM tbl_penjualan 				
																			WHERE MONTH(tgl_penjualan)='$x' AND YEAR(tgl_penjualan)='$y'";
													$c	= $conn->prepare($sql); 
													$c->execute();
													$d = $c->Fetch(PDO::FETCH_ASSOC);
												?>
												
												<?php
													
													$sql 				= " SELECT MONTH(tgl_tagihan), SUM(tbl_tagihan.total_tagihan) as t_tagihan 
																			FROM tbl_tagihan 				
																			WHERE MONTH(tgl_tagihan)='$x' AND YEAR(tgl_tagihan)='$y'";
													$e	= $conn->prepare($sql); 
													$e->execute();
													$f = $e->Fetch(PDO::FETCH_ASSOC);
												?>
												
												<?php
													
													$sql 				= " SELECT MONTH(tgl_gaji), SUM(tbl_gaji.total_gaji) as t_gaji
																			FROM tbl_gaji				
																			WHERE MONTH(tgl_gaji)='$x' AND YEAR(tgl_gaji)='$y'";
													$g	= $conn->prepare($sql); 
													$g->execute();
													$h = $g->Fetch(PDO::FETCH_ASSOC);
												?>
                                                <td>
													<center>
													<?php 
														$pembelian	= $b['t_pembelian'];
														$penjualan 	= $d['t_penjualan'];
														$tagihan	= $f['t_tagihan'];
														$gaji		= $f['t_gaji'];
														$i 			= $pembelian + $tagihan + $gaji;
														
														if($i > $penjualan){
													?>
															<button class="btn waves-effect waves-light btn-danger btn-sm">Rugi</button>
													<?php
														}elseif($penjualan > $i){
													?>
															<button class="btn waves-effect waves-light btn-primary btn-sm">Untung</button>
													<?php
														}
													?>
													</center>
												</td>
                                                <td style="text-align:center">
												
													<button class="btn waves-effect waves-light btn-success"  onclick="window.location.href='?page=pendapatan&pp=view&bulan=<?php echo $r['bulan'];?>&tahun=<?php echo $r['tahun'];?>';"><i class="icon-eye"></i></button>
													
													
													<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=pendapatan&pp=print&bulan=<?php echo $r['bulan'];?>&tahun=<?php echo $r['tahun'];?>';"><i class="icon-printer"></i></button>
												</td>
                                            </tr>
											<?php												
													}
												}
												?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- end row -->

<?php
	} 
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
	
	case "view":
	try{
		$bulan 	= $_GET['bulan'];
		$tahun	= $_GET['tahun'];
		$sql = "SELECT MONTH(tgl_pembelian) AS bulan, YEAR(tgl_pembelian) AS tahun, sum(total_transaksi) AS jumlah_bulanan
				FROM tbl_pembelian
				WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$v = $stmt->fetch(PDO::FETCH_ASSOC);
		
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b><center>Lihat Detail Pendapatan<br>Bulan <?php echo ambilbulan($v['bulan']);?> TAHUN <?php echo $v['tahun'];?></center></b></h4><br>

                        			<div class="row" style="font-size:12px">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
											<!--Pemasukan-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_penjualan
																WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Penjualan</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th><center>Id Penjualan</center></th>
															<th><center>Tanggal</center></th>
															<th><center>Belanja</center></th>
															<th><center>Voucher</center></th>
															<th><center>Pajak</center></th>
															<th><center>Total Bersih</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_penjualan'];?></td>
															<td><center><?php echo tgl_indo($r['tgl_penjualan']);?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['total_transaksi']);?></td>
															<td><center><?php echo $r['voucher'];?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['pajak']);?></td>
															<td style="text-align:end"><?php echo rupiah( $r['pendapatan_bersih']);?></td>
														</tr>
														<?php												
																}
															}
														?>	
														<tr>
															<td colspan="6"><b>Total Penjualan</b></td> 
															<?php
																$sql 	= " SELECT 	SUM(total_transaksi) as total, 
																					SUM(voucher) as t_voucher, 
																					SUM(pajak) as t_pajak, 
																					SUM(pendapatan_bersih) as t_pendapatan_bersih  FROM tbl_penjualan
																			WHERE MONTH(tbl_penjualan.tgl_penjualan)='$bulan' AND YEAR(tbl_penjualan.tgl_penjualan)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
														<tr>
															<td colspan="6"><b>Voucher</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['t_voucher']);?> </b></td> 
														</tr>
														<tr>
															<td colspan="6"><b>Pajak</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['t_pajak']);?> </b></td> 
														</tr>
														<tr>
															<td colspan="6"><b>Pendapatan Bersih</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['t_pendapatan_bersih']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Pemasukan-->
											
											<br>
											
											<!--Pengeluaran-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_pembelian
																WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Pembelian</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th style="width:35%"><center>Id Pembelian</center></th>
															<th style="width:30%"><center>Tanggal Pembelian</center></th>
															<th style="width:30%"><center>Total</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_pembelian'];?></td>
															<td><center><?php echo tgl_indo($r['tgl_pembelian']);?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['total_transaksi']);?></td>
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="3"><b>Total Pembelian</b></td> 
															<?php
																$sql 	= " SELECT SUM(total_transaksi) as total FROM tbl_pembelian
																			WHERE MONTH(tbl_pembelian.tgl_pembelian)='$bulan' AND YEAR(tbl_pembelian.tgl_pembelian)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Pengeluaran-->
											
											<br>
											
											<!--Tagihan-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_tagihan
																WHERE MONTH(tgl_tagihan)='$bulan' AND YEAR(tgl_tagihan)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Tagihan</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th style="width:35%"><center>Id Tagihan</center></th>
															<th style="width:30%"><center>Tanggal Tagihan</center></th>
															<th style="width:30%"><center>Total</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_tagihan'];?></td>
															<td><center><?php echo tgl_indo($r['tgl_tagihan']);?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['total_tagihan']);?></td>
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="3"><b>Total Tagihan</b></td> 
															<?php
																$sql 	= " SELECT SUM(total_tagihan) as total FROM tbl_tagihan
																			WHERE MONTH(tgl_tagihan)='$bulan' AND YEAR(tgl_tagihan)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Tagihan-->
											
											<br>
											
											<!--Gaji-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_gaji JOIN tbl_karyawan
																ON tbl_gaji.id_karyawan=tbl_karyawan.id_karyawan
																WHERE MONTH(tbl_gaji.tgl_gaji)='$bulan' AND YEAR(tbl_gaji.tgl_gaji)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Gaji Karyawan</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th><center>Id Gaji</center></th>
															<th><center>Nama Karyawan</center></th>
															<th><center>Biaya Lembur</center></th>
															<th><center>Gaji Pokok</center></th>
															<th><center>Pinjam Uang</center></th>
															<th><center>Total Bersih</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_gaji'];?></td>
															<td><?php echo $r['nama_karyawan'];?></td>
															<td style="text-align:end"><?php echo rupiah($r['total_biaya_lembur']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['gaji_pokok']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['pinjam_uang']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['total_gaji']);?></td>
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="6"><b>Total Gaji Karyawan</b></td> 
															<?php
																$sql 	= " SELECT SUM(total_gaji) as total FROM tbl_gaji
																			WHERE MONTH(tgl_gaji)='$bulan' AND YEAR(tgl_gaji)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Gaji-->
											
											<br>
											
											<!--Laba Rugi-->
												<?php
													$x = $v['bulan'];
													$y = $v['tahun'];
													$sql 				= " SELECT MONTH(tgl_pembelian), 	SUM(total_transaksi) as t_pembelian, 
																											SUM(total_transaksi) as total 				
																			FROM tbl_pembelian
																			WHERE MONTH(tgl_pembelian)='$x' AND YEAR(tgl_pembelian)='$y'";
													$a	= $conn->prepare($sql); 
													$a->execute();
													$b = $a->Fetch(PDO::FETCH_ASSOC);
												?>
											
												<?php
													
													$sql 				= " SELECT MONTH(tgl_penjualan), 	SUM(pendapatan_bersih) as t_penjualan, 
																											SUM(pendapatan_bersih) as total 				
																			FROM tbl_penjualan 				
																			WHERE MONTH(tgl_penjualan)='$x' AND YEAR(tgl_penjualan)='$y'";
													$c	= $conn->prepare($sql); 
													$c->execute();
													$d = $c->Fetch(PDO::FETCH_ASSOC);
												?>
												
												<?php
													
													$sql 				= " SELECT MONTH(tgl_tagihan), 	SUM(total_tagihan) as t_tagihan, 
																										SUM(total_tagihan) as total 				
																			FROM tbl_tagihan 				
																			WHERE MONTH(tgl_tagihan)='$x' AND YEAR(tgl_tagihan)='$y'";
													$e	= $conn->prepare($sql); 
													$e->execute();
													$f = $e->Fetch(PDO::FETCH_ASSOC);
												?>
												
												<?php
													
													$sql 				= " SELECT MONTH(tgl_gaji), SUM(total_gaji) as t_gaji, 
																									SUM(total_gaji) as total 				
																			FROM tbl_gaji 				
																			WHERE MONTH(tgl_gaji)='$x' AND YEAR(tgl_gaji)='$y'";
													$g	= $conn->prepare($sql); 
													$g->execute();
													$h = $g->Fetch(PDO::FETCH_ASSOC);
												?>
												
												
												<b>Perhitungan Laba Dan Rugi</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th>Total Penjualan</th>
															<th style="text-align:end">Rp. <?php echo rupiah($d['total']);?></th>
														</tr>
														<tr>                                             
															<th>Total Pembelian</th>
															<th style="text-align:end">Rp. <?php echo rupiah($b['total']);?></th>
														</tr>
														<tr>                                             
															<th>Total Tagihan</th>
															<th style="text-align:end">Rp. <?php echo rupiah($f['total']);?></th>
														</tr>
														<tr>                                             
															<th>Total Gaji</th>
															<th style="text-align:end">Rp. <?php echo rupiah($h['total']);?></th>
														</tr>
														<tr>                                             
															<th>Hasil</th>
															<th style="text-align:end">
																Rp. <?php 
																	$pembelian 	= $b['t_pembelian'];
																	$penjualan 	= $d['t_penjualan'];
																	$tagihan 	= $f['t_tagihan'];
																	$gaji		= $h['t_gaji'];
																	$hasil 		= $penjualan - $pembelian - $tagihan - $gaji; 
																	
																	echo rupiah($hasil);
																?>
															</th>
														</tr>
														<tr>                                             
															<th>Keterangan</th>
															<th style="text-align:end">
																<?php 
																	$pembelian 	= $b['t_pembelian'];
																	$penjualan 	= $d['t_penjualan'];
																	$tagihan 	= $d['t_tagihan'];
																	$gaji		= $d['t_gaji'];
																	$i			= $pembelian + $tagihan + $gaji;
																	
																	if($i > $penjualan){
																?>
																		<button class="btn waves-effect waves-light btn-danger btn-sm">Rugi</button>
																<?php
																	}elseif($penjualan > $i){
																?>
																		<button class="btn waves-effect waves-light btn-primary btn-sm">Untung</button>
																<?php
																	}
																?>
															</th>
														</tr>
													</thead>
												</table>
											<!--/Laba Rugi-->
												
												
												
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->

<?php
} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
	
	case "print":
	try{
		$bulan 	= $_GET['bulan'];
		$tahun	= $_GET['tahun'];
		$sql = "SELECT MONTH(tgl_pembelian) AS bulan, YEAR(tgl_pembelian) AS tahun, sum(total_transaksi) AS jumlah_bulanan
				FROM tbl_pembelian
				WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$v = $stmt->fetch(PDO::FETCH_ASSOC);

?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b><center>Lihat Detail Pendapatan<br>Bulan <?php echo ambilbulan($v['bulan']);?> TAHUN <?php echo $v['tahun'];?></center></b></h4><br>

                        			<div class="row" style="font-size:12px">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
											<!--Pemasukan-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_penjualan
																WHERE MONTH(tgl_penjualan)='$bulan' AND YEAR(tgl_penjualan)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Penjualan</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th><center>Id Penjualan</center></th>
															<th><center>Tanggal</center></th>
															<th><center>Belanja</center></th>
															<th><center>Voucher</center></th>
															<th><center>Pajak</center></th>
															<th><center>Total Bersih</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_penjualan'];?></td>
															<td><center><?php echo tgl_indo($r['tgl_penjualan']);?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['total_transaksi']);?></td>
															<td><center><?php echo $r['voucher'];?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['pajak']);?></td>
															<td style="text-align:end"><?php echo rupiah( $r['pendapatan_bersih']);?></td>
														</tr>
														<?php												
																}
															}
														?>	
														<tr>
															<td colspan="6"><b>Total Penjualan</b></td> 
															<?php
																$sql 	= " SELECT 	SUM(total_transaksi) as total, 
																					SUM(voucher) as t_voucher, 
																					SUM(pajak) as t_pajak, 
																					SUM(pendapatan_bersih) as t_pendapatan_bersih  FROM tbl_penjualan
																			WHERE MONTH(tbl_penjualan.tgl_penjualan)='$bulan' AND YEAR(tbl_penjualan.tgl_penjualan)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
														<tr>
															<td colspan="6"><b>Voucher</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['t_voucher']);?> </b></td> 
														</tr>
														<tr>
															<td colspan="6"><b>Pajak</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['t_pajak']);?> </b></td> 
														</tr>
														<tr>
															<td colspan="6"><b>Pendapatan Bersih</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['t_pendapatan_bersih']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Pemasukan-->
											
											<br>
											
											<!--Pengeluaran-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_pembelian
																WHERE MONTH(tgl_pembelian)='$bulan' AND YEAR(tgl_pembelian)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Pembelian</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th style="width:35%"><center>Id Pembelian</center></th>
															<th style="width:30%"><center>Tanggal Pembelian</center></th>
															<th style="width:30%"><center>Total</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_pembelian'];?></td>
															<td><center><?php echo tgl_indo($r['tgl_pembelian']);?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['total_transaksi']);?></td>
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="3"><b>Total Pembelian</b></td> 
															<?php
																$sql 	= " SELECT SUM(total_transaksi) as total FROM tbl_pembelian
																			WHERE MONTH(tbl_pembelian.tgl_pembelian)='$bulan' AND YEAR(tbl_pembelian.tgl_pembelian)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Pengeluaran-->
											
											<br>
											
											<!--Tagihan-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_tagihan
																WHERE MONTH(tgl_tagihan)='$bulan' AND YEAR(tgl_tagihan)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Tagihan</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th style="width:35%"><center>Id Tagihan</center></th>
															<th style="width:30%"><center>Tanggal Tagihan</center></th>
															<th style="width:30%"><center>Total</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_tagihan'];?></td>
															<td><center><?php echo tgl_indo($r['tgl_tagihan']);?></center></td>
															<td style="text-align:end"><?php echo rupiah($r['total_tagihan']);?></td>
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="3"><b>Total Tagihan</b></td> 
															<?php
																$sql 	= " SELECT SUM(total_tagihan) as total FROM tbl_tagihan
																			WHERE MONTH(tgl_tagihan)='$bulan' AND YEAR(tgl_tagihan)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Tagihan-->
											
											<br>
											
											<!--Gaji-->
												<?php			
													try {
														$sql = "SELECT * FROM tbl_gaji JOIN tbl_karyawan
																ON tbl_gaji.id_karyawan=tbl_karyawan.id_karyawan
																WHERE MONTH(tbl_gaji.tgl_gaji)='$bulan' AND YEAR(tbl_gaji.tgl_gaji)='$tahun'";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
														$row = $stmt->rowCount();			
												?>
												<b>Gaji Karyawan</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th style="width:5%"><center>No</center></th>
															<th><center>Id Gaji</center></th>
															<th><center>Nama Karyawan</center></th>
															<th><center>Biaya Lembur</center></th>
															<th><center>Gaji Pokok</center></th>
															<th><center>Pinjam Uang</center></th>
															<th><center>Total Bersih</center></th>
														</tr>
													</thead>

													<tbody>
														<?php
															if($row>0) {
																$no=0;
																foreach($stmt->fetchAll() as $k=>$r){
																	$no++;
														?>	
														<tr>										
															<td><center><?php echo $no;?></center></td>
															<td><?php echo $r['id_gaji'];?></td>
															<td><?php echo $r['nama_karyawan'];?></td>
															<td style="text-align:end"><?php echo rupiah($r['total_biaya_lembur']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['gaji_pokok']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['pinjam_uang']);?></td>
															<td style="text-align:end"><?php echo rupiah($r['total_gaji']);?></td>
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="6"><b>Total Gaji Karyawan</b></td> 
															<?php
																$sql 	= " SELECT SUM(total_gaji) as total FROM tbl_gaji
																			WHERE MONTH(tgl_gaji)='$bulan' AND YEAR(tgl_gaji)='$tahun'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
											<!--/Gaji-->
											
											<br>
											
											<!--Laba Rugi-->
												<?php
													$x = $v['bulan'];
													$y = $v['tahun'];
													$sql 				= " SELECT MONTH(tgl_pembelian), 	SUM(total_transaksi) as t_pembelian, 
																											SUM(total_transaksi) as total 				
																			FROM tbl_pembelian
																			WHERE MONTH(tgl_pembelian)='$x' AND YEAR(tgl_pembelian)='$y'";
													$a	= $conn->prepare($sql); 
													$a->execute();
													$b = $a->Fetch(PDO::FETCH_ASSOC);
												?>
											
												<?php
													
													$sql 				= " SELECT MONTH(tgl_penjualan), 	SUM(pendapatan_bersih) as t_penjualan, 
																											SUM(pendapatan_bersih) as total 				
																			FROM tbl_penjualan 				
																			WHERE MONTH(tgl_penjualan)='$x' AND YEAR(tgl_penjualan)='$y'";
													$c	= $conn->prepare($sql); 
													$c->execute();
													$d = $c->Fetch(PDO::FETCH_ASSOC);
												?>
												
												<?php
													
													$sql 				= " SELECT MONTH(tgl_tagihan), 	SUM(total_tagihan) as t_tagihan, 
																										SUM(total_tagihan) as total 				
																			FROM tbl_tagihan 				
																			WHERE MONTH(tgl_tagihan)='$x' AND YEAR(tgl_tagihan)='$y'";
													$e	= $conn->prepare($sql); 
													$e->execute();
													$f = $e->Fetch(PDO::FETCH_ASSOC);
												?>
												
												<?php
													
													$sql 				= " SELECT MONTH(tgl_gaji), SUM(total_gaji) as t_gaji, 
																									SUM(total_gaji) as total 				
																			FROM tbl_gaji 				
																			WHERE MONTH(tgl_gaji)='$x' AND YEAR(tgl_gaji)='$y'";
													$g	= $conn->prepare($sql); 
													$g->execute();
													$h = $g->Fetch(PDO::FETCH_ASSOC);
												?>
												
												
												<b>Perhitungan Laba Dan Rugi</b>
												<hr>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th>Total Penjualan</th>
															<th style="text-align:end">Rp. <?php echo rupiah($d['total']);?></th>
														</tr>
														<tr>                                             
															<th>Total Pembelian</th>
															<th style="text-align:end">Rp. <?php echo rupiah($b['total']);?></th>
														</tr>
														<tr>                                             
															<th>Total Tagihan</th>
															<th style="text-align:end">Rp. <?php echo rupiah($f['total']);?></th>
														</tr>
														<tr>                                             
															<th>Total Gaji</th>
															<th style="text-align:end">Rp. <?php echo rupiah($h['total']);?></th>
														</tr>
														<tr>                                             
															<th>Hasil</th>
															<th style="text-align:end">
																Rp. <?php 
																	$pembelian 	= $b['t_pembelian'];
																	$penjualan 	= $d['t_penjualan'];
																	$tagihan 	= $f['t_tagihan'];
																	$gaji		= $h['t_gaji'];
																	$hasil 		= $penjualan - $pembelian - $tagihan - $gaji; 
																	
																	echo rupiah($hasil);
																?>
															</th>
														</tr>
														<tr>                                             
															<th>Keterangan</th>
															<th style="text-align:end">
																<?php 
																	$pembelian 	= $b['t_pembelian'];
																	$penjualan 	= $d['t_penjualan'];
																	$tagihan 	= $d['t_tagihan'];
																	$gaji		= $d['t_gaji'];
																	$i			= $pembelian + $tagihan + $gaji;
																	
																	if($i > $penjualan){
																?>
																		<button class="btn waves-effect waves-light btn-danger btn-sm">Rugi</button>
																<?php
																	}elseif($penjualan > $i){
																?>
																		<button class="btn waves-effect waves-light btn-primary btn-sm">Untung</button>
																<?php
																	}
																?>
															</th>
														</tr>
													</thead>
												</table>
											<!--/Laba Rugi-->
												
											<script type="text/javascript">
												window.print();
											</script>	
												
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->


																
<?php
} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
}
?>
