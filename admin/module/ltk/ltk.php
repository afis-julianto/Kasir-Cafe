<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=ltk"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Laporan Transaksi Pembelian
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
                                    <h4 class="m-t-0 header-title"><b>Laporan Transaksi Pembelian</b></h4><br><br>
										<div class="row">
											<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11">
												<form method="post" action="" enctype="multipart/form-data">
													<div class="row">
														<div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3" >
															<label>Dari</label>
																<div>
																	<div class="input-group">
																		<input type="text" class="form-control" placeholder="mm/dd/yyyy" name="dari" id="mulai" required>
																		<span class="input-group-addon bg-custom b-0"><i class="icon-calender"></i></span>
																	</div><!-- input-group -->
																</div>
														</div>
														
														<div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
															<label>Sampai</label>
																<div>
																	<div class="input-group">
																		<input type="text" class="form-control" placeholder="mm/dd/yyyy" name="sampai" id="sampai" required>
																		<span class="input-group-addon bg-custom b-0"><i class="icon-calender"></i></span>
																	</div><!-- input-group -->
																</div>
														</div>
													
														<div class="form-group col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
															<label style="margin-top:40px;"></label>
															<button type="submit" name="btncari" class="btn btn-primary">Lihat</button>
														</div>
													</div>
												</form>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
												<?php
													if(isset($_POST['btncari'])){
														$dari	= $_POST['dari'];
														$sampai	= $_POST['sampai'];
												?>
												<form method="post"  action="adminpanel.php?page=ltk&pp=print&dari=<?php echo $dari;?>&sampai=<?php echo $sampai;?>" target="_blank">
													<label style="margin-top:40px;"></label>
													<button type="submit"  class="btn btn-success"><i class="fa fa-print"></i></button>
												</form>
											</div>
										</div>
									<br>
									
									<?php	
										try {
											$sql = "SELECT * FROM tbl_pembelian JOIN tbl_detail_pembelian 
													ON tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian
													WHERE tbl_pembelian.tgl_pembelian BETWEEN '$dari' AND '$sampai'";
											$stmt = $conn->prepare($sql); 
											$stmt->execute();
											$stmt->setFetchMode(PDO::FETCH_ASSOC);
											$row = $stmt->rowCount();
									?>
									<br><br>
									<p><b><center>Laporan Transaksi pembelian<br>Tanggal <?php echo tgl_indo($dari);?> - <?php echo tgl_indo($sampai);?></center></b></p>
									<br>
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
                                                <th><center>Nama Barang</center></th>
												<th><center>Harga</center></th>
												<th><center>Jumlah</center></th>
												<th><center>Total</center></th>
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
                                                <td><?php echo $r['nama_barang'];?></td>
												<td style="text-align:end"><?php echo rupiah($r['harga']);?></td>
												<td><center><?php echo $r['jumlah'];?></center></td>
												<td style="text-align:end"><?php echo rupiah($r['total']);?></td>
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
		$dari	= $_GET['dari'];
		$sampai	= $_GET['sampai'];
		$sql = "SELECT * FROM tbl_pembelian JOIN tbl_detail_pembelian 
				ON tbl_pembelian.id_pembelian=tbl_detail_pembelian.id_pembelian
				WHERE tbl_pembelian.tgl_pembelian BETWEEN '$dari' AND '$sampai'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b><center>Laporan Transaksi Pembelian<br>Tanggal <?php echo tgl_indo($dari);?> - <?php echo tgl_indo($sampai);?></center></b></h4><br>

                        			
                        			<table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th style="width:5%"><center>No</center></th>
                                                <th style="width:10%"><center>Nama Barang</center></th>
												<th style="width:10%"><center>Harga</center></th>
												<th style="width:10%"><center>Jumlah</center></th>
												<th style="width:10%"><center>Total</center></th>
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
                                                <td><?php echo $r['nama_barang'];?></td>
												<td style="text-align:end;"><?php echo rupiah($r['harga']);?></td>
												<td><center><?php echo $r['jumlah'];?></center></td>
												<td style="text-align:end;"><?php echo rupiah($r['total']);?></td>
                                            </tr>
											<?php												
													}
												}
											?>
											
											<?php
												$sql	= " SELECT MONTH(tgl_pembelian), 	SUM(tbl_pembelian.total_transaksi) as t_pembelian, 
															SUM(total_transaksi) as total 				
															FROM tbl_pembelian
															WHERE tbl_pembelian.tgl_pembelian BETWEEN '$dari' AND '$sampai'";
												$a	= $conn->prepare($sql); 
												$a->execute();
												$b = $a->Fetch(PDO::FETCH_ASSOC);
											?>
											<tr>
												<td colspan="4"><b>Total Transaksi Keluar</b></td> 
												<td colspan="1" style="text-align:end;"><b>Rp. <?php echo $b['total'];?> </b></td> 
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
	
