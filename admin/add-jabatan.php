<?php
require_once "include/header.php";
?>

<?php
require_once "include/header.php";
?>


<?php

$idErr = $namaErr =  "";
$id_jabatan = $nama_jabatan = $awal_jabatan = $akhir_jabatan = $deskripsi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["awal_jabatan"])) {
        $awal_jabatan = "";
    } else {
        $awal_jabatan = $_REQUEST["awal_jabatan"];
    }

    if (empty($_REQUEST["akhir_jabatan"])) {
        $akhir_jabatan = "";
    } else {
        $akhir_jabatan = $_REQUEST["akhir_jabatan"];
    }

    if (empty($_REQUEST["nama_jabatan"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $nama_jabatan = $_REQUEST["nama_jabatan"];
    }

    if (empty($_REQUEST["id_jabatan"])) {
        $idErr = "<p style='color:red'> * ID is required</p> ";
    } else {
        $id_jabatan = $_REQUEST["id_jabatan"];
    }

    if (empty($_REQUEST["deskripsi"])) {
        $deskripsi = "";
    } else {
        $deskripsi = $_REQUEST["deskripsi"];
    }


    if (!empty($id_jabatan) && !empty($nama_jabatan)) {

        // database connection
        require_once "../connection.php";

        $sql_select_query = "SELECT id_jabatan FROM jabatan WHERE id_jabatan = '$id_jabatan' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $idErr = "<p style='color:red'> * ID Already Register</p>";
        } else {

            $sql = "INSERT INTO jabatan ( id_jabatan, nama_jabatan , awal_jabatan, akhir_jabatan, deskripsi ) VALUES( '$id_jabatan' , '$nama_jabatan' , '$awal_jabatan' , ' $akhir_jabatan' , '$deskripsi' )  ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $id_jabatan = $nama_jabatan = $awal_jabatan = $akhir_jabatan = $deskripsi = "";
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-jabatan.php');
                            $('#linkBtn').text('View Jabatan');
                            $('#addMsg').text('Jabatan Added Successfully!');
                            $('#closeBtn').text('Add More ?');
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
                                <h4 class="text-center">Add New Jabatan</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Masukan ID Jabatan :</label>
                                        <input type="text" class="form-control" value="<?php echo $id_jabatan; ?>" name="id_jabatan">
                                        <?php echo $idErr; ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Masukan Nama Jabatan :</label>
                                        <input type="text" class="form-control" value="<?php echo $nama_jabatan; ?>" name="nama_jabatan">
                                        <?php echo $namaErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Masa Awal Jabatan :</label>
                                        <input type="date" class="form-control" value="<?php echo $awal_jabatan; ?>" name="awal_jabatan">

                                    </div>

                                    <div class="form-group">
                                        <label>Masa Akhir Jabatan :</label>
                                        <input type="date" class="form-control" value="<?php echo $akhir_jabatan; ?>" name="akhir_jabatan">

                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi :</label>
                                        <input type="text" class="form-control" value="<?php echo $deskripsi; ?>" name="deskripsi">

                                    </div>


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