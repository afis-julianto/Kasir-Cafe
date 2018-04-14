<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=harga"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Daftar Harga
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
$aksi = "module/menu/menupro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_menu";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Daftar Harga</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=menu&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>


                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th><center>No</center></th>
                                                <th><center>Nama Menu</center></th>
                                                <th><center>Harga</center></th>
                                                <th><center>Diskon %</center></th>
                                                <th><center>foto</center></th>
												<th><center>Keterangan</center></th>
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
                                                <td><?php echo $r['nama_menu'];?></td>
                                                <td style="text-align:end"><?php echo rupiah($r['harga_menu']);?></td>
												<td><center><?php echo $r['diskon_menu'];?> %</center></td>
												<td><center><img src="uploads/img_menu/<?php echo $r['foto'];?>" alt="user" class="img-circle" style="width: 50px; height: 50px;"></center></td>
												
												<?php
													$sql = " SELECT tbl_kategori.nama_kategori as kategori 
															 FROM tbl_kategori LEFT JOIN tbl_menu
															 ON tbl_kategori.id_kategori=tbl_menu.id_kategori
															 WHERE tbl_menu.id_menu='$r[id_menu]'";
													$a	= $conn->prepare($sql); 
													$a->execute();
													$b = $a->Fetch(PDO::FETCH_ASSOC);
												?>
									
												<td><?php echo $b['kategori'];?></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=menu&pp=edit&id=<?php echo $r['id_menu'];?>';"><i class="icon-note"></i></button>											
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_menu'] .'&img='. $r['foto'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Daftar Harga</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 
													$sql = $conn->prepare("SELECT max(id_MENU) as id FROM tbl_menu");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 2);
													$noUrut++;
													$char = "M-";
													$newID = $char . sprintf("%04s", $noUrut);
												?>
												
												<fieldset class="form-group">
                                                    <label>ID Harga Menu / Pelayanan</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Menu / Pelayanan</label>
                                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Menu / Pelayanan" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Harga</label>
                                                    <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Diskon %</label>
                                                    <input type="number" class="form-control" value="0" name="diskon" placeholder="Masukkan Diskon">
                                                </fieldset>
												
												<?php
													$sql = "SELECT * FROM tbl_kategori ORDER BY nama_kategori ASC";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
												?>
												
                                                <fieldset class="form-group">
                                                    <label for="exampleSelect1">Kategori</label>
                                                    <select class="form-control" name="kategori" required>
                                                        <option>Pilih Kategori</option>
                                                        <?php
															foreach($stmt->fetchAll() as $k=>$r){
																echo "<option value=\"$r[id_kategori]\">$r[nama_kategori]</option>";
															}
														?>
                                                    </select>
                                                </fieldset>
												
												<fieldset class="form-group">
													<h6>Foto</h6>
													<label class="file">
														<input type="file" id="file" name="fupload">
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
		$sql = "SELECT * FROM tbl_menu WHERE id_menu='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Edit Daftar Harga</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
											<input type="hidden" class="form-control" name="fotol" value="<?php echo $e['foto'];?>">				
												
												<fieldset class="form-group">
                                                    <label>ID Harga Menu / Pelayanan</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $e['id_menu']; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Menu / Pelayanan</label>
                                                    <input type="text" class="form-control" name="nama" value="<?php echo $e['nama_menu']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Harga</label>
                                                    <input type="number" class="form-control" name="harga" value="<?php echo $e['harga_menu']; ?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Diskon</label>
                                                    <input type="number" class="form-control" name="diskon" value="<?php echo $e['diskon_menu']; ?>" required>
                                                </fieldset>
												
												<?php
													$sql = "SELECT * FROM tbl_kategori ORDER BY nama_kategori ASC";
													$stmt = $conn->prepare($sql); 
													$stmt->execute();
													$stmt->setFetchMode(PDO::FETCH_ASSOC);
												?>
												
                                                <fieldset class="form-group">
                                                    <label for="exampleSelect1">Kategori</label>
                                                    <select class="form-control" name="kategori" required>
                                                        <option>Pilih Kategori</option>
                                                        <?php
															foreach($stmt->fetchAll() as $k=>$r){
																if($r['id_kategori']==$e['id_kategori'])
																	echo "<option value=\"$r[id_kategori]\" selected>$r[nama_kategori]</option>";
																else 
																	echo "<option value=\"$r[id_kategori]\">$r[nama_kategori]</option>";
															}
														?>
                                                    </select>
                                                </fieldset>
												
												<?php $foto = !empty($e['foto']) ? $e['foto']:"";?>
												<fieldset class="form-group">
													<h6>Foto</h6>
													<div class="row">
														<div class="col-xs-2" >
															<img style="width:130px;" src="uploads/img_menu/<?php echo $foto;?>" alt="">
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
	
