<?php 
@session_start();
include 'koneksi.php';
if (@$_SESSION['admin']) {
	require_once 'header.php';

?>


<div class="container">

<?php  
$id = mysqli_real_escape_string($koneksi, $_GET['id_pegawai']);
$pegawai = mysqli_query($koneksi, "select * from data_pegawai where id_pegawai='$id'")or die(mysql_error());
while($d=mysqli_fetch_array($pegawai)){
    

?>
	
	<form name="postform" action="aksi_edit_pegawai.php" method="post" accept-charset="utf-8">
	<table class="table table-hover" id="table">
	
		<tbody>
			<tr>
				<div class="form-group">
				<td>
					<input type="hidden" name="id_pegawai" value="<?php echo $d['id_pegawai'] ?>">
					<label>Nama Pegawai</label>
				</td>

	 			<td>
	 				<input style="width: 20%" type="text" name="nama_pegawai" class="form-control" value="<?=$d['nama_pegawai'] ?>">
	 			</td>
				</div>
			</tr>

			<tr>
				<td>
				<div class="form-group">
					<label>Jenis Kelamin</label>	
				
				</td>

				<td>
					<select style="width: 20%" class="form-control" name="jk">
						<option>Pilih</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</td>
				</div>
			</tr>
			
			<tr>
				<div class="form-group">
				<td>
					<label>alamat</label>			
				</td>
				<td>
				<input style="width: 70%" type="text" name="alamat" class="form-control" value="<?=$d['alamat'] ?>">		
	 			</td>
				</div>
			</tr>

			<tr>
				<div class="form-group">
				<td>
					<label>Tanggal Lahir</label>
				</td>

				<td>
					<input style="width: 20%" class="form-control" type="text" id="from" name="tgl_lhr" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.from);return false;" value="<?=$d['tgl_lhr']?>" />

								<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.from);return false;"><img name="popcal" align="absmiddle" style="border:none" src="calender/calender.jpeg" width="34" height="29" border="0" alt=""></a>
						<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
				</td>	
				</div>
			</tr>

			<tr>
				<div class="form-group">
				<td></td>
				<td>
					<input type="submit" name="simpan" value="ganti" class="btn btn-primary">
					<a href="pegawai.php" class="btn btn-danger">Batal</a>		
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