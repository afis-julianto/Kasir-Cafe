<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=voucher"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Voucher Belanja
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
$aksi = "module/voucher/voucherpro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_voucher";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Voucher Belanja</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=vo&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
                                                <th><center>Nama Vouher</center></th>
                                                <th><center>Total</center></th>
                                                <th><center>status</center></th>
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
                                                <td style="width:5%"><center><?php echo $no;?></center></td>
                                                <td><?php echo $r['nama_voucher'];?></td>
                                                <td><?php echo $r['total'];?></td>
                                                <td><center>
												<?php
													$tgl_s	= 2018-06-31;
													$tgl_v	= 2018-05-31;
													if($tgl_s > $tgl_v){
												?>
													<button class="btn waves-effect waves-light btn-danger btn-sm">Non Aktif</button>
												<?php
													}
													elseif($tgl_s <= $tgl_v){
												
												?>
													<button class="btn waves-effect waves-light btn-info btn-sm">Aktif</button>
													
												<?php
													}
												?>
												</center></td>
                                                <td style="text-align:center; width:20%;">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=vo&pp=edit&id=<?php echo $r['id_voucher'];?>';"><i class="icon-note"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_voucher'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Voucher Belanja</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 
													$sql = $conn->prepare("SELECT max(id_voucher) as id FROM tbl_voucher");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 6);
													$noUrut++;
													$char = "VO-";
													$newID = $char . sprintf("%04s", $noUrut);
												?>
												
												<fieldset class="form-group">
                                                    <label>ID Vouher</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Voucher </label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Voucher" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Total </label>
                                                    <input type="number" class="form-control" name="total" placeholder="Masukkan Total Voucher" required>
                                                </fieldset>
												
												<fieldset class="form-group">
													<label>Masa Aktif </label>
                                                    <input type="text" class="form-control" placeholder="Minggu/Hari/Tahun" name="masa_aktif" id="mulai" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Kode Voucher </label>
                                                    <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Voucher" required>
                                                </fieldset>
												
                                                                               
                                                <button type="button" onclick="self.history.back()" class="btn btn-danger">Back</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->
						
<?php

	break;
	
	case "edit":
	try{
		$id = $_GET['id'];
		$sql = "SELECT * FROM tbl_voucher WHERE id_voucher='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>EditVoucher Belanja</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
											
												<fieldset class="form-group">
                                                    <label>ID Vouher</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $e['id_voucher']; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Voucher </label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Voucher" value="<?php echo $e['nama_voucher']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Total </label>
                                                    <input type="number" class="form-control" name="total" placeholder="Masukkan Total Voucher" value="<?php echo $e['total']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
													<label>Masa Aktif </label>
                                                    <input type="text" class="form-control" placeholder="Minggu/Hari/Tahun" name="masa_aktif" id="mulai" value="<?php echo $e['masa_aktif']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Kode Voucher </label>
                                                    <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Voucher" value="<?php echo $e['kode_voucher']; ?>" required>
                                                </fieldset>
												                
                                                <button type="button" onclick="self.history.back()" class="btn btn-danger">Back</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                        				</div><!-- end col -->
                        			</div><!-- end row -->
                        		</div>
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
	
