<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=tmasuk"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Transaksi Penjualan
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
$aksi = "module/tmasuk/tmasukpro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_penjualan ORDER BY id_penjualan DESC";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Transaksi Penjualan</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=tmasuk&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>


                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
												<th><center>ID Transaksi</center></th>
												<th><center>Nama Pelanggan</center></th>
                                                <th><center>Total Belanja</center></th>
                                                <th><center>Voucher</center></th>
                                                <th><center>Total Bayar</center></th>
												<th><center>Tanggal Transaksi</center></th>
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
                                                <td><center><?php echo $no;?></center></td>
												<td><?php echo $r['id_penjualan'];?></td>
												<td><?php echo $r['nama_pelanggan'];?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['total_transaksi']);?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['voucher']);?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['total_bayar']);?></td>
												 <td><?php echo tgl_indo($r['tgl_penjualan']);?></td>
												
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-success"  onclick="window.location.href='?page=tmasuk&pp=view&id=<?php echo $r['id_penjualan'];?>';"><i class="icon-eye"></i></button>
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=tmasuk&pp=print&id=<?php echo $r['id_penjualan'];?>';"><i class="icon-printer"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_penjualan'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data Transaksi Penjualan</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form>
												
												<?php 
													
													$sql = $conn->prepare("SELECT max(id_penjualan) as id FROM tbl_penjualan");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 3);
													$noUrut++;
													$char = "TK-";
													$newID = $char .  sprintf("%010s", $noUrut);
												?>

												
												<fieldset class="form-group">
												<div class="row pull-right">
													<div class="col-xs-12 col-md-4 col-lg-4 col-xl-4"></div>
													<div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
														<label>No Transaksi</label>
														<input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
													</div>
													<div class="col-xs-12 col-md-4 col-lg-4 col-xl-4">
														<label>Tanggal Transaksi</label>
														<input type="text" class="form-control" name="tanggal" value="<?php echo tgl_indo($tanggal); ?>" readonly>
													</div>
												</div>
                                                </fieldset>
											</form>
											
											<b>Transaksi Penjualan</b>
											<hr>
											
											
											<form method="post" action="<?php echo $aksi .'?act=simpan';?>" enctype="multipart/form-data">
												<input hidden type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
												<input hidden type="text" class="form-control" name="id_menu" id="id_menu" readonly>
											
												<fieldset class="form-group">
												<div class="row">
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
														<?php
															$sql = "SELECT * FROM tbl_kategori ORDER BY nama_kategori ASC";
															$stmt = $conn->prepare($sql); 
															$stmt->execute();
															$stmt->setFetchMode(PDO::FETCH_ASSOC);
														?>
														<label>Pilih Kategori</label>
														<select class="form-control" name="kategori" id="kategori" required>
                                                        <option>-- Pilih Kategori --</option>
															<?php
																foreach($stmt->fetchAll() as $k=>$r){
																	echo "<option value=\"$r[id_kategori]\">$r[nama_kategori]</option>";
																}
															?>
														</select>
													</div>
													
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
														<label>Pilih Menu</label>
														<select class="form-control js-example-basic-single" name="menu" id="menu" required>
															<option>-- Pilih Menu --</option>
														</select>
													</div>
													
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
														<label>Harga</label>
														<input type="text" onkeyup="hitung2();" class="a2 form-control" name="harga" id="harga"  readonly>
													</div>
													
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
														<label>Diskon %</label>
														<input type="text" onkeyup="hitung2();" class="b2 form-control" name="diskon" id="diskon" readonly>
													</div>
													
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
														<label>Jumlah</label>
														<input type="number" onkeyup="hitung2();" class="e2 form-control" name="jumlah" required>
													</div>
													
													<script>
														function hitung2() {
															var a = $(".a2").val();
															var b = $(".b2").val();
															c = eval(a) * eval(b) / 100; //cari diskon
															$(".c2").val(c);
															
															
															d = eval(a) - eval(c); // harga hasil diskon
															$(".d2").val(d);
															
															var e = $(".e2").val();
															f = eval(d) * eval(e); // harga setelah diskon
															$(".f2").val(f);
														}
													</script>
													
													<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
														<label>Total</label>
														<input type="text" onkeyup="hitung2();" class="f2 form-control" name="total" readonly>
													</div>
													
													<div class="col-xs-2 col-md-2 col-lg-2 col-xl-2" style="padding-top:5px">
														<br>
														<button type="submit" class="btn btn-primary">Tambah</button>
													</div>
												</div>
                                                </fieldset>                                        
                                            </form>
											
											<br>
											<b>Jumlah Pesanan</b>
											<hr>
											
												<?php			
												try {
													$sql = "SELECT * FROM tbl_detail_penjualan JOIN tbl_menu
															ON tbl_detail_penjualan.id_menu=tbl_menu.id_menu
															WHERE tbl_detail_penjualan.id_penjualan='$newID'";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
													$row = $stmt->rowCount();			
												?>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th><center>No</center></th>
															<th><center>Nama Menu</center></th>
															<th><center>Harga Satuan</center></th>
															<th><center>Diskon</center></th>
															<th><center>Jumlah Pesanan</center></th>
															<th><center>Total</center></th>
															<th><center>Aksi</center></th>
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
															<td><?php echo $r['nama_menu'];?></td>
															<td><?php echo rupiah($r['harga_menu']);?></td>
															<td><?php echo $r['diskon_menu'];?> %</td>
															<td><center><?php echo $r['jumlah'];?></center></td>
															<td><?php echo rupiah($r['total']);?></td>
															<td style="text-align:center">
															
															<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=hapus&id='. $r['id_detail_penjualan'];?>';"><i class="icon-trash"></i></button>
															</td>
															
														</tr>
														<?php												
																}
															}
															?>	
														<tr>
															<td colspan="5"><b>Total Harga Pemesanan</b></td> 
															<?php
																$sql	= " SELECT SUM(total) as total FROM tbl_detail_penjualan
																			WHERE id_penjualan='$newID'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="2"><b>Rp. <?php echo rupiah($b['total']);?> </b></td> 
														</tr>
													</tbody>
												</table>
												
												<?php
													} 
													catch(PDOException $e) {
														echo "Error: " . $e->getMessage();
													}
												?>
												
											<br>
											<b>Data Pelanggan</b>
											<hr>
											
										<form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
											<fieldset class="form-group">
											<div class="row">
												<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
													<label>Nama Pelanggan</label>
													<input type="text" class="form-control" name="nama_pelanggan" required>
												</div>
												
												<div class="col-xs-12 col-md-12 col-lg-12 col-xl-2">
													<label>No Meja</label>
													<input type="number" class="form-control" name="meja" required>
												</div>
											</div>
                                               </fieldset>
											<br>                                         
											
											<div class="row">
												<div class="col-xs-12 col-md-12 col-lg-6 col-xl-6">
													<b>Voucher Belanja</b>
													<hr>	
														<fieldset class="form-group">
														<div class="row">
															<div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
																<input hidden type="text" class="a3 form-control" value="<?php echo $b['total'];?>" readonly>
																<input type="text" class="b3 form-control" name="voucher" value="0">
															</div>
														</div>
														</fieldset>
												</div>
												
												<div class="col-xs-12 col-md-12 col-lg-6 col-xl-6">
													<b>Total Pembayaran</b>
													<hr>
														<fieldset class="form-group">
														<div class="row">
															<div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
																<input type="text" class="c3 form-control" name="total_pembayaran" readonly>
															</div>
														</div>
														</fieldset>
														<br>                                         
												</div>
											</div>
											
											<div class="row">
												<div class="col-xs-12 col-md-12 col-lg-6 col-xl-6">
													<b>Uang Pembayaran</b>
													<hr>
														<fieldset class="form-group">
														<div class="row">
															<div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
																<input type="text" class="d3 form-control" name="bayar" required>
															</div>
														</div>
														</fieldset>                                       
												</div>
												
												<div class="col-xs-12 col-md-12 col-lg-6 col-xl-6">
													<b>Uang Kembalian</b>
													<hr>	
														<fieldset class="form-group">
														<div class="row">
															<div class="col-xs-12 col-md-12 col-lg-12 col-xl-6">
																<input type="text" class="e3 form-control" name="kembali" readonly>
																<input hidden type="text" class="f3 form-control" name="pajak" readonly>
																<input hidden type="text" class="g3 form-control" name="pendapatan_bersih" readonly>
															</div>
														</div>
														</fieldset>
														<br>                                         
												</div>
											</div>
											
											<script>
												function hitung3() {
													var a = $(".a3").val();
													var b = $(".b3").val();
													
													c = eval(a)-eval(b);
													$(".c3").val(c);
													  
													var d = $(".d3").val();
													e = eval(d)-eval(c);
													$(".e3").val(e);
													
													f = eval(c)*10/100;
													$(".f3").val(f);
													
													g = eval(c)-eval(f);
													$(".g3").val(g);
												}
											</script>
												
												<button type="button" class="btn btn-info" onclick="hitung3()">Hitung</button>
												<input hidden type="text" class="form-control" name="id" value="<?php echo $newID; ?>" required>
												<input hidden type="text" class="form-control" name="tanggal" value="<?php echo $tgl_sekarang; ?>" required>
												<input hidden type="text" class="form-control" name="total" value="<?php echo $b['total'];?>" required>
												<button type="submit" class="btn btn-success pull-right">Proses Transaksi</button>                                   
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
		$sql = "SELECT * FROM tbl_penjualan JOIN tbl_detail_penjualan ON tbl_penjualan.id_penjualan=tbl_detail_penjualan.id_penjualan
				WHERE tbl_penjualan.id_penjualan='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$v = $stmt->fetch(PDO::FETCH_ASSOC);
		
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Lihat Detail Data Transaksi Penjualan</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form>
												
												<fieldset class="form-group">
												<div class="row pull-right">
													<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
														<label>No Transaksi</label>
														<input type="text" class="form-control" name="id" value="<?php echo $v['id_penjualan']; ?>" readonly>
													</div>
													<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-6">
														<label>Tanggal Transaksi</label>
														<input type="text" class="form-control" name="tanggal" value="<?php echo tgl_indo($v['tgl_penjualan']); ?>" readonly>
													</div>
												</div>
                                                </fieldset>
											</form>
											
												<?php
												try {
													$sql = "SELECT * FROM tbl_penjualan 
															JOIN tbl_detail_penjualan ON tbl_penjualan.id_penjualan=tbl_detail_penjualan.id_penjualan
															JOIN tbl_menu ON tbl_detail_penjualan.id_menu=tbl_menu.id_menu
															WHERE tbl_penjualan.id_penjualan='$id'";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
													$row = $stmt->rowCount();
												?>
												<table class="table table-striped table-bordered">
													<thead>
														<tr>                                             
															<th><center>No</center></th>
															<th><center>Nama Menu</center></th>
															<th><center>Harga</center></th>
															<th><center>Diskon %</center></th>
															<th><center>Jumlah Pesanan</center></th>
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
															<td><?php echo $r['nama_menu'];?></td>
															<td style="text-align:end">Rp. <?php echo rupiah($r['harga_menu']);?></td>
															<td><center><?php echo $r['diskon'];?></center></td>
															<td><center><?php echo rupiah($r['jumlah']);?></center></td>
															<td style="text-align:end">Rp. <?php echo rupiah($r['total']);?></td>
														</tr>
												<?php												
																}
															}
												} catch(PDOException $e) {
													echo "Error: " . $e->getMessage();
												}
												?>	
														<tr>
															<td colspan="4"><b>Total Harga Transaksi</b></td> 
															<?php
																$sql 				= " SELECT SUM(total) as total FROM tbl_detail_pembelian
																						WHERE id_pembelian='$newID'";
																$a	= $conn->prepare($sql); 
																$a->execute();
																$b = $a->Fetch(PDO::FETCH_ASSOC);
															?>
															<td colspan="2" style="text-align:end"><b>Rp. <?php echo $v['total_transaksi'];?> </b></td> 
														</tr>
													</tbody>
												</table>
												<br>
												<button type="button" onclick="self.history.back()" class="btn btn-danger">Kembali</button>
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
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_menu JOIN tbl_detail_penjualan
				ON tbl_menu.id_menu=tbl_detail_penjualan.id_menu
				JOIN tbl_penjualan
				ON tbl_detail_penjualan.id_penjualan=tbl_penjualan.id_penjualan
				WHERE tbl_penjualan.id_penjualan='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$p	= $stmt->Fetch(PDO::FETCH_ASSOC);

