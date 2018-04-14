<?php
defined("BASEPATH") or exit(header("location: adminpanel.php?page=home"));

if($_SESSION['leveluser']=="admin"){
	
function filcarm($data=""){
	$d = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $d;
}

$page = isset($_GET['page'])? filcarm($_GET['page']):"home";

?>

					<!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        <br><br><br><br>
							<?php
								$aktif = $page=="home"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=home" class="waves-effect <?php echo $aktif;?>"><i class="icon-grid"></i><span> Dashboard </span> </a>
                            </li>
							
							<?php
								if($page =="kategori" or $page =="pekerjaan") 
									$aktif = "active";
								else
									$aktif = "";
							?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php echo $aktif;?>"><i class="icon-list"></i> <span> Ref. Data </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
									<li <?php if($page == "pekerjaan") echo "class='active'"; ?>><a href="adminpanel.php?page=pekerjaan"> Data Pekerjaan</a></li>
                                    <li <?php if($page == "kategori") echo "class='active'"; ?>><a href="adminpanel.php?page=kategori"> Data Kategori</a></li>  
                                </ul>
                            </li>
							
							<?php
								if($page =="toko" or $page =="karyawan") 
									$aktif = "active";
								else
									$aktif = "";
							?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php echo $aktif;?>"><i class="icon-screen-tablet"></i> <span> Data Master </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
									<li <?php if($page == "toko") echo "class='active'"; ?>><a href="adminpanel.php?page=toko"> Data Toko</a></li>
									<li <?php if($page == "karyawan") echo "class='active'"; ?>><a href="adminpanel.php?page=karyawan"> Data Karyawan</a></li>
                                </ul>
                            </li>
							
							<?php
								$aktif = $page=="menu"? "active":"";
							?>
							<li class="has_sub">
                                <a href="adminpanel.php?page=menu" class="waves-effect <?php echo $aktif;?>"><i class="icon-book-open"></i><span> Data Menu </span> </a>
                            </li>
							
							<!--
							<?php
								//$aktif = $page=="vo"? "active":"";
							?>
							<li class="has_sub">
                                <a href="adminpanel.php?page=vo" class="waves-effect <?php echo $aktif;?>"><i class="icon-credit-card"></i><span> Voucher </span> </a>
                            </li>-->
							
							<?php
								if($page =="tkeluar" or $page =="tmasuk" or $page =="ttagihan") 
									$aktif = "active";
								else
									$aktif = "";
							?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php echo $aktif;?>"><i class="icon-basket"></i> <span> Transaksi </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li <?php if($page == "ttagihan") echo "class='active'"; ?>><a href="adminpanel.php?page=ttagihan"> Transaksi Tagihan</a></li>
                                    <li <?php if($page == "tkeluar") echo "class='active'"; ?>><a href="adminpanel.php?page=tkeluar"> Transaksi Pembelian</a></li>
                                    <li <?php if($page == "tmasuk") echo "class='active'"; ?>><a href="adminpanel.php?page=tmasuk"> Transaksi Penjualan</a></li>
                                </ul>
                            </li>
							
							<?php
								$aktif = $page=="gaji"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=gaji" class="waves-effect <?php echo $aktif;?>"><i class="fa fa-money"></i><span> Gaji Karyawan</span> </a>
                            </li>
							
							<?php
								$aktif = $page=="pendapatan"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=pendapatan" class="waves-effect <?php echo $aktif;?>"><i class="icon-wallet"></i><span> Pendapatan</span> </a>
                            </li>
							
							<?php
								if($page =="ltm" or $page =="ltk" or $page =="lg" or $page =="ltt") 
									$aktif = "active";
								else
									$aktif = "";
							?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php echo $aktif;?>"><i class="icon-doc"></i> <span> Laporan </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li <?php if($page == "ltt") echo "class='active'"; ?>><a href="adminpanel.php?page=ltt"> Laporan Tagihan</a></li>
                                    <li <?php if($page == "ltk") echo "class='active'"; ?>><a href="adminpanel.php?page=ltk"> Laporan Pembelian</a></li>
                                    <li <?php if($page == "ltm") echo "class='active'"; ?>><a href="adminpanel.php?page=ltm"> Laporan Penjualan</a></li>
                                    <li <?php if($page == "lg") echo "class='active'"; ?>><a href="adminpanel.php?page=lg"> Laporan Gaji</a></li>
                                </ul>
                            </li>
							
							<?php
								$aktif = $page=="user"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=user" class="waves-effect <?php echo $aktif;?>"><i class="icon-user"></i><span> Users </span> </a>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
					
<?php
}
?>

<?php
if($_SESSION['leveluser']=="karyawan"){
	
function filcarm($data=""){
	$d = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $d;
}

$page = isset($_GET['page'])? filcarm($_GET['page']):"home";

?>

					<!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        <br><br><br><br>
							<?php
								$aktif = $page=="home"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=home" class="waves-effect <?php echo $aktif;?>"><i class="icon-grid"></i><span> Dashboard </span> </a>
                            </li>
							
							<?php
								if($page =="tkeluar" or $page =="tmasuk") 
									$aktif = "active";
								else
									$aktif = "";
							?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect <?php echo $aktif;?>"><i class="icon-basket"></i> <span> Transaksi </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li <?php if($page == "tkeluar") echo "class='active'"; ?>><a href="adminpanel.php?page=tkeluar"> Transaksi Pembelian</a></li>
                                    <li <?php if($page == "tmasuk") echo "class='active'"; ?>><a href="adminpanel.php?page=tmasuk"> Transaksi Penjualan</a></li>
                                </ul>
                            </li>
							
							<?php
								$aktif = $page=="pendapatan"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=pendapatan" class="waves-effect <?php echo $aktif;?>"><i class="icon-wallet"></i><span> Pendapatan</span> </a>
                            </li>
							
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
					
<?php
}
?>

<?php
if($_SESSION['leveluser']=="website"){
	
function filcarm($data=""){
	$d = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $d;
}

$page = isset($_GET['page'])? filcarm($_GET['page']):"home";

?>

					<!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        <br><br><br><br>
							<?php
								$aktif = $page=="ks"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=ks" class="waves-effect <?php echo $aktif;?>"><i class="icon-home"></i><span> Kata Sambutan</span> </a>
                            </li>
							
							<?php
								$aktif = $page=="galery"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=galery" class="waves-effect <?php echo $aktif;?>"><i class="icon-picture"></i><span> Galery</span> </a>
                            </li>
							
							<?php
								$aktif = $page=="slider"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=slider" class="waves-effect <?php echo $aktif;?>"><i class="icon-list"></i><span> Slider</span> </a>
                            </li>
							
							<?php
								$aktif = $page=="partner"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=partner" class="waves-effect <?php echo $aktif;?>"><i class="icon-user-follow"></i><span> Partner</span> </a>
                            </li>
							
							<?php
								$aktif = $page=="berita"? "active":"";
							?>
                            <li class="has_sub">
                                <a href="adminpanel.php?page=berita" class="waves-effect <?php echo $aktif;?>"><i class="icon-book-open"></i><span> Berita</span> </a>
                            </li>
							
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
					
<?php
}
?>