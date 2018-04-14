<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=karyawan"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Karyawan
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
$aksi = "module/karyawan/karyawanpro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_karyawan";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Karyawan</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=karyawan&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No<center></th>
                                                <th><center>Nama Karyawan</center></th>
												<th><center>Jenis Kelamin</center></th>
												<th><center>Pekerjaan</center></th>
												<th><center>Gaji Pokok</center></th>
												<th><center>No Kontak</center></th>
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
                                                <td><?php echo $r['nama_karyawan'];?></td>
												<td><center><?php echo $r['jk'];?></center></td>
												
												<?php
													$sql = " SELECT tbl_pekerjaan.nama_pekerjaan as pekerjaan 
															 FROM tbl_pekerjaan LEFT JOIN tbl_karyawan
															 ON tbl_pekerjaan.id_pekerjaan=tbl_karyawan.id_pekerjaan
															 WHERE tbl_karyawan.id_karyawan='$r[id_karyawan]'";
													$c	= $conn->prepare($sql); 
													$c->execute();
													$d = $c->Fetch(PDO::FETCH_ASSOC);
												?>
												<td><?php echo $d['pekerjaan'];?></td>
												<td style="text-align:end"><?php echo rupiah($r['gaji_pokok']);?></td>
												<td><center><?php echo $r['no_hp'];?></center></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=karyawan&pp=edit&id=<?php echo $r['id_karyawan'];?>';"><i class="icon-note"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_karyawan'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data Karyawan</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 
													$sql = $conn->prepare("SELECT max(id_karyawan) as id FROM tbl_karyawan");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 7);
													$noUrut++;
													$char = "KAR-";
													$newID = $char . sprintf("%04s", $noUrut);
												?>
												
												<fieldset class="form-group">
                                                    <label>ID Karyawan</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Karyawan</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Karyawan" required>
                                                </fieldset>	
												
												<fieldset class="form-group">
                                                    <label for="exampleSelect1">Jenis Kelamin</label>
                                                    <select class="form-control" name="jk" required>
                                                        <option>Pilih Jenis Kelamin</option>                                                        
                                                        <option value="L">Laki-Laki</option>                                                        
                                                        <option value="P">Perempuan</option>                                                        
                                                    </select>
                                                </fieldset>

												<fieldset class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Alamat" name="alamat" required></textarea>
                                                </fieldset>	
												
												<fieldset class="form-group">
                                                    <label>No Kontak</label>
                                                    <input type="number" class="form-control" name="no_hp" placeholder="Masukkan No Kontak" required>
                                                </fieldset>												
												
												<?php
													$sql = "SELECT * FROM tbl_pekerjaan ORDER BY nama_pekerjaan ASC";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
												?>
												
                                                <fieldset class="form-group">
                                                    <label for="exampleSelect1">Pekerjaan</label>
                                                    <select class="form-control" name="pekerjaan" required>
                                                        <option>Pilih Pekerjaan</option>
                                                        <?php
															foreach($stmt->fetchAll() as $k=>$s){
																echo "<option value=\"$s[id_pekerjaan]\">$s[nama_pekerjaan]</option>";
															}
														?>
                                                    </select>
                                                </fieldset>	

												<fieldset class="form-group">
                                                    <label>Gaji Pokok</label>
                                                    <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji Pokok" required>
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
		$sql = "SELECT * FROM tbl_karyawan WHERE id_karyawan='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Edit Data Karyawan</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
											
												<fieldset class="form-group">
                                                    <label>ID Karyawan</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $e['id_karyawan']; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Karyawan</label>
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $e['nama_karyawan']; ?>" required>
                                                </fieldset>	

												<fieldset class="form-group">
                                                    <label for="exampleSelect1">Jenis Kelamin</label>
                                                    <select class="form-control" name="jk" required>
                                                        <option>Pilih Jenis Kelamin</option>
                                                        <option value="L" <?php if ($e['jk']=="L") { echo "selected=\"selected\""; } ?>>Laki-Laki</option>
														<option value="P" <?php if ($e['jk']=="P") { echo "selected=\"selected\""; } ?>>Perempuan</option>
                                                    </select>
                                                </fieldset>	

												<fieldset class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" rows="3" name="alamat" required><?php echo $e['alamat']; ?></textarea>
                                                </fieldset>	

												<fieldset class="form-group">
                                                    <label>No Kontak</label>
                                                    <input type="number" class="form-control" name="no_hp" value="<?php echo $e['no_hp']; ?>" required>
                                                </fieldset>
												
												<?php
													$sql = "SELECT * FROM tbl_pekerjaan ORDER BY nama_pekerjaan ASC";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
												?>
												
												<fieldset class="form-group">
                                                    <label for="exampleSelect1">Pekerjaan</label>
                                                    <select class="form-control" name="pekerjaan" required>
                                                        <option>Pilih Pekerjaan</option>
                                                        <?php
															foreach($stmt->fetchAll() as $k=>$r){
																if($r['id_pekerjaan']==$e['id_pekerjaan'])
																	echo "<option value=\"$r[id_pekerjaan]\" selected>$r[nama_pekerjaan]</option>";
																else 
																	echo "<option value=\"$r[id_pekerjaan]\">$r[nama_pekerjaan]</option>";
															}
														?>
                                                    </select>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Gaji Pokok</label>
                                                    <input type="number" class="form-control" name="gaji" value="<?php echo $e['gaji_pokok']; ?>" required>
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
	
