<!-- Start HomePage Slider -->

<section id="home">	
  <!-- Carousel -->
  <div id="main-slide" class="carousel slide" data-ride="carousel">

     <!-- Indicators -->
     <ol class="carousel-indicators">
	 <?php
		try {
			$sql = "SELECT * FROM tbl_slider";
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$row = $stmt->rowCount();
			
			if($row>=0) {
				$no=-1;
				foreach($stmt->fetchAll() as $k=>$r){
				$no++;
	?>		
        <li data-target="#main-slide" data-slide-to="<?php echo $no; ?>"></li>
	<?php
				}
			}
		}					  
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
	?>
    </ol><!--/ Indicators end-->

    <!-- Carousel inner -->
	<div class="carousel-inner">
	<?php	
		try {
			$sql	= "SELECT * FROM tbl_slider LIMIT 0,1";
			$a		= $conn->prepare($sql); 
			$a->execute();
			$b 		= $a->Fetch(PDO::FETCH_ASSOC);
	?>
		<div class="item active">
			<img class="img-responsive" src="admin/uploads/img_slider/<?php echo $b['foto'];?>" alt="slider">
		</div><!--/ Carousel item end -->
		
	<?php
		}	  
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
	?>
		
	<?php
		try {
			$sql = "SELECT * FROM tbl_slider LIMIT 1,100";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			
			foreach($stmt->fetchAll() as $k=>$r){
	?> 
		<div class="item">
			<img class="img-responsive" src="admin/uploads/img_slider/<?php echo $r['foto'];?>" alt="slider">
		</div><!--/ Carousel item end -->
	<?php
			}
		}	  
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
	?>

	</div><!-- Carousel inner end-->

	<!-- Controls -->
	<a class="left carousel-control" href="#main-slide" data-slide="prev">
	   <span><i class="fa fa-angle-left"></i></span>
	</a>
	<a class="right carousel-control" href="#main-slide" data-slide="next">
	   <span><i class="fa fa-angle-right"></i></span>
	</a>
	</div><!-- /carousel -->    	
	</section>
	<!-- End HomePage Slider -->