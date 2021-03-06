<?php 
@session_start();
include 'koneksi.php';
if (@$_SESSION['admin']) {
	require_once 'header.php';

?>


<div class="container">
	
	<button style="margin-bottom: 10px" data-toggle="modal" data-target="#myModal" type="button" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Tambah Data</button>

	<table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Setting</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $pegawai=mysqli_query($koneksi, "select * from data_pegawai");
        $no = 1;
        while ($pgw=mysqli_fetch_array($pegawai)) {
            
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $pgw['nama_pegawai'] ?></td>
                <td><?php echo $pgw['jk'] ?></td>
                <td><?=$pgw['alamat']?></td>
                <td><?=$pgw['tgl_lhr']?></td>
                <td>
                	<a href="edit_pegawai.php?id_pegawai=<?php echo $pgw['id_pegawai']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                	<a onclick="if(confirm('Yakin Mau Hapus Data Ini ?')){location.href='hapus_pegawai.php?id_pegawai=<?php echo $pgw['id_pegawai'];?>'}" class="btn btn-danger">
                		<span class="glyphicon glyphicon-trash"></span>
                	</a>
                </td>
            </tr>
        <?php } ?>    
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama pegawai</th>
                <th>Jenis Kelamin</th>
                <th>alamat</th>
                <th>Tanggal Lahir</th>
                <th>Setting</th>
            </tr>
        </tfoot>
    </table>
<script type="text/javascript">
	
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<!-- MODAL KOLOM -->

<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Pegawai</h4>
			</div>
			<div class="modal-body">
				<form name="postform" action="tambah_pegawai.php" method="post">
					<div class="form-group">
						<label>Nama Pegawai</label>
						<input type="text" name="nama_pegawai" class="form-control" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select class="form-control" name="jk">
							<option>Pilih</option>
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>

					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" class="form-control">
					</div>

					<div class="form-group">
						<label>Tanggal Lahir</label>

						<input class="form-control" type="text" id="from" name="tgl_lhr" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.from);return false;"/>

								<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.from);return false;"><img name="popcal" align="absmiddle" style="border:none" src="calender/calender.jpeg" width="34" height="29" border="0" alt=""></a>
						<iframe class="from-control" width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; margin-top:-88px; margin-left:-300px;"></iframe>
							
						
					</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<input type="reset" class="btn btn-danger" value="reset">
				<input type="submit" class="btn btn-primary" value="Simpan">
			</div>
				</form>
		</div>
	</div>
</div>

</div>

<?php 
require_once 'footer.php'; 
}else {
	header("location:index.php");
}
?>