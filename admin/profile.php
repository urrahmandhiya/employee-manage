<?php 

require_once "include/header.php";
?>
 <?php  
    


    // databaseconnection
    require_once "../connection.php";

    $sql_command = "SELECT * FROM karyawan WHERE email = '$_SESSION[email]' ";
    $result = mysqli_query($conn , $sql_command);

    if( mysqli_num_rows($result) > 0){
       while( $rows = mysqli_fetch_assoc($result) ){
           $nama_karyawan = ucwords($rows["nama_karyawan"]);
           $username = ucwords($rows["username"]);
           $email = ucwords($rows["email"]);
           $gender = ucwords($rows["gender"]);
           $tgl_lahir= $rows["tgl_lahir"];
       }

       if( empty($gender)){
           $gender = "Not Defined";
       }

       if( empty($tgl_lahir)){
            $tgl_lahir = "Not Defined";
        }
}
 ?>


<div class=container>
    <div class="row ">
        <div class="col-4 ">
        </div>
        <div class="col-12 col-lg-6 col-md-6">
            <div class="card shadow" style="width: 20rem;">
            <img src="upload/<?php if(!empty($gender == "WANITA")){ echo "w1.jpg"; } elseif(!empty($gender == "PRIA")){ echo "p1.jpg"; }else{ echo "l1.jpg"; } ?>" class="rounded img-fluid  card-img-top"  style="height: 300px "  alt="...">
                <div class="card-body">
                <h2 class="text-center mb-4"><?php echo $username; ?> </h2>
                    <p class="card-text">Nama Karyawan : <?php echo $nama_karyawan ?> </p>
                    <p class="card-text">Email: <?php echo $_SESSION["email"] ?> </p>
                    <p class="card-text">Gender: <?php echo $gender ?> </p>
                    <p class="card-text">Tanggal Lahir: <?php echo $tgl_lahir ?> </p>
                    <p class="card-text">Umur: <?php if( $tgl_lahir != "Not Defined"){  
                                                    $date1=date_create($tgl_lahir);
                                                    $date2=date_create("now");
                                                    $diff=date_diff($date1,$date2);
                                                    echo $diff->format("%y Tahun"); }?> 
                    </p>
                    
                    <p class="text-center">
                    <a href="edit-profile.php" class="btn btn-outline-primary">Edit Profile</a>
                    <a href="change-password.php" class="btn btn-outline-primary">Change Password</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once "include/footer.php";
?>