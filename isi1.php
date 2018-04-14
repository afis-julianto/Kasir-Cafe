<div class="row">
  
  

<div class="col-md-8">
  
  <!-- Classic Heading -->
  <h4 class="classic-title"><span>History</span></h4>
	<?php
		try {
			$sql = "SELECT * FROM tbl_kata_sambutan";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$v = $stmt->Fetch(PDO::FETCH_ASSOC);
	?>
	<p>&emsp;&emsp;&emsp;<?php echo $v['p1'] ?></p><br>
	<p>&emsp;&emsp;&emsp;<?php echo $v['p2'] ?></p><br>
	<p>&emsp;&emsp;&emsp;<?php echo $v['p3'] ?></p>
	
	<?php
		}
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}
	?>
  <!-- Accordion -->
  <div class="panel-group" id="accordion">
    
    





</div>
</div>

<div class="col-md-4">
  <!-- Classic Heading -->
  <h4 class="classic-title"><span>Video</span></h4>
  <!-- Vimeo Iframe -->
  <iframe src="https://player.vimeo.com/video/63322694?title=0&amp;byline=0&amp;portrait=0" width="800" height="450"></iframe>
</div>

</div>
<div class="hr1 margin-top"></div>
<div class="hr1 margin-top"></div>
<div class="hr1 margin-top"></div>
   