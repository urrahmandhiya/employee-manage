<?php 
    require_once "include/header.php";
?>
    
    <?php
    require_once "include/header.php";
?>


<?php

$idErr = $id_jabErr = $id_depErr = $namaErr = $tgl_lahirErr = $genderErr = $no_telpErr = $emailErr = $alamatErr = $userErr = $passErr = "";
$id_karyawan = $id_jabatan = $id_departemen = $nama_karyawan = $tgl_lahir = $gender = $no_telp = $email = $alamat = $username = $password = "";

if( $_SERVER["REQUEST_METHOD"] == "POST" ){

    if( empty($_REQUEST["id_karyawan"]) ){
        $idErr = "<p style='color:red'> * ID is required</p>";
    }else {
        $id_karyawan = $_REQUEST["id_karyawan"];
    }

    if ( empty($_REQUEST["id_jabatan"])
    ) {
        $id_jabErr = "<p style='color:red'> * Position ID is required</p> ";
    } else {
        $id_jabatan = $_REQUEST["id_jabatan"];
    }

    if ( empty($_REQUEST["id_departemen"])
    ) {
        $id_depErr = "<p style='color:red'> * Departemen ID is required</p> ";
    } else {
        $id_departemen = $_REQUEST["id_departemen"];
    }

    if (empty($_REQUEST["nama_karyawan"])
    ) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $nama_karyawan = $_REQUEST["nama_karyawan"];
    }

    if ( empty($_REQUEST["tgl_lahir"])
    ) {
        $tgl_lahirErr = "<p style='color:red'> * Tanggal Lahir is required</p>";
    } else {
        $tgl_lahir = $_REQUEST["tgl_lahir"];
    }

    if (empty($_REQUEST["gender"])) {
        $genderErr = "<p style='color:red'> * Gender is required</p>";
    } else {
        $gender = $_REQUEST["gender"];
    }

    if( empty($_REQUEST["no_telp"]) ){
        $no_telpErr = "<p style='color:red'> * Phone number is required</p>";
    }else {
        $no_telp = $_REQUEST["no_telp"];
    }

    if (empty($_REQUEST["email"])) {
        $emailErr = "<p style='color:red'> * Email is required</p>";
    } else {
        $email = $_REQUEST["email"];
    }

    if ( empty($_REQUEST["alamat"]) ){
        $alamatErr = "<p style='color:red'> * Alamat is required</p>";
    }else {
        $alamat = $_REQUEST["alamat"];
    }

    if ( empty($_REQUEST["username"]) ){
        $userErr = "<p style='color:red'> * Username is required</p>";
    }else {
        $username = $_REQUEST["username"];
    }

    if (empty($_REQUEST["password"])) {
        $passErr = "<p style='color:red'> * Password is required</p>";
    } else {
        $password = $_REQUEST["password"];
    }

        if( !empty($id_karyawan) && !empty($nama_karyawan) && !empty($id_jabatan) && !empty($id_departemen) ){

            // database connection
            require_once "../connection.php";

            $sql_select_query = "SELECT id_karyawan FROM karyawan WHERE id_karyawan = '$id_karyawan' ";
            $r = mysqli_query($conn , $sql_select_query);

            if( mysqli_num_rows($r) > 0 ){
            $idErr = "<p style='color:red'> * ID Already Register</p>";
            } else {
                $sql = "INSERT INTO karyawan( id_karyawan , id_jabatan , id_departemen , nama_karyawan , tgl_lahir , gender , no_telp , email , alamat , username , password ) VALUES( '$id_karyawan' , '$id_jabatan' , '$id_departemen' , '$nama_karyawan' , '$tgl_lahir' , '$gender', '$no_telp', '$email', '$alamat', '$username', '$password' )  ";
                $result = mysqli_query($conn , $sql);
                if($result){
                    $id_karyawan = $id_jabatan = $id_departemen = $nama_karyawan = $tgl_lahir = $gender = $no_telp = $email = $alamat = $username = $password = "";
                    echo "<script>
                    $(document).ready( function(){
                        $('#showModal').modal('show');
                        $('#modalHead').hide();
                        $('#linkBtn').attr('href', 'manage-karyawan.php');
                        $('#linkBtn').text('View Karyawan');
                        $('#addMsg').text('Karyawan Added Successfully!');
                        $('#closeBtn').text('Add More?');
                    })
                    </script>
                    ";
                }
            }

        
        }
    }

?>



<div style=""> 
<div class="login-form-bg h-100">
        <div class="container mt-5 h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5 shadow">                       
                                    <h4 class="text-center">Tambahkan Karyawan Baru</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                            
                                <div class="form-group">
                                    <label >ID karyawan :</label>
                                    <input type="text" class="form-control" value="<?php echo $id_karyawan; ?>"  name="id_karyawan" >
                                   <?php echo $idErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >ID jabatan :</label>
                                    <input type="text" class="form-control" value="<?php echo $id_jabatan; ?>"  name="id_jabatan" >     
                                    <?php echo $id_jabErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >ID departemen: </label>
                                    <input type="text" class="form-control" value="<?php echo $id_departemen; ?>" name="id_departemen" > 
                                    <?php echo $id_depErr; ?>           
                                </div>
                                
                                <div class="form-group">
                                    <label >Full Name :</label>
                                    <input type="text" class="form-control" value="<?php echo $nama_karyawan; ?>"  name="nama_karyawan" >
                                   <?php echo $namaErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Date-of-Birth :</label>
                                    <input type="date" class="form-control" value="<?php echo $tgl_lahir; ?>" name="tgl_lahir" >  
                                   
                                </div>

                                <div class="form-group form-check form-check-inline">
                                    <label class="form-check-label" >Gender :</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "PRIA" ){ echo "checked"; } ?>  value="PRIA"  selected>
                                    <label class="form-check-label" >PRIA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "WANITA" ){ echo "checked"; } ?>  value="WANITA">
                                    <label class="form-check-label" >WANITA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" <?php if($gender == "LAINNYA" ){ echo "checked"; } ?>  value="LAINNYA">
                                    <label class="form-check-label" >LAINNYA</label>
                                </div>
                    
                                <div class="form-group">
                                    <label >No. Telephone :</label>
                                    <input type="text" class="form-control" value="<?php echo $no_telp; ?>"  name="no_telp" >
                                   <?php echo $no_telpErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Email :</label>
                                    <input type="email" class="form-control" value="<?php echo $email; ?>"  name="email" >     
                                    <?php echo $emailErr; ?>
                                </div>

                                 <div class="form-group">
                                    <label >Alamat :</label>
                                    <input type="text" class="form-control" value="<?php echo $alamat; ?>"  name="alamat" >     
                                    <?php echo $alamatErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Username :</label>
                                    <input type="text" class="form-control" value="<?php echo $username; ?>"  name="username" >     
                                    <?php echo $userErr; ?>
                                </div>

                                <div class="form-group">
                                    <label >Password: </label>
                                    <input type="password" class="form-control" value="<?php echo $password; ?>" name="password" > 
                                    <?php echo $passErr; ?>           
                                </div>

                                <br>

                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    require_once "include/footer.php";
?>


<?php 
    require_once "include/footer.php";
?>