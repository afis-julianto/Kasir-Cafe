<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=gaji"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Gaji Karyawan
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
$aksi = "module/gaji/gajipro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_gaji ORDER BY id_gaji DESC";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Gaji Karyawan</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=gaji&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>


                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
                                                <th><center>Nama Karyawan</center></th>
                                                <th><center>Gaji Pokok</center></th>
                                                <th><center>Gaji Lembur</center></th>
                                                <th><center>Hutang</center></th>
												<th><center>Gaji Bersih</center></th>
                                                <th><center>Tanggal Gajian</center></th>
                                                <th><center>Tools</center></th>
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
                                                <td><?php echo $no;?></td>
												<?php
													$sql	= " SELECT * FROM tbl_karyawan 
																 WHERE id_karyawan='$r[id_karyawan]'";
													$a		= $conn->prepare($sql); 
													$a->execute();
													$b 		= $a->Fetch(PDO::FETCH_ASSOC);
												?>
                                                <td><?php echo $b['nama_karyawan'];?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['gaji_pokok']);?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['total_biaya_lembur']);?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['pinjam_uang']);?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['total_gaji']);?></td>
												<td><?php echo tgl_indo($r['tgl_gaji']);?></td>
												
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-success"  onclick="window.location.href='?page=gaji&pp=view&id=<?php echo $r['id_gaji'];?>';"><i class="icon-eye"></i></button>
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=gaji&pp=print&id=<?php echo $r['id_gaji'];?>';"><i class="icon-printer"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_gaji'];?>';"><i class="icon-trash"></i></button>
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
	
	case "add":
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data Gaji</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												<?php 
													
													$sql = $conn->prepare("SELECT max(id_gaji) as id FROM tbl_gaji");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 3);
													$noUrut++;
													$char = "G-";
													$newID = $char .  sprintf("%07s", $noUrut);
												?>

												<fieldset class="form-group">
												<div class="row">
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
														<label>ID Gaji Karyawan</label>
														<input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
													</div>
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
														<label>Tanggal Gaji</label>
														<input hidden type="text" class="form-control" name="tanggal" value="<?php echo $tgl_sekarang; ?>" required>
														<input type="text" class="form-control" value="<?php echo tgl_indo($tanggal); ?>" readonly>
													</div>
												</div>
                                                </fieldset>
											
												<fieldset class="form-group">
													<div class="row">
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<?php
																$sql = "SELECT * FROM tbl_karyawan
																		ORDER BY nama_karyawan ASC";
																$stmt = $conn->prepare($sql); 
																$stmt->execute();
																$stmt->setFetchMode(PDO::FETCH_ASSOC);
															?>
															<label>Pilih Karyawan</label>
															<select class="form-control" name="nama_karyawan" id="karyawan" required>
															<option>-- Pilih Karyawan --</option>
																<?php
																	foreach($stmt->fetchAll() as $k=>$r){
																		echo "<option value=\"$r[id_karyawan]\">$r[nama_karyawan]</option>";
																	}
																?>
															</select>
														</div>
														
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<label>Gaji Pokok</label>
															<input type="number" class="a2 form-control" name="gaji_pokok" id="gaji_pokok" readonly required>
														</div>
													</div>
                                                </fieldset>
												
												<fieldset class="form-group">
													<div class="row">						
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<label>Jumlah Jam Lembur</label>
															<input type="number" class="b2 form-control" name="jam_lembur" value="0" > 
														</div>
														
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<label>Biaya Lembur</label>
															<input type="number" class="c2 form-control" name="biaya_lembur" value="0" >
														</div>
														
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<label>Total Biaya Lembur</label>
															<input type="number" class="e2 form-control" name="total_lembur" value="0" readonly>
														</div>	
													</div>
                                                </fieldset>
												
												<fieldset class="form-group">
													<div class="row">						
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<label>Hutang Karyawan</label>
															<input type="number" class="d2 form-control" name="hutang" value="0" > 
														</div>
													</div><br>
													<button type="button" class="btn btn-info" onclick="hitung2()">Hitung</button>
                                                </fieldset>
												
												<b>Total Gaji Bersih</b>
												<hr>

												<script>
													function hitung2() {
													  var a = $(".a2").val();
													  var b = $(".b2").val();
													  var c = $(".c2").val();
													  var d = $(".d2").val();
													  e = eval(b)*eval(c);
													  f = eval(a)+eval(e)-eval(d);
													  $(".e2").val(e);
													  $(".f2").val(f);
													}
												</script>
												
												<fieldset class="form-group">
													<div class="row">		
														<div class="col-xs-12 col-md-12 col-lg-12 col-xl-3">
															<input type="number" class="f2 form-control" name="total_gaji" readonly >
														</div>
													</div>
                                                </fieldset>
												
												<button type="submit" class="btn btn-success">Proses Gaji</button>                                   
                                            </form>
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->
						
