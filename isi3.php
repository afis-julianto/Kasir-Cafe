<!-- Start Recent Projects Carousel -->
				<div class="recent-projects">
					<h4 class="title"><span>Galery Menu</span></h4>
					<div class="projects-carousel touch-carousel">
					<?php
						try {
							$sql = "SELECT * FROM tbl_menu";
							$stmt = $conn->prepare($sql);
							$stmt->execute();
							$stmt->setFetchMode(PDO::FETCH_ASSOC);

						foreach($stmt->fetchAll() as $k=>$r){
					?> 
						<div class="portfolio-item item">
							<div class="portfolio-border">
								<div class="portfolio-thumb">
									<a class="lightbox" title="<?php echo $r['nama_menu'];?>" href="admin/uploads/img_menu/<?php echo $r['foto'];?>">
										<img alt="" src="admin/uploads/img_menu/<?php echo $r['foto'];?>" />
									</a>
								</div>
								<div class="portfolio-details">
									<a href="#">
										<h4><?php echo $r['nama_menu'];?></h4>
									</a>
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