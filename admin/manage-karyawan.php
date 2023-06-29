<?php 
    require_once "include/header.php";
?>

<?php 
 
//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM karyawan";
$result = mysqli_query($conn , $sql);

$i = 1;
$you = "";


?>

<style>
table, th, td {
  border: 1px solid black;
  padding: 15px;
}
table {
  border-spacing: 10px;
}
</style>

<div class="bg-white shadow">
    <div class="py-4 px-4 mt-5 mb-5"> 
    <div class='text-center pb-2'><h4>Manage Karyawan</h4></div>
    <table style="width:100%" class="table-hover text-center ">
    <tr class="bg-dark">
        <th>No.</th>
        <th>ID karyawan</th>
        <th>ID jabatan</th> 
        <th>ID departemen</th>
        <th>Name</th>
        <th>Tanggal Lahir</th>
        <th>Gender</th>
        <th>No telepon</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php 
    
    if( mysqli_num_rows($result) > 0){
        while( $rows = mysqli_fetch_assoc($result) ){
            $id_karyawan = $rows["id_karyawan"];
            $nama_karyawan= $rows["nama_karyawan"];
            $email= $rows["email"];
            $id_jabatan= $rows["id_jabatan"];
            $id_departemen= $rows["id_departemen"];
            $tgl_lahir = $rows["tgl_lahir"];
            $gender = $rows["gender"];
            $no_telp = $rows["no_telp"];
            $alamat = $rows["alamat"];
            $username = $rows["username"];
            $password = $rows["password"];
            
            if($gender == "" ){
                $gender = "Not Defined";
            } 
           
            ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $id_karyawan; ?></td>
        <td><?php echo $id_jabatan; ?></td>
        <td><?php echo $id_departemen; ?></td>
        <td><?php echo $nama_karyawan ; ?></td>
        <td><?php echo $tgl_lahir; ?></td>
        <td><?php echo $gender; ?></td>
        <td><?php echo $no_telp; ?></td>
        <td><?php echo $email; ?></td>
        <td><?php echo $alamat; ?></td>
        <td><?php echo $username; ?></td>
        <td><?php echo $password; ?></td>
        
        <td><?php 
            $edit_icon = "<a href='edit-karyawan.php?id_karyawan= {$id_karyawan}' class='btn-sm btn-primary float-right ml-2 '> <span ><i class='fa fa-edit '></i></span> </a>";
            $delete_icon = " <a href='delete-karyawan.php?id_karyawan={$id_karyawan}' id='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
            echo $edit_icon . $delete_icon;
                ?> 
        </td>

      
        

    <?php 
            $i++;
            }
        }else{
        echo "no karyawan found";
        }
    ?>
            </tr>
        </table>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>