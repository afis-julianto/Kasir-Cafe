<div class="row">
   <div class="col-md-12">
     <!-- Start Clients Carousel -->
     <div class="our-clients">
        
        <!-- Classic Heading -->
        <h4 class="classic-title"><span>Partner</span></h4>
        
        <div class="clients-carousel custom-carousel touch-carousel" data-appeared-items="5">
          
		<?php
			try {
				$sql = "SELECT * FROM tbl_partner";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_ASSOC);

				foreach($stmt->fetchAll() as $k=>$r){
		?> 
          <!--Client-->
          <div class="client-item item">
            <a href="#"><img src="admin/uploads/img_partner/<?php echo $r['foto'];?>" alt="" /></a>
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
<!--End Clients Carousel-->
</div>
</div>