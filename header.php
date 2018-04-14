<!-- Start Top Bar -->
          <div class="top-bar">
            <div class="container">
               <div class="row">
                  <div class="col-md-6">
                    <!-- Start Contact Info -->
                    <ul class="contact-details">
						<?php
							try {
								$sql 	= "SELECT * FROM tbl_toko";
								$stmt 	= $conn->prepare($sql);
								$stmt->execute();
								$t 		= $stmt->Fetch(PDO::FETCH_ASSOC);
						?>
                                <li><a href="#"><i class="fa fa-map-marker"></i> <?php echo $t['alamat']; ?></a>
                                </li>
                                <li><a href="#"><i class="fa fa-phone"></i> <?php echo $t['no_telp']; ?></a>
                                </li>
						<?php
							}  
							catch(PDOException $e){
								echo $sql . "<br>" . $e->getMessage();
							}
						?>
                            </ul>
                  <!-- End Contact Info -->
              </div>
              <div class="col-md-6">
                <!-- Start Social Links -->
                <ul class="social-list">
                  <li>
                    <a class="facebook itl-tooltip" data-placement="bottom" title="Facebook" href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a class="twitter itl-tooltip" data-placement="bottom" title="Twitter" href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a class="google itl-tooltip" data-placement="bottom" title="Google Plus" href="#"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                    <a class="dribbble itl-tooltip" data-placement="bottom" title="Dribble" href="#"><i class="fa fa-dribbble"></i></a>
                </li>
            </ul>
            <!-- End Social Links -->
        </div>
    </div>
</div>
</div>
<!-- End Top Bar -->