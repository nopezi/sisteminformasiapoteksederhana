<?php 
@session_start();
include 'koneksi.php';
if (@$_SESSION['admin']) {
	require_once 'header.php';

?>


      <!-- Main component for a primary marketing message or call to action -->
<div class="container">
      	<div class="jumbotron" style="text-align: center;">
<?php require_once 'koneksi.php';
                $id = $_SESSION['admin']; 
                $admin = mysqli_query($koneksi, "select * from admin where id ='$id'");
                while($u = mysqli_fetch_assoc($admin)) {
                     
                  ?>
                   		
        <h2><small>selamat datang</small> <?php echo $u['username'] ?></h2>
        <h2>Di halaman aplikasi sederhana transaksi apotek</h2>


<?php } ?>        
      	</div>
</div>


<?php 
require_once 'footer.php'; 
}else {
	header("location:index.php");
}
?>