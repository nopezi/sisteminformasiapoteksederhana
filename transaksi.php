<?php 
@session_start();
include 'koneksi.php';
if (@$_SESSION['admin']) {
    require_once 'header.php';

?>

<div class="container">
    <h2>Data Transaksi</h2>
    <button style="margin-bottom: 10px" data-toggle="modal" data-target="#myModal" type="button" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Tambah Data</button>

    <table id="example" class="table table-hover table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Nama Obat</th>
                <th>harga Obat Satuan</th>
                <th>Jumlah Obat</th>
                <th>Total Pembayaran</th>
                <th>Alamat Pembeli</th>
                <th>Setting</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $transaksi=mysqli_query($koneksi, "select * from data_transaksi");
        $no = 1;
        while ($trs=mysqli_fetch_array($transaksi)) {
            
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $trs['nama_pelanggan'] ?></td>
                <td><?php echo $trs['nama_obat'] ?></td>
                <td>Rp.<?=number_format($trs['harga_obat'])?></td>
                <td><?=$trs['jumlah_obat']?></td>
                <td><?php 
                    $total = $trs['harga_obat'] * $trs['jumlah_obat']; 
                    echo 'Rp.'.number_format($total);
                ?></td>
                <td><?=$trs['alamat']?></td>
                <td>
                    <a href="edit_transaksi.php?id_transaksi=<?php echo $trs['id_transaksi']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a onclick="if(confirm('Yakin Mau Hapus Data Ini ?')){location.href='hapus_transaksi.php?id_transaksi=<?php echo $trs['id_transaksi'];?>'}" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        <?php } ?>    
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Nama Obat</th>
                <th>Harga Obat Satuan</th>
                <th>Jumlah Obat</th>
                <th>Total Pembayaran</th>
                <th>Alamat Pembeli</th>
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
                <h4 class="modal-title">Tambah Data Transaksi</h4>
            </div>
            <div class="modal-body">
                <form name="postform" action="tambah_transaksi.php" method="post">
                    <div class="form-group">
                        <label>Nama Pembeli</label>
                        <input type="text" name="nama_pelanggan" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                    <?php // TAMPILKAN DATA BARANG DAN HARGA
                    $barang=mysqli_query($koneksi, "SELECT * FROM data_obat");
                    $jsArray = "var harga = new Array();\n"; 
                    ?>    
                        
                    <label>Nama Obat</label>
                    <select class="form-control" name="nama_obat" onchange="changeValue(this.value)" >
                    <option>- Pilih -</option>
                    <?php if(mysqli_num_rows($barang)) {?>
                        <?php while($row_brg= mysqli_fetch_array($barang)) {?>
                            <option value="<?php echo $row_brg["nama_obat"]?>"> <?php echo $row_brg["nama_obat"]?> </option>
                        <?php $jsArray .= "harga['" . $row_brg['nama_obat'] . "'] = {harga_obat:'" . addslashes($row_brg['harga_obat']) . "'};\n"; } ?>
                    <?php } ?>
                    </select>
                    </div>

                    <div class="form-group">

                        <label>Harga Obat (Rp)</label>
                        
                        <input type="text" name="harga_obat" class="form-control" id="harga_obat" readonly="readonly">
                        <script type="text/javascript">
                    <?php echo $jsArray; ?>
                    function changeValue(nama_obat) {
                    document.getElementById("harga_obat").value = harga[nama_obat].harga_obat;
                    };
                    </script> <!-- Tampilkan Harga berdasarkan kode barang -->
                    </div>

                    

                    <div class="form-group">
                        <label>Jumlah Obat</label>
                        <input type="text" name="jumlah_obat" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Alamat Pembeli</label>
                        <input type="text" name="alamat" class="form-control">
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