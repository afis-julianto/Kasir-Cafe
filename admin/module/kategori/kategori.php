<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=kategori"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Data Kategori
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
$aksi = "module/kategori/kategoripro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_kategori";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Data Kategori</b></h4>
                                    
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=kategori&pp=add';">
										<span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th style="width:5%"><center>No</center></th>
                                                <th><center>Nama Kategori</center></th>
                                                <th style="width:20%"><center>Tools</center></th>
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
                                                <td><?php echo $r['nama_kategori'];?></td>
                                                <td style="text-align:center; width:20%;">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=kategori&pp=edit&id=<?php echo $r['id_kategori'];?>';"><i class="icon-note"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_kategori'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Input Data Kategori</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">
												
												<?php 
													$sql = $conn->prepare("SELECT max(id_kategori) as id FROM tbl_kategori");
													$sql->execute();
													$hasil = $sql->fetch();
													
													$kode = $hasil['id'];
													$noUrut = (int) substr($kode, 5);
													$noUrut++;
													$char = "K-";
													$newID = $char . sprintf("%04s", $noUrut);
												?>
												
												<fieldset class="form-group">
                                                    <label>ID Kategori</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $newID; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text" class="form-control" name="kategori" placeholder="Masukkan Nama Kategori" required>
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
		$sql = "SELECT * FROM tbl_kategori WHERE id_kategori='$id'";
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
											
												<fieldset class="form-group">
                                                    <label>ID Kategori</label>
                                                    <input type="text" class="form-control" name="id" value="<?php echo $e['id_kategori']; ?>" readonly>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text" class="form-control" name="kategori" value="<?php echo $e['nama_kategori']; ?>" required>
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
	
