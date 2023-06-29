<?php
require_once "include/header.php";
?>

<?php
require_once "include/header.php";
?>


<?php

$idErr = $namaErr =  "";
$id_departemen = $nama_departemen = $lokasi = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_REQUEST["nama_departemen"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $nama_departemen = $_REQUEST["nama_departemen"];
    }

    if (empty($_REQUEST["id_departemen"])) {
        $idErr = "<p style='color:red'> * ID is required</p> ";
    } else {
        $id_departemen = $_REQUEST["id_departemen"];
    }

    if (empty($_REQUEST["lokasi"])) {
        $lokasi = "";
    } else {
        $lokasi = $_REQUEST["lokasi"];
    }


    if (!empty($id_departemen) && !empty($nama_departemen)) {

        // database connection
        require_once "../connection.php";

        $sql_select_query = "SELECT id_departemen FROM departemen WHERE id_departemen = '$id_departemen' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $idErr = "<p style='color:red'> * ID Already Register</p>";
        } else {

            $sql = "INSERT INTO departemen ( id_departemen, nama_departemen, lokasi ) VALUES( '$id_departemen' , '$nama_departemen' , '$lokasi' )  ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $id_departemen = $nama_departemen = $lokasi = "";
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-departemen.php');
                            $('#linkBtn').text('View Departemen');
                            $('#addMsg').text('Departemen Added Successfully!');
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
                                <h4 class="text-center">Add New Departemen</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Masukan ID Departemen :</label>
                                        <input type="text" class="form-control" value="<?php echo $id_departemen; ?>" name="id_departemen">
                                        <?php echo $idErr; ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Masukan Nama Departemen :</label>
                                        <input type="text" class="form-control" value="<?php echo $nama_departemen; ?>" name="nama_departemen">
                                        <?php echo $namaErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Lokasi :</label>
                                        <input type="text" class="form-control" value="<?php echo $lokasi; ?>" name="lokasi">

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