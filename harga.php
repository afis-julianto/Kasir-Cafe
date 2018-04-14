<!-- Start Pricing Table Section -->
            <div class="pricing-section" style="padding-top:0px; padding-bottom:60px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Start Big Heading -->
                            <div class="big-title text-center">
								<h1><strong>HARGA MENU</strong></h1>
                            </div>
                            <!-- End Big Heading -->
                        </div>
                    </div>
                    
					<!--/ 1-->
                    <div class="row pricing-tables">			
						<?php
							try {
								$sql = "SELECT * FROM tbl_kategori MAX LIMIT 0,3";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
								foreach($stmt->fetchAll() as $k=>$r){
						?>
						
							
									<div class="col-md-4 col-sm-4">
										<div class="pricing-table highlight-plan">
										<div class="plan-name">
											<h3><?php echo $r['nama_kategori'];?></h3>
										</div>
										<?php
											try {
												$kategori = $r['id_kategori'];
												$sql = "SELECT * FROM tbl_menu WHERE id_kategori='$kategori'";
												$stmt = $conn->prepare($sql); 
												$stmt->execute();
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$row = $stmt->rowCount();
										?>
										<div class="plan-list">
											<table>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$s){
														$no++;
											?>	
												<tr>
													<td><b><?php echo $s['nama_menu'];?></b></td>
													<td><center>:</center></td>
													<td style="text-align:end"><?php echo rupiah($s['harga_menu']);?></td>
													<td><center>
														<a class="lightbox" title="<?php echo $s['nama_menu'];?>" href="admin/uploads/img_menu/<?php echo $s['foto'];?>">
															<div class="thumb-overlay"></div>
															<img style="width:50px; height:50px" alt="" src="admin/uploads/img_menu/<?php echo $s['foto'];?>" />
														</a>
													</center></td>
												</tr>
											<?php												
													}
												}
											?>	
											</table>
										</div>
										<?php
											}
							  
											catch(PDOException $e){
												echo $sql . "<br>" . $e->getMessage();
											}
										?>
									</div>
									</div>							
						<?php
							}
							}
				  
							catch(PDOException $e){
								echo $sql . "<br>" . $e->getMessage();
							}
						?>
					</div>
					<!--/ 1-->
					
					<!--/ 2-->
					<div class="row pricing-tables">	
						<?php
							try {
								$sql = "SELECT * FROM tbl_kategori MAX LIMIT 3,3";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
								foreach($stmt->fetchAll() as $k=>$r){
						?>
						
							
									<div class="col-md-4 col-sm-4">
										<div class="pricing-table highlight-plan">
										<div class="plan-name">
											<h3><?php echo $r['nama_kategori'];?></h3>
										</div>
										<?php
											try {
												$kategori = $r['id_kategori'];
												$sql = "SELECT * FROM tbl_menu WHERE id_kategori='$kategori'";
												$stmt = $conn->prepare($sql); 
												$stmt->execute();
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$row = $stmt->rowCount();
										?>
										<div class="plan-list">
											<table>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$s){
														$no++;
											?>	
												<tr>
													<td><b><?php echo $s['nama_menu'];?></b></td>
													<td><center>:</center></td>
													<td style="text-align:end"><?php echo rupiah($s['harga_menu']);?></td>
													<td><center>
														<a class="lightbox" title="<?php echo $s['nama_menu'];?>" href="kasir/uploads/img_menu/<?php echo $s['foto'];?>">
															<div class="thumb-overlay"></div>
															<img style="width:50px; height:50px" alt="" src="kasir/uploads/img_menu/<?php echo $s['foto'];?>" />
														</a>
													</center></td>
												</tr>
											<?php												
													}
												}
											?>	
											</table>
										</div>
										<?php
											}
							  
											catch(PDOException $e){
												echo $sql . "<br>" . $e->getMessage();
											}
										?>
									</div>
									</div>							
						<?php
							}
							}
				  
							catch(PDOException $e){
								echo $sql . "<br>" . $e->getMessage();
							}
						?>
					</div>
					<!--/ 2-->
					
					<!--3-->
					<div class="row pricing-tables">	
						<?php
							try {
								$sql = "SELECT * FROM tbl_kategori MAX LIMIT 6,3";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
								foreach($stmt->fetchAll() as $k=>$r){
						?>
						
							
									<div class="col-md-4 col-sm-4">
										<div class="pricing-table highlight-plan">
										<div class="plan-name">
											<h3><?php echo $r['nama_kategori'];?></h3>
										</div>
										<?php
											try {
												$kategori = $r['id_kategori'];
												$sql = "SELECT * FROM tbl_menu WHERE id_kategori='$kategori'";
												$stmt = $conn->prepare($sql); 
												$stmt->execute();
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$row = $stmt->rowCount();
										?>
										<div class="plan-list">
											<table>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$s){
														$no++;
											?>	
												<tr>
													<td><b><?php echo $s['nama_menu'];?></b></td>
													<td><center>:</center></td>
													<td style="text-align:end"><?php echo rupiah($s['harga_menu']);?></td>
													<td><center>
														<a class="lightbox" title="<?php echo $s['nama_menu'];?>" href="kasir/uploads/img_menu/<?php echo $s['foto'];?>">
															<div class="thumb-overlay"></div>
															<img style="width:50px; height:50px" alt="" src="kasir/uploads/img_menu/<?php echo $s['foto'];?>" />
														</a>
													</center></td>
												</tr>
											<?php												
													}
												}
											?>	
											</table>
										</div>
										<?php
											}
							  
											catch(PDOException $e){
												echo $sql . "<br>" . $e->getMessage();
											}
										?>
									</div>
									</div>							
						<?php
							}
							}
				  
							catch(PDOException $e){
								echo $sql . "<br>" . $e->getMessage();
							}
						?>
					</div>
					<!--/ 3-->
					
					<!--4-->
					<div class="row pricing-tables">	
						<?php
							try {
								$sql = "SELECT * FROM tbl_kategori MAX LIMIT 9,3";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
								foreach($stmt->fetchAll() as $k=>$r){
						?>
						
							
									<div class="col-md-4 col-sm-4">
										<div class="pricing-table highlight-plan">
										<div class="plan-name">
											<h3><?php echo $r['nama_kategori'];?></h3>
										</div>
										<?php
											try {
												$kategori = $r['id_kategori'];
												$sql = "SELECT * FROM tbl_menu WHERE id_kategori='$kategori'";
												$stmt = $conn->prepare($sql); 
												$stmt->execute();
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$row = $stmt->rowCount();
										?>
										<div class="plan-list">
											<table>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$s){
														$no++;
											?>	
												<tr>
													<td><b><?php echo $s['nama_menu'];?></b></td>
													<td><center>:</center></td>
													<td style="text-align:end"><?php echo rupiah($s['harga_menu']);?></td>
													<td><center>
														<a class="lightbox" title="<?php echo $s['nama_menu'];?>" href="kasir/uploads/img_menu/<?php echo $s['foto'];?>">
															<div class="thumb-overlay"></div>
															<img style="width:50px; height:50px" alt="" src="kasir/uploads/img_menu/<?php echo $s['foto'];?>" />
														</a>
													</center></td>
												</tr>
											<?php												
													}
												}
											?>	
											</table>
										</div>
										<?php
											}
							  
											catch(PDOException $e){
												echo $sql . "<br>" . $e->getMessage();
											}
										?>
									</div>
									</div>							
						<?php
							}
							}
				  
							catch(PDOException $e){
								echo $sql . "<br>" . $e->getMessage();
							}
						?>
					</div>
					<!--/ 4-->
					
					<!--5-->
					<div class="row pricing-tables">	
						<?php
							try {
								$sql = "SELECT * FROM tbl_kategori MAX LIMIT 12,3";
								$stmt = $conn->prepare($sql);
								$stmt->execute();
								$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
								foreach($stmt->fetchAll() as $k=>$r){
						?>
						
							
									<div class="col-md-4 col-sm-4">
										<div class="pricing-table highlight-plan">
										<div class="plan-name">
											<h3><?php echo $r['nama_kategori'];?></h3>
										</div>
										<?php
											try {
												$kategori = $r['id_kategori'];
												$sql = "SELECT * FROM tbl_menu WHERE id_kategori='$kategori'";
												$stmt = $conn->prepare($sql); 
												$stmt->execute();
												$stmt->setFetchMode(PDO::FETCH_ASSOC);
												$row = $stmt->rowCount();
										?>
										<div class="plan-list">
											<table>
											<?php
												if($row>0) {
													$no=0;
													foreach($stmt->fetchAll() as $k=>$s){
														$no++;
											?>	
												<tr>
													<td><b><?php echo $s['nama_menu'];?></b></td>
													<td><center>:</center></td>
													<td style="text-align:end"><?php echo rupiah($s['harga_menu']);?></td>
													<td><center>
														<a class="lightbox" title="<?php echo $s['nama_menu'];?>" href="kasir/uploads/img_menu/<?php echo $s['foto'];?>">
															<div class="thumb-overlay"></div>
															<img style="width:50px; height:50px" alt="" src="kasir/uploads/img_menu/<?php echo $s['foto'];?>" />
														</a>
													</center></td>
												</tr>
											<?php												
													}
												}
											?>	
											</table>
										</div>
										<?php
											}
							  
											catch(PDOException $e){
												echo $sql . "<br>" . $e->getMessage();
											}
										?>
									</div>
									</div>							
						<?php
							}
							}
				  
							catch(PDOException $e){
								echo $sql . "<br>" . $e->getMessage();
							}
						?>
					</div>
					<!--/ 5-->
					
                    </div>
                </div>
            <!-- End Pricing Table Section -->