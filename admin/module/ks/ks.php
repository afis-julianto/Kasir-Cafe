<?php
defined("BASEPATH") or exit(header("location: ../adminpanel.php?page=ks"));
?>

						<div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <ol class="breadcrumb p-0">
										<li class="active">
											Kata Sambutan
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
$aksi = "module/ks/kspro.php";
$pp = isset($_GET['pp'])? filcar($_GET['pp']):"";

switch ($pp){
	default:
	try {
		$sql = "SELECT * FROM tbl_kata_sambutan";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();
?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Kata Sambutan</b></h4>
                                    <?php
										if($row==1) {
									?>	
									<button hidden type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=ks&pp=add';"><span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>
									<?php
										} else {		
									?>
									<button type="button" class="btn btn-info waves-effect waves-light w-xs btn-sm" onclick="window.location.href='?page=ks&pp=add';"><span class="btn-label"><i class="fa  fa-plus"></i></span>Tambah
									</button><br><br>
									<?php
										}
									?>	

                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>                                             
                                                <th style="width:5%"><center>No<center></th>
                                                <th style="width:20%"><><center>Paragraf 1</center></th>
                                                <th><center>Paragraf 2</center></th>
                                                <th><center>Paragraf 3</center></th>
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
                                                <td><?php echo $r['p1'];?></td>
                                                <td><?php echo $r['p2'];?></td>
                                                <td><?php echo $r['p3'];?></td>
                                                <td style="text-align:center">
												
												<button class="btn waves-effect waves-light btn-warning"  onclick="window.location.href='?page=ks&pp=edit&id=<?php echo $r['id_ks'];?>';"><i class="icon-note"></i></button>
												
												<button class="btn waves-effect waves-light btn-danger" onclick="window.location.href='<?php echo $aksi .'?act=delete&id='. $r['id_ks'];?>';"><i class="icon-trash"></i></button>
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

                        			<h4 class="header-title m-t-0 m-b-30"><b>Kata Sambutan</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=save';?>" enctype="multipart/form-data">

												<fieldset class="form-group">
                                                    <label>Paragraf 1</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 1" name="p1" required></textarea>
                                                </fieldset>
																									
												<fieldset class="form-group">
                                                    <label>Paragraf 2</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 2" name="p2"></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 3</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 3" name="p3"></textarea>
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
		$sql = "SELECT * FROM tbl_kata_sambutan WHERE id_ks='$id'";
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$e = $stmt->fetch(PDO::FETCH_ASSOC); 
?>

						<div class="row">
                        	<div class="col-sm-12">
                        		<div class="card-box">

                        			<h4 class="header-title m-t-0 m-b-30"><b>Kata Sambutan</b></h4>

                        			<div class="row">
                        				<div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 col-xl-12">
                                            <form method="post" action="<?php echo $aksi .'?act=edit';?>" enctype="multipart/form-data">
												<input hidden type="text" class="form-control" name="id" value="<?php echo $e['id_ks']; ?>" readonly>
                                                
												<fieldset class="form-group">
                                                    <label>Paragraf 1</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 1" name="p1" required><?php echo $e['p1']; ?></textarea>
                                                </fieldset>
																									
												<fieldset class="form-group">
                                                    <label>Paragraf 2</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 2" name="p2"><?php echo $e['p2']; ?></textarea>
                                                </fieldset>
												
												<fieldset class="form-group">
                                                    <label>Paragraf 3</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan Paragraf 3" name="p3"><?php echo $e['p3']; ?></textarea>
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
	
