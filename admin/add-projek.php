<?php
require_once "include/header.php";
?>

<?php
require_once "include/header.php";
?>


<?php

$no_proErr = $id_depErr = $namaErr =  "";
$no_projek = $nama_projek = $id_departemen = $mulai_projek = $akhir_projek = $deskripsi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["mulai_projek"])) {
        $mulai_projek = "";
    } else {
        $mulai_projek = $_REQUEST["mulai_projek"];
    }

    if (empty($_REQUEST["akhir_projek"])) {
        $akhir_projek = "";
    } else {
        $akhir_projek = $_REQUEST["akhir_projek"];
    }

    if (empty($_REQUEST["nama_projek"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $nama_projek = $_REQUEST["nama_projek"];
    }

    if (empty($_REQUEST["id_departemen"])) {
        $id_depErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $id_departemen = $_REQUEST["id_departemen"];
    }

    if (empty($_REQUEST["no_projek"])) {
        $no_proErr = "<p style='color:red'> * ID is required</p> ";
    } else {
        $no_projek = $_REQUEST["no_projek"];
    }

    if (empty($_REQUEST["deskripsi"])) {
        $deskripsi = "";
    } else {
        $deskripsi = $_REQUEST["deskripsi"];
    }


    if (!empty($no_projek) && !empty($nama_projek) && !empty($id_departemen)) {

        // database connection
        require_once "../connection.php";

        $sql_select_query = "SELECT no_projek FROM projek WHERE no_projek = '$no_projek' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $idErr = "<p style='color:red'> * ID Already Register</p>";
        } else {

            $sql = "INSERT INTO projek ( no_projek, id_departemen, nama_projek , mulai_projek, akhir_projek, deskripsi ) VALUES( '$no_projek', '$id_departemen' , '$nama_projek' , '$mulai_projek' , ' $akhir_projek' , '$deskripsi' )  ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $no_projek = $nama_projek = $id_departemen = $mulai_projek = $akhir_projek = $deskripsi = "";
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-projek.php');
                            $('#linkBtn').text('View Projek');
                            $('#addMsg').text('Projek Added Successfully!');
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
                                <h4 class="text-center">Add New Projek</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Masukan No. Projek :</label>
                                        <input type="text" class="form-control" value="<?php echo $no_projek; ?>" name="no_projek">
                                        <?php echo $no_proErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Masukan ID Departemen :</label>
                                        <input type="text" class="form-control" value="<?php echo $id_departemen; ?>" name="id_departemen">
                                        <?php echo $id_depErr; ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Masukan Nama Projek :</label>
                                        <input type="text" class="form-control" value="<?php echo $nama_projek; ?>" name="nama_projek">
                                        <?php echo $namaErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Masa Mulai Projek :</label>
                                        <input type="date" class="form-control" value="<?php echo $mulai_projek; ?>" name="mulai_projek">

                                    </div>

                                    <div class="form-group">
                                        <label>Masa Akhir Projek :</label>
                                        <input type="date" class="form-control" value="<?php echo $akhir_projek; ?>" name="akhir_projek">

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