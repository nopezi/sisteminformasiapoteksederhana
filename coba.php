<?php include 'koneksi.php'; ?>

<label>Nama Obat</label>
<form action="" method="get" accept-charset="utf-8">

<select class="form-control" name="nama_obat" onchange="this.form.submit()">
<option>Pilih</option>
<?php 
$obat=mysqli_query($koneksi, "select distinct nama_obat from data_obat order by nama_obat desc");
while ($obt=mysqli_fetch_array($obat)) { ?>
<option value="<?=$obt['nama_obat']?>"><?=$obt['nama_obat']?></option>
<?php } ?>               
</select>

</form>


<?php 
if(isset($_GET['nama_obat'])){
	echo '<a class="btn" href="proxy.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>';
	echo "<h4> Data proxy  <a style='color:blue'> ". $_GET['nama_obat']."</a></h4>";
}
?>


<?php 
	if(isset($_GET['nama_obat'])){
		$nama_obat=mysqli_real_escape_string($koneksi, $_GET['nama_obat']);
		$brg=mysqli_query($koneksi, "select * from data_obat where nama_obat like '$nama_obat' order by nama_obat desc");

	$no=1;
	while($b=mysqli_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $b['harga_obat'] ?></td>
			<br>
		</tr>

		<?php 
	}}
	?>	


<?php // TAMPILKAN DATA BARANG DAN HARGA
$barang=mysqli_query($koneksi, "SELECT * FROM data_obat");
$jsArray = "var harga = new Array();\n"; 
?>


      <table>
      	<tr>
        	<td><label>Nama Obat</label></td>
        	<td>
        		<select name="nama_obat" onchange="changeValue(this.value)" >
		            <option>- Pilih -</option>
		            <?php if(mysqli_num_rows($barang)) {?>
		                <?php while($row_brg= mysqli_fetch_array($barang)) {?>
		                    <option value="<?php echo $row_brg["id_obat"]?>"> <?php echo $row_brg["nama_obat"]?> </option>
		                <?php $jsArray .= "harga['" . $row_brg['id_obat'] . "'] = {harga_obat:'" . addslashes($row_brg['harga_obat']) . "'};\n"; } ?>
		            <?php } ?>
		        </select>
        	</td>
        </tr>
        <tr>
        	<td><label>Harga</label></td>
	        <td><input type="text" class="form-control" name="harga_obat" id="harga_obat" value="0" readonly="readonly"></td>
	    </tr>
	  </table>

    <script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(id_obat) {
      document.getElementById("harga_obat").value = harga[id_obat].harga_obat;
    };
    </script> <!-- Tampilkan Harga berdasarkan kode barang -->