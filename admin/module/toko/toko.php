<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=toko"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Toko
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
$aksi = "module/toko/tokopro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_toko";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Toko</b></h4>
                                    <?php
										if($row==1) {
									?>	
									<button hidden type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=toko&pp=add';"><span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>
									<?php
										} else {		
									?>
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=toko&pp=add';"><span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>
									<?php
										}
									?>	

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th style="width:5%"><center>No</center></th>
                                                <th><center>Nama Toko</center></th>
												<th><center>No Kontak</center></th>
												<th><center>Alamat</center></th>
												<th><center>Logo</center></th>
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
                                                <td><?php echo $r['nama_toko'];?></td>
												<td><center><?php echo $r['no_telp'];?></center></td>
												<td><?php echo $r['alamat'];?></td>
												<td><center><img src="uploads/img_toko/<?php echo $r['foto'];?>" alt="user" class="img-circle" style="width: 50px; height: 50px;"></center></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=toko&pp=edit&id=<?php echo $r['id_toko'];?>';"><i class="icon-note"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_toko'] .'&img='. $r['foto'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data Toko</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 
													$sql = $conn->prepare("SELECT max(id_toko) as id FROM tbl_toko");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 5);
													$noUrut++;
													$char = "T-";
													$newID = $char . sprintf("%04s", $noUrut);
												?>
												
												<fieldset class="form-group">
                                                    <label>ID Toko</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Toko</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Toko" required>
                                                </fieldset>			

												<fieldset class="form-group">
                                                    <label>No Telephone</label>
                                                    <input type="number" class="form-control" name="no_telp" placeholder="Masukkan No Telephone" required>
                                                </fieldset>

												<fieldset class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Alamat" name="alamat" required></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control" name="web" placeholder="Masukkan Nama Website">
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Facebook</label>
                                                    <input type="text" class="form-control" name="fb" placeholder="Masukkan Nama Facebook">
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Instagram</label>
                                                   <input type="text" class="form-control" name="ig" placeholder="Masukkan Nama Instagram">
                                                </fieldset>
												
												<fieldset class="form-group">
													<h6>Logo</h6>
													<label class="file">
														<input type="file" id="file" name="fupload" required>
														<span class="file-custom"></span>
													</label>
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
		$sql = "SELECT * FROM tbl_toko WHERE id_toko='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Edit Data Kategori</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
											<input type="hidden" class="form-control" name="fotol" value="<?php echo $e['foto'];?>">
												<fieldset class="form-group">
                                                    <label>ID Toko</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $e['id_toko']; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Toko</label>
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $e['nama_toko']; ?>" required>
                                                </fieldset>			

												<fieldset class="form-group">
                                                    <label>No Telephone</label>
                                                    <input type="number" class="form-control" name="no_telp" value="<?php echo $e['no_telp']; ?>" required>
                                                </fieldset>

												<fieldset class="form-group">
                                                    <label>Alamat</label>
                                                    <textarea class="form-control" rows="3" name="alamat" required><?php echo $e['alamat']; ?></textarea>
                                                </fieldset>	

												<fieldset class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control" name="web" value="<?php echo $e['website']; ?>" placeholder="Masukkan Nama Website">
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Facebook</label>
                                                    <input type="text" class="form-control" name="fb" value="<?php echo $e['fb']; ?>" placeholder="Masukkan Nama Facebook">
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Instagram</label>
                                                   <input type="text" class="form-control" name="ig" value="<?php echo $e['ig']; ?>" placeholder="Masukkan Nama Instagram">
                                                </fieldset>
												
												<?php $foto = !empty($e['foto']) ? $e['foto']:"";?>
												<fieldset class="form-group">
													<h6>Foto</h6>
													<div class="row">
														<div class="col-xs-2" >
															<img style="width:130px;" src="uploads/img_toko/<?php echo $foto;?>" alt="">
														</div>
														<div class="col-xs-10">
															<label class="file">
																<input type="file" id="file" name="fupload" >
																<span class="file-custom"></span>
															</label>
														</div>
													</div>
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
	
