
<!-- Start Services Icons -->
<div class="row">

<!-- Start Recent Posts Carousel -->
		<div class="latest-posts">
			<h4 class="classic-title"><span>Berita</span></h4>
			<div class="latest-posts-classic custom-carousel touch-carousel" data-appeared-items="3">
				
				<?php
					try {
						$sql = "SELECT DAY(tgl_berita) as tanggal, MONTH(tgl_berita) as bulan, judul_berita, p1, p2, p3, p4, foto,id_berita, tgl_berita FROM tbl_berita MAX LIMIT 0,3";
						$stmt = $conn->prepare($sql);
						$stmt->execute();
						$stmt->setFetchMode(PDO::FETCH_ASSOC);
								
							foreach($stmt->fetchAll() as $k=>$r){
								$isi_berita = htmlentities (strip_tags($r['p1']	));
								$isi 		= substr($isi_berita, 0, 200);
								//$isi		= substr($isi_berita,0,strpos($isi," "));
				?>
				<!-- Post 1 -->
				<div class="post-row item">
					<div class="left-meta-post">
						<div class="post-date"><span class="day"><?php echo $r['tanggal']; ?></span><span class="month"><?php echo ambilbulan($r['bulan']); ?></span></div>
						<div class="post-type"><i class="fa fa-picture-o"></i></div>
					</div>
					<h3 class="post-title"><a href="#"><?php echo $r['judul_berita']; ?></a></h3>
					<div class="post-content">
						<p><?php echo $isi; ?><a class="read-more" href="isi-berita.php?id=<?php echo $r['id_berita']; ?>"> Baca...</a></p>
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
			
			<center><a href="berita.php">Berita Selengkapnya</a></center>
		</div>
		<!-- End Recent Posts Carousel -->  


</div>
<!-- End Services Icons -->