?>

	<style type="text/css">
		kertas{
			width		: 76mm; 
			margin		: none;	
		}
		
		tabel, th, td {
			width : 100%;
			border: 0px;
			padding-left: 0.75rem;
		}
	</style>

		<div class="row">
			<div class="col-lg-12">
				<div class="card-box kertas" style="font-size:12px">
					<?php
						$sql 	= "SELECT * FROM tbl_toko";
						$stmt 	= $conn->prepare($sql); 
						$stmt->execute();
						$t		= $stmt->Fetch(PDO::FETCH_ASSOC);
					?>
					<center><b><?php echo $t['nama_toko']; ?></b></center>
					<center><?php echo $t['alamat']; ?></center>
					<center>Telp : <?php echo $t['no_telp']; ?></center>
					<hr>
					Nomor &ensp;: <?php echo $p['id_penjualan']; ?><br>
					Tanggal : <?php echo tgl_indo($p['tgl_penjualan']); ?>
					<hr>
					<?php
						try {
							$sql = "SELECT * FROM tbl_menu JOIN tbl_detail_penjualan
									ON tbl_menu.id_menu=tbl_detail_penjualan.id_menu
									JOIN tbl_penjualan
									ON tbl_detail_penjualan.id_penjualan=tbl_penjualan.id_penjualan
									WHERE tbl_penjualan.id_penjualan='$id'";
							$stmt = $conn->prepare($sql); 
							$stmt->execute();
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
							$row = $stmt->rowCount();
					?>
					<table class="tabel">
					<?php
						if($row>0) {
						$no=0;
							foreach($stmt->fetchAll() as $k=>$r){
								$no++;
					?>
							<tr>
								<td colspan="5"><?php echo $r['nama_menu']; ?>
								(Dis : <?php echo $r['diskon']; ?>%)</td>
							</tr>
							<tr>
								<td style="width:10%"><?php echo $r['jumlah']; ?></td>
								<td style="width:5%">X</td>
								<td style="text-align:end; width:35%"><?php echo rupiah($r['harga_menu']); ?></td>
								<td style="width:15%"><center>=</center></td>
								<td style="text-align:end; width:35%;"><?php echo rupiah($r['total']); ?></td>
							</tr>
					<?php												
							}
						}
						} 
						catch(PDOException $e) {
							echo "Error: " . $e->getMessage();
						}
					?>	
					</table>
					<hr>
					
					<table>
						<tr>
							<td style="width:30%" >Total</td>
							<td style="width:5%"></td>
						 	<td style="text-align:end; width:18%"></td>
							<td style="width:5%">=</center></td>
							<td style="text-align:end; width:35%;"><?php echo rupiah($r['total_transaksi']); ?></td>
						</tr>
						
						<tr>
							<td style="width:30%" >Voucher</td>
							<td style="width:5%"></td>
						 	<td style="text-align:end; width:18%"></td>
							<td style="width:5%">=</center></td>
							<td style="text-align:end; width:35%;"><?php echo rupiah($r['voucher']); ?></td>
						</tr>
						
						<tr>
							<td style="width:30%" >Grand Total</td>
							<td style="width:5%"></td>
						 	<td style="text-align:end; width:18%"></td>
							<td style="width:5%">=</center></td>
							<td style="text-align:end; width:35%;"><?php echo rupiah($r['total_bayar']);?></td>
						</tr>
						
						<tr>
							<td style="width:30%" >Bayar</td>
							<td style="width:5%"></td>
						 	<td style="text-align:end; width:18%"></td>
							<td style="width:5%">=</center></td>
							<td style="text-align:end; width:35%;"><?php echo rupiah($r['uang_bayar']); ?></td>
						</tr>
						
						<tr>
							<td style="width:30%" >Kembali</td>
							<td style="width:5%"></td>
						 	<td style="text-align:end; width:18%"></td>
							<td style="width:5%">=</center></td>
							<td style="text-align:end; width:35%;"><?php echo rupiah($r['uang_kembali']); ?></td>
						</tr>
						
					</table>
					
					<hr>
					<center>-- Terima Kasih --</center>
					
				</div>
			</div>
		</div>
					
						<script type="text/javascript">
							window.print();
						</script>
<?php
} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

	break;	
}		
?>