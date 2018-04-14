<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=user"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data User
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
$aksi = "module/user/userpro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_users ORDER BY id_user DESC";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Users</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=user&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>


                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Username</th>
                                                <th>No Telphone</th>
												<th>Level</th>
												<th>Blokir</th>
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
                                                <td><?php echo $no;?></td>
                                                <td><img src="uploads/img_user/<?php echo $r['foto'];?>" alt="user" class="img-circle" style="width: 80px; height: 80px;"></td>
                                                <td><?php echo $r['username'];?></td>
                                                <td><?php echo $r['no_telp'];?></td>
												<td><?php echo $r['level'];?></td>
												<td><?php echo $r['blokir'];?></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-success"  onclick="window.location.href='?page=user&pp=view&id=<?php echo base64_encode ($r['id_user']);?>';"><i class="icon-eye"></i></button>
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=user&pp=edit&id=<?php echo base64_encode ($r['id_user']);?>';"><i class="icon-note"></i></button>
												
												<?php
													if($row==1) {
												?>	
												<button disabled class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. base64_encode($r['id_user']) .'&img='. $r['foto'];?>';"><i class="icon-trash"></i></button>
												
												<?php
													} else {		
												?>
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. base64_encode($r['id_user']) .'&img='. $r['foto'];?>';"><i class="icon-trash"></i></button>
												</td>
												
                                            </tr>
											<?php
													}												
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data User</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 
													$sql = $conn->prepare("SELECT max(id_user) as id FROM tbl_users");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 2);
													$noUrut++;
													$char = "U-";
													$newID = $char . sprintf("%04s", $noUrut);
												?>
												
												<fieldset class="form-group">
                                                    <label>ID User</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>No Telephone</label>
                                                    <input type="number" class="form-control" name="no_telp" placeholder="Masukkan No Telephone" required>
                                                </fieldset>
												
                                                <fieldset class="form-group">
                                                    <label for="exampleSelect1">Level</label>
                                                    <select class="form-control" name="level" required>
                                                        <option>Pilih Level</option>
                                                        <option value="admin">Admin</option>
														<option value="karyawan">Karyawan</option>
														<option value="website">Website</option>
                                                    </select>
                                                </fieldset>
												
												<fieldset class="form-group">
													<h6>Foto</h6>
													<label class="file">
														<input type="file" id="file" name="fupload">
														<span class="file-custom"></span>
													</label>
												</fieldset>
												
												<fieldset class="form-group">
													<h6>Blokir ?</h6>
													<label class="c-input c-checkbox" style="color:black">
														<input type="checkbox" name="blokir" value="Y">Ya
														<span class="c-indicator"></span>
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
	
	case "view":
	try{
		$id = base64_decode($_GET['id']);
		$sql = "SELECT * FROM tbl_users WHERE id_user='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$v = $stmt->fetch(PDO::FETCH_ASSOC);
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">
                        			<h4 class="header-title m-t-0 m-b-30"><b>Lihat Data User</b></h4>

                        			<div class="row">
                        				<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-xl-2"></div>
										<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-xl-2">
											<img src="uploads/img_user/<?php echo $v['foto'];?>" width="150" alt="">
                        				</div><!-- end col -->
										<div class="col-lg-6 col-sm-6 col-xs-6 col-md-6 col-xl-6">
												<div class="table-responsive">
													<table class="table table-bordered table-striped">
															<tr>
																<td>ID User</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['id_user'];?></td>
															</tr>
															<tr>
																<td>Nama Lengkap</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['nama_lengkap'];?></td>
															</tr>
															<tr>
																<td>Username</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['username'];?></td>
															</tr>
															<tr>
																<td>Password</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['password'];?></td>
															</tr>
															<tr>
																<td>Blokir</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['blokir'];?></td>
															</tr>
															<tr>
																<td>Level</td>
																<td style="text-align:center;">:</td>
																<td><?php echo $v['level'];?></td>
															</tr>		
													</table>
												</div>
                        				</div><!-- end col -->
										<div class="col-lg-2 col-sm-2 col-xs-2 col-md-2 col-xl-2"></div>
											
                        			</div><!-- end row -->
									<button type="button" onclick="self.history.back()" class="btn btn-danger">Back</button>
                        		</div>
                        	</div><!-- end col -->
                        </div>
                        <!-- end row -->

<?php
} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	break;
	
	case "edit":
	try{
		$id = base64_decode($_GET['id']);
		$sql = "SELECT * FROM tbl_users WHERE id_user='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Edit Data User</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
											<input type="hidden" class="form-control" name="fotol" value="<?php echo $e['foto'];?>">				
												
												<fieldset class="form-group">
                                                    <label>ID User</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $e['id_user']; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $e['nama_lengkap']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" name="username" value="<?php echo $e['username']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control" name="password">
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>No Telephone</label>
                                                    <input type="number" class="form-control" name="no_telp" value="<?php echo $e['no_telp']; ?>" required>
                                                </fieldset>
												
                                                <fieldset class="form-group">
                                                    <label for="exampleSelect1">Level</label>
                                                    <select class="form-control" name="level" required>
                                                        <option>Pilih Level</option>
                                                        <option value="admin" <?php if ($e['level']=="admin") { echo "selected=\"selected\""; } ?>>Admin</option>
														<option value="karyawan" <?php if ($e['level']=="karyawan") { echo "selected=\"selected\""; } ?>>Karyawan</option>
														<option value="website" <?php if ($e['level']=="website") { echo "selected=\"selected\""; } ?>>Website</option>
                                                    </select>
                                                </fieldset>
												
												<?php $foto = !empty($e['foto']) ? $e['foto']:"";?>
												<fieldset class="form-group">
													<h6>Foto</h6>
													<div class="row">
														<div class="col-xs-2" >
															<img style="width:130px;" src="uploads/img_user/<?php echo $foto;?>" alt="">
														</div>
														<div class="col-xs-10">
															<label class="file">
																<input type="file" id="file" name="fupload" >
																<span class="file-custom"></span>
															</label>
														</div>
													</div>
												</fieldset>
												
												<?php $blokir = $e['blokir']=="Y"? "checked":""; ?>
												<fieldset class="form-group">
													<h6>Blokir ?</h6>
													<label class="c-input c-checkbox">
														<input type="checkbox" name="blokir" value="Y" <?php echo $blokir;?>>Ya
														<span class="c-indicator"></span>
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
} 
catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
	break;	
}
?>
	
