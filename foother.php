<!-- Start Footer -->
<footer>
   <div class="container">
      <div class="row footer-widgets">               
                    <!-- Start Contact Widget -->
                    <div class="col-md-4">
                            <h4 class="classic-title" style="color:white;"><span>Kontak</span></h4>
                            <ul>
							<?php
								try {
									$sql 	= "SELECT * FROM tbl_toko";
									$stmt 	= $conn->prepare($sql);
									$stmt->execute();
									$t 		= $stmt->Fetch(PDO::FETCH_ASSOC);
							?>
                                <li><span>Nomor Telp &emsp;: <?php echo $t['no_telp']; ?></span> </li>
                                <li><span>Website&emsp;&emsp;&emsp;: <?php echo $t['website']; ?></</span> </li>
                                <li><span>Facebook &emsp;&emsp;: <?php echo $t['fb']; ?></</span> </li>
                                <li><span>Instagram&emsp;&emsp;: <?php echo $t['ig']; ?></</span> </li>
								
							<?php
								}  
								catch(PDOException $e){
									echo $sql . "<br>" . $e->getMessage();
								}
							?>
                            </ul>
                    </div><!-- .col-md-3 -->
					
					<div class="col-md-8"> 
						<h4 class="classic-title" style="color:white;"><span>Lokasi</span></h4>
                            
                        <?php
							include "map.php";
						?>

                    </div><!-- .col-md-3 -->
                    <!-- End Contact Widget -->


	</div><!-- .row --><br><br>

<!-- Start Copyright -->
<div class="copyright-section">
   <div class="row">
      <div class="col-md-6">
	  <?php $tgl=date('Y'); ?>
                            <p>&copy; <?php echo $tgl; ?> Grafisindo -  Web Devloper</p>
     
	 </div>				
</div>
</div>
<!-- End Copyright -->

</div>
</footer>
<!-- End Footer -->