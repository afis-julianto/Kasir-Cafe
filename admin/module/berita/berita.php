<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=berita"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Berita
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
$aksi = "module/berita/beritapro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_berita";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Berita</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=berita&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>


                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th style="width:5%"><center>No</center></th>
                                                <th><center>Judul</center></th>
                                                <th><center>Isi</center></th>
                                                <th><center>foto</center></th>
                                                <th style="width:15%"><center>Tools</center></th>
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
                                                <td><?php echo $r['judul_berita'];?></td>
                                                <td>
													&emsp;<?php echo $r['p1'];?><br>
													&emsp;<?php echo $r['p2'];?><br>
													&emsp;<?php echo $r['p3'];?><br>
													&emsp;<?php echo $r['p4'];?>
												</td>
												<td><center><img src="uploads/img_berita/<?php echo $r['foto'];?>" alt="user" class="img-circle" style="width: 50px; height: 50px;"></center></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=berita&pp=edit&id=<?php echo $r['id_berita'];?>';"><i class="icon-note"></i></button>											
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_berita'] .'&img='. $r['foto'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Galery</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
															
												<fieldset class="form-group">
                                                    <label>Judul</label>
                                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 1</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 1" name="p1"></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 2</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 2" name="p2"></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 3</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 3" name="p3"></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 4</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 4" name="p4"></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Tanggal</label>
													<input type="text" class="form-control" placeholder="Masukkan Judul" value="<?php echo tgl_indo($tanggal); ?>" readonly>
													<input hidden type="text" class="form-control" name="tgl" placeholder="Masukkan Judul" value="<?php echo $tgl_sekarang; ?>" readonly>
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
		$sql = "SELECT * FROM tbl_berita WHERE id_berita='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Gallery</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
											<input hidden class="form-control" name="fotol" value="<?php echo $e['foto'];?>">				
											<input hidden class="form-control" name="id" value="<?php echo $e['id_berita']; ?>" readonly>
												
												<fieldset class="form-group">
                                                    <label>Judul</label>
                                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan Judul" value="<?php echo $e['judul_berita'];?>" required>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 1</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 1" name="p1"><?php echo $e['p1'];?></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 2</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 2" name="p2"><?php echo $e['p2'];?></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 3</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 3" name="p3"><?php echo $e['p3'];?></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 4</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 4" name="p4"><?php echo $e['p4'];?></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Tanggal</label>
													<input type="text" class="form-control" value="<?php echo tgl_indo($e['tgl_berita']); ?>" readonly>
													<input hidden type="text" class="form-control" name="tgl" placeholder="Masukkan Judul" value="<?php echo $tgl_sekarang; ?>" readonly>
                                                </fieldset>
												
												<?php $foto = !empty($e['foto']) ? $e['foto']:"";?>
												<fieldset class="form-group">
													<h6>Foto</h6>
													<div class="row">
														<div class="col-xs-2" >
															<img style="width:130px;" src="uploads/img_berita/<?php echo $foto;?>" alt="">
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
	
