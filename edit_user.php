<?php 

    @session_start();

    include "koneksi.php";

    if (@$_SESSION['admin']) {     
 ?>

<?php require_once 'header.php'; ?>
<style type="text/css" media="screen">

/** 
Css validasi
**/
.error{color:red;}
label.error {margin-top:6px;}
input.error {border-color:red;}
</style>

<script>
    $("#form-registrasi").validate();
</script>
<div class="container">
<div class="panel panel-success" style="padding-top: 10px">


<div class="panel-body">
    
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit User</h3>
<?php
$id=mysqli_real_escape_string($koneksi, $_GET['id']);
$det=mysqli_query($koneksi, "select * from admin where id='$id'")or die(mysql_error());
while($d=mysqli_fetch_array($det)){
?>

    <form action="update_user.php" method="post">
        <table class="table">
            <tr>
                <td></td>
                <td><input type="hidden" name="id" value="<?php echo $d['id'] ?>"></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" class="form-control" name="username" value="<?php echo $d['username'] ?>" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" class="form-control" name="password" value="<?php echo $d['password'] ?>" required></td>
            </tr>
            <tr>
                <input type="hidden" name="level" value="<?php echo $d['level'] ?>">
            </tr>
            
            <tr>
                <td></td>
                <td><input type="submit" class="btn btn-info" value="Simpan"></td>
            </tr>
        </table>
    </form>

<?php  } ?>     

</div>


        
</div>
</div>
<?php require_once 'footer.php';  ?>
<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
<?php 
}else{
        header("location:index.php");
}
?>