<?php
	break;
	
	case "view":
	try{
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_gaji JOIN tbl_karyawan
				ON tbl_gaji.id_karyawan=tbl_karyawan.id_karyawan
				WHERE tbl_gaji.id_gaji='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$v = $stmt->fetch(PDO::FETCH_ASSOC);
		
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Lihat Detail Gaji Karyawan</b></h4>
									<div class="row">
                        				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-xl-3"></div>
										<div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
															<tr>
																<td>ID Gaji</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['id_gaji'];?></td>
															</tr>
															<tr>
																<td>Nama Karyawan</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['nama_karyawan'];?></td>
															</tr>
															<tr>
																<td>Gaji Pokok</td>
																<td style="text-align:center;">:</td>
																<td><?php echo rupiah($v['gaji_pokok']);?></td>
															</tr>
															<tr>
																<td>Jam Lembur</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['jam_lembur'];?></td>
															</tr>
															<tr>
																<td>Biaya Lembur</td>
																<td style="text-align:center;">:</td>
																<td><?php echo rupiah($v['biaya_lembur']);?></td>
															</tr>
															<tr>
																<td>Total Biaya Lembur</td>
																<td style="text-align:center;">:</td>
																<td><?php echo rupiah($v['total_biaya_lembur']);?></td>
															</tr>
															<tr>
																<td>Pinjam Uang</td>
																<td style="text-align:center;">:</td>
																<td><?php echo rupiah($v['pinjam_uang']);?></td>
															</tr>	
															<tr>
																<td>Total Gaji</td>
																<td style="text-align:center;">:</td>
																<td><b><?php echo rupiah($v['total_gaji']);?></b></td>
															</tr>
															<tr>
																<td>Tanggal Gajian</td>
																<td style="text-align:center;">:</td>
																<td><?php echo tgl_indo($v['tgl_gaji']);?></td>
															</tr>															
													</table>
												</div>
                        				</div><!-- end col -->
										<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-xl-3"></div>
											
                        			</div><!-- end row -->
									
												<br>
												<button type="button" onclick="self.history.back()" class="btn btn-danger">Kembali</button>
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
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_gaji JOIN tbl_karyawan
				ON tbl_gaji.id_karyawan=tbl_karyawan.id_karyawan
				WHERE tbl_gaji.id_gaji='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$p = $stmt->fetch(PDO::FETCH_ASSOC);

?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">
									<?php
										$sql	= " SELECT * FROM tbl_toko";
										$a		= $conn->prepare($sql); 
										$a->execute();
										$b 		= $a->Fetch(PDO::FETCH_ASSOC);
									?>
									<div class="row">
										<div class="col-xl-1">
											<img src="uploads/img_toko/<?php echo $b['foto'];?>" style="width: 70px; height: 70px;">
										</div>
										<div class="col-xl-3">
											<b style="font-size:23px;"><?php echo $b['nama_toko']; ?></b><br>
											<span style="font-size:12px">Alamat &ensp;: <?php echo $b['alamat']; ?></span><br>
											<span style="font-size:12px">No Telp&ensp;: <?php echo $b['no_telp']; ?></span>
										</div>
									</div>
									<hr>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
											<p><b>No Gaji &emsp;&emsp;:</b> <?php echo $p['id_gaji'];?></p>
											<p><b>Nama&emsp;&emsp;&emsp;:</b> <?php echo $p['nama_karyawan'];?></p>
											<p><b>Tanggal&emsp;&emsp;:</b> <?php echo tgl_indo($p['tgl_gaji']);?></p>
											
											
												
												<table class="table m-t-30">
													<thead class="bg-faded">
														<tr>                                             
															<th>Nama</th>
															<th style="text-align:end">Jumlah</th>
															
														</tr>
													</thead>
													
													<tbody>
														<tr>										
															<td style="width:10%"><b>Gaji Pokok</b></td>
															<td style="width:10%; text-align:end"><b><?php echo rupiah($p['gaji_pokok']); ?></b></td>
														</tr>
														<tr>										
															<td>
																Jam Lembur <br>
																Biaya Lembur<br>
																<b>Total Pendapatan Lembur</b>
															</td>
															<td style="text-align:end">
																<?php echo $p['jam_lembur']; ?><br>
																<?php echo rupiah($p['biaya_lembur']); ?><br>
																<b><?php echo rupiah($p['total_biaya_lembur']); ?></b>
															</td>
														</tr>
														<tr>										
															<td><b>Peminjaman Uang</b></td>
															<td style="text-align:end"><b><?php echo rupiah($p['pinjam_uang']); ?></b></td>
														</tr>
											
														<tr>
															<td colspan="1"><b>Total Gaji</b></td> 
															<td colspan="1" style="text-align:end"><b>Rp. <?php echo rupiah($p['total_gaji']);?> </b></td> 
														</tr>
													</tbody>
												</table>

												<div class="pull-right"><br>
													TTD,<br><br><br><br>
													
													
													Pimpinan
												</div>
												
                        				</div><!-- end col -->
                        			</div><!-- end row -->
									
									
									
                        		</div>
                        	</div><!-- end col -->
                        </div>
						
						<script type="text/javascript">
							window.print();
						</script>
                        <!-- end row -->

<?php
} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

	break;
	
}	
?>