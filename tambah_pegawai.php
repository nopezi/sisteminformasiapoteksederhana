<?php 
include 'koneksi.php';
$id = $_POST['id_pegawai'];
$nama_pegawai = $_POST['nama_pegawai'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$tgl_lhr = $_POST['tgl_lhr'];


if($nama_pegawai == "" || $jk == "" || $alamat == "" || $tgl_lhr == ""){
	echo '<script language="javascript">alert("Isi Semua Data"); document.location="pegawai.php"</script>';
}else{
mysqli_query($koneksi, "insert into data_pegawai values('$id', '$nama_pegawai', '$jk', '$alamat', '$tgl_lhr')");
header("location:pegawai.php");
}
 ?>