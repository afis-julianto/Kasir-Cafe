<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=ltk"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Laporan Gaji
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
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
?>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Laporan Gaji</b></h4><br><br>
										<div class="row">
											<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11">
												<form method="post" action="" enctype="multipart/form-data">
													<div class="row">
													<?php
														$sql = "SELECT DISTINCT(MONTH(tgl_gaji)) as bulan 
																FROM tbl_gaji 
																ORDER BY tgl_gaji ASC";
														$stmt = $conn->prepare($sql); 
														$stmt->execute();
														$stmt->setFetchMode(PDO::FETCH_ASSOC);
													?>
														<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
															<fieldset class="form-group">
																<select class="form-control" name="bulan" required>
																	<option>Pilih Bulan</option>
																	<?php
																		foreach($stmt->fetchAll() as $k=>$r){
																			echo "<option value=\"$r[bulan]\">$r[bulan]</option>";
																		}
																	?>
																</select>
															</fieldset>
														</div>
														
													<?php
														$sql = "SELECT DISTINCT(YEAR(tgl_gaji)) as tahun
																FROM tbl_gaji 
																ORDER BY tgl_gaji ASC";
														$stmtt = $conn->prepare($sql); 
														$stmtt->execute();
														$stmtt->setFetchMode(PDO::FETCH_ASSOC);
													?>
														<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
															<fieldset class="form-group">
																<select class="form-control" name="tahun" required>
																	<option>Pilih Tahun</option>
																	<?php
																		foreach($stmtt->fetchAll() as $k=>$r){
																			echo "<option value=\"$r[tahun]\">$r[tahun]</option>";
																		}
																	?>
																</select>
															</fieldset>
														</div>
													
														<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
															<button type="submit" name="btncari" class="btn btn-primary">Lihat</button>
														</div>
													</div>
												</form>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
												<?php
													if(isset($_POST['btncari'])){
														$bulan	= $_POST['bulan'];
														$tahun	= $_POST['tahun'];
												?>
												<form method="post"  action="adminpanel.php?page=lg&pp=print&bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>" target="_blank">
													<button type="submit"  class="btn btn-success"><i class="fa fa-print"></i></button>
												</form>
											</div>
										</div>
									<br>
									
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
									<br><br>
									<p><b><center>Laporan Gaji<br>Bulan <?php echo ambilbulan($bulan);?> Tahun <?php echo $tahun;?></center></b></p>
									<br>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
                                                <th><center>Nama Karyawan</center></th>
												<th><center>Gaji Pokok</center></th>
												<th><center>Jam Lembur</center></th>
												<th><center>Biaya Lembur</center></th>
												<th><center>Gaji Lembur</center></th>
												<th><center>Hutang</center></th>
												<th><center>Gaji Bersih</center></th>
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
                                                <td><?php echo $r['nama_karyawan'];?></td>
												<td style="text-align:end"><?php echo rupiah($r['gaji_pokok']);?></td>
												<td><center><?php echo $r['jam_lembur'];?></center></td>
												<td style="text-align:end"><?php echo rupiah($r['biaya_lembur']);?></td>
												<td style="text-align:end"><?php echo rupiah($r['total_biaya_lembur']);?></td>
												<td style="text-align:end"><?php echo rupiah($r['pinjam_uang']);?></td>
												<td style="text-align:end"><?php echo rupiah($r['total_gaji']);?></td>
                                            </tr>
											<?php												
													}
												}
												?>	
                                        </tbody>
                                    </table>
									<?php
									} 
										catch(PDOException $e) {
											echo "Error: " . $e->getMessage();
										}
										}
									?>
                                </div>
                            </div>
                        </div> <!-- end row -->

<?php
	
	break;
	
	case "print":
	
	try {
		$bulan	= $_GET['bulan'];
		$tahun	= $_GET['tahun'];
		$sql = "SELECT * FROM tbl_gaji JOIN tbl_karyawan
				ON tbl_gaji.id_karyawan=tbl_karyawan.id_karyawan
				WHERE MONTH(tbl_gaji.tgl_gaji)='$bulan' AND YEAR(tbl_gaji.tgl_gaji)='$tahun'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b><center>Laporan Gaji<br>Bulan <?php echo ambilbulan($bulan);?> Tahun <?php echo $tahun;?></center></b></h4><br>

                        			
                        			<table class="table table-striped table-bordered" style="font-size:11px">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
                                                <th><center>Nama Karyawan</center></th>
												<th><center>Gaji Pokok</center></th>
												<th><center>Jam Lembur</center></th>
												<th><center>Biaya Lembur</center></th>
												<th><center>Gaji Lembur</center></th>
												<th><center>Hutang</center></th>
												<th><center>Gaji Bersih</center></th>
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
                                                <td><?php echo $r['nama_karyawan'];?></td>
												<td style="text-align:end"><?php echo rupiah($r['gaji_pokok']);?></td>
												<td><center><?php echo $r['jam_lembur'];?></center></td>
												<td style="text-align:end"><?php echo rupiah($r['biaya_lembur']);?></td>
												<td style="text-align:end"><?php echo rupiah($r['total_biaya_lembur']);?></td>
												<td style="text-align:end"><?php echo rupiah($r['pinjam_uang']);?></td>
												<td style="text-align:end"><?php echo rupiah($r['total_gaji']);?></td>
                                            </tr>
											<?php												
													}
												}
											?>
											
											<?php
												$sql	= " SELECT MONTH(tgl_gaji) as bulan, YEAR(tgl_gaji) as tahun,
															SUM(total_gaji) as total 				
															FROM tbl_gaji
															WHERE MONTH(tbl_gaji.tgl_gaji)='$bulan' AND YEAR(tbl_gaji.tgl_gaji)='$tahun'";
												$a	= $conn->prepare($sql); 
												$a->execute();
												$b = $a->Fetch(PDO::FETCH_ASSOC);
											?>
											<tr>
												<td colspan="7"><b>Total Gaji Karyawan</b></td> 
												<td colspan="1" style="text-align:end;"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
											</tr>											
                                        </tbody>
                                    </table>
                        		</div>
								
								<script type="text/javascript">
									window.print();
								</script>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->

<?php
} 
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
}
?>
	
