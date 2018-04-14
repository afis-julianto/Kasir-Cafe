<!-- Start Recent Projects Carousel -->
				<div class="recent-projects">
					<div class="row">
					<?php
						try {
							$sql = "SELECT * FROM tbl_galery";
							$stmt = $conn->prepare($sql);
							$stmt->execute();
							$stmt->setFetchMode(PDO::FETCH_ASSOC);
					?>
					<?php
						foreach($stmt->fetchAll() as $k=>$r){
					?> 
						<div class="col-md-2 col-sm-2">
							<div class="portfolio-item item">
								<div class="portfolio-border">
									<div class="portfolio-thumb">
										<a class="lightbox" title="<?php echo $r['nama_gallery'];?>" href="admin/uploads/img_galery/<?php echo $r['foto'];?>">
											<div class="thumb-overlay"></div>
											<img alt="" src="admin/uploads/img_galery/<?php echo $r['foto'];?>" />
										</a>
									</div>
									<div class="portfolio-details">
										<a href="#">
											<h4><?php echo $r['nama_gallery'];?></h4>
										</a>
									</div>
								</div>
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
				</div>
				<!-- End Recent Projects Carousel -->