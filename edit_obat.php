<?php 
@session_start();
include 'koneksi.php';
if (@$_SESSION['admin']) {
	require_once 'header.php';

?>


<div class="container">

<?php  
$id = mysqli_real_escape_string($koneksi, $_GET['id_obat']);
$obat = mysqli_query($koneksi, "select * from data_obat where id_obat='$id'")or die(mysql_error());
while($d=mysqli_fetch_array($obat)){
    

?>
	
	<form action="aksi_edit_obat.php" method="post" accept-charset="utf-8">
	<table class="table table-hover">
	
		<tbody>
			<tr>
				<div class="form-group">
				<td>
					<input type="hidden" name="id_obat" value="<?php echo $d['id_obat'] ?>">
					<label>Nama Obat</label>
				</td>

	 			<td>
	 				<input style="width: 50%" type="nama_obat" name="nama_obat" class="form-control" value="<?=$d['nama_obat'] ?>">
	 			</td>
				</div>
			</tr>
			
			<tr>
				<div class="form-group">
				<td>
					<label>Harga Obat</label>			
				</td>
				<td>
	 				<table>
	 					<tr>
	 						<td>Rp.</td>
	 						<td>
	 							<input style="width: 50%" type="text" name="harga_obat" class="form-control" value="<?=$d['harga_obat'] ?>">
	 						</td>
	 					</tr>			
	 				</table>		
	 			</td>
				</div>
			</tr>

			<tr>
				<div class="form-group">
					<td>
						<label>Keterangan</label>
					</td>
					<td>
						<textarea class="form-control" name="keterangan"><?=$d['keterangan']?></textarea>
						
					</td>
				</div>
			</tr>

			<tr>
				<div class="form-group">
				<td></td>
				<td>
					<input type="submit" name="simpan" value="ganti" class="btn btn-primary">
					<a href="obat.php" class="btn btn-danger">Batal</a>		
	 			</td>
				</div>
			</tr>
		
		</tbody>
	</table>
		
	</form>

<?php } ?>

</div>


<?php 
require_once 'footer.php'; 
}else {
	header("location:index.php");
}
?>