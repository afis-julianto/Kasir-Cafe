<?php
define("BASEPATH", dirname(__FILE__));

include "admin/config/connection.php";
include "admin/config/library.php";

?>

<!doctype html>
<html lang="en">

<?php include "head.php"; ?>

<body>

	<!-- Container -->
	<div id="container">
		
        <!-- Start Header -->
        <div class="hidden-header"></div>
        <header class="clearfix">
		
		<?php
			include "header.php";
		?>
		
	<!-- Start Header ( Logo & Naviagtion ) -->
		<div class="navbar navbar-default navbar-top">
		  <div class="container">
			 <div class="navbar-header">
				<!-- Stat Toggle Nav Link For Mobiles -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				   <i class="fa fa-bars"></i>
			   </button>
		   </div>
		   <div class="navbar-collapse collapse">
		<!-- Start Navigation List -->
		<ul class="nav navbar-nav navbar-left">
			<li><a href="index.php">Home</a></li>
			<li><a class="active" href="menu.php">Menu</a></li>
			<li><a href="galery.php">Gallery</a></li>
			<li><a href="berita.php">Berita</a></li>
		</ul>
		<!-- End Navigation List -->
		</div>
		</div>
		</div>
	<!-- End Header ( Logo & Naviagtion ) -->
		
</header>
<!-- End Header -->



<!-- Start Content -->
<div id="content">
   <div class="container">
	
	<?php include "harga.php"; ?>

</div>
</div>
<!-- End Content -->

	<?php include "foother.php"; ?>

</div>
<!-- End Container -->

<!-- Go To Top Link -->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<div id="loader">
   <div class="spinner">
      <div class="dot1"></div>
      <div class="dot2"></div>
  </div>
</div>

<!-- Style Switcher -->
<div class="switcher-box">
   <a href="#" class="open-switcher show-switcher"><i class="fa fa-cog fa-2x"></i></a>
   <h4>Style Switcher</h4>
   <span>12 Predefined Color Skins</span>
   <ul class="colors-list">
     <li><a onClick="setActiveStyleSheet('blue'); return false;" title="Blue" class="blue"></a></li>
     <li><a onClick="setActiveStyleSheet('sky-blue'); return false;" title="Sky Blue" class="sky-blue"></a></li>
     <li><a onClick="setActiveStyleSheet('cyan'); return false;" title="Cyan" class="cyan"></a></li>
     <li><a onClick="setActiveStyleSheet('jade'); return false;" title="Jade" class="jade"></a></li>
     <li><a onClick="setActiveStyleSheet('green'); return false;" title="Green" class="green"></a></li>
     <li><a onClick="setActiveStyleSheet('purple'); return false;" title="Purple" class="purple"></a></li>
     <li><a onClick="setActiveStyleSheet('pink'); return false;" title="Pink" class="pink"></a></li>
     <li><a onClick="setActiveStyleSheet('red'); return false;" title="Red" class="red"></a></li>
     <li><a onClick="setActiveStyleSheet('orange'); return false;" title="Orange" class="orange"></a></li>
     <li><a onClick="setActiveStyleSheet('yellow'); return false;" title="Yellow" class="yellow"></a></li>
     <li><a onClick="setActiveStyleSheet('peach'); return false;" title="Peach" class="peach"></a></li>
     <li><a onClick="setActiveStyleSheet('beige'); return false;" title="Biege" class="beige"></a></li>
 </ul>
 <span>Top Bar Color</span>
 <select id="topbar-style" class="topbar-style">
     <option value="1">Light (Default)</option>
     <option value="2">Dark</option>
     <option value="3">Color</option>
 </select>
 <span>Layout Style</span>
 <select id="layout-style" class="layout-style">
     <option value="1">Wide</option>
     <option value="2">Boxed</option>
 </select>
 <span>Patterns for Boxed Version</span>
 <ul class="bg-list">
     <li><a href="#" class="bg1"></a></li>
     <li><a href="#" class="bg2"></a></li>
     <li><a href="#" class="bg3"></a></li>
     <li><a href="#" class="bg4"></a></li>
     <li><a href="#" class="bg5"></a></li>
     <li><a href="#" class="bg6"></a></li>
     <li><a href="#" class="bg7"></a></li>
     <li><a href="#" class="bg8"></a></li>
     <li><a href="#" class="bg9"></a></li>
     <li><a href="#" class="bg10"></a></li>
     <li><a href="#" class="bg11"></a></li>
     <li><a href="#" class="bg12"></a></li>
     <li><a href="#" class="bg13"></a></li>
     <li><a href="#" class="bg14"></a></li>
 </ul>
</div>

</body>
</html>