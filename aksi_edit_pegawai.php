<?php 
include 'koneksi.php';
$id = $_POST['id_pegawai'];
$nama_pegawai = $_POST['nama_pegawai'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$tgl_lhr = $_POST['tgl_lhr'];

if($nama_pegawai == "" || $jk == "" || $alamat == "" || $tgl_lhr == ""){
	echo '<script language="javascript">alert("Isi Semua Data"); document.location="edit_pegawai.php?id_pegawai='.$id.'";</script>';
}else{
mysqli_query($koneksi, "update data_pegawai set 
						nama_pegawai='$nama_pegawai',
						jk='$jk',
						alamat='$alamat',
						tgl_lhr='$tgl_lhr'
						where id_pegawai='$id'");
header("location:pegawai.php");
}
 ?>