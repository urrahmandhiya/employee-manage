<?php
require_once "include/header.php";
?>

<?php
require_once "include/header.php";
?>


<?php

$idErr = $no_proErr =  "";
$id_karyawan = $no_projek = $gaji = $jam_kerja = $status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_REQUEST["id_karyawan"])) {
        $idErr = "<p style='color:red'> * Id is required</p>";
        $id_karyawan = "";
    } else {
        $id_karyawan = $_REQUEST["id_karyawan"];
    }

    if (empty($_REQUEST["no_projek"])) {
        $no_proErr = "<p style='color:red'> * No. Projek is required</p>";
        $no_projek = "";
    } else {
        $no_projek = $_REQUEST["no_projek"];
    }

    if (empty($_REQUEST["gaji"])) {
        $gaji = "";
    } else {
        $gaji = $_REQUEST["gaji"];
    }

    if (empty($_REQUEST["jam_kerja"])) {
        $jam_kerja = "";
    } else {
        $jam_kerja = $_REQUEST["jam_kerja"];
    }

    if (empty($_REQUEST["status"])) {
        $status = "";
    } else {
        $status = $_REQUEST["status"];
    }


    if (!empty($id_karyawan) && !empty($no_projek)) {

        // database connection
        require_once "../connection.php";

        $sql_select_query = ("
        SELECT karyawan.id_karyawan, projek.no_projek
        FROM bekerja
        INNER JOIN karyawan ON karyawan.id_karyawan = bekerja.id_karyawan
        INNER JOIN projek ON projek.no_projek = bekerja.no_projek
        
    ");
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "INSERT INTO bekerja (id_karyawan, no_projek, gaji, jam_kerja, status) VALUES( '$id_karyawan' , '$no_projek' , '$gaji', '$jam_kerja', '$status' )  ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $id_karyawan = $no_projek = $gaji = $jam_kerja = $status = "";
                echo "<script>
                    $(document).ready( function(){
                        $('#showModal').modal('show');
                        $('#modalHead').hide();
                        $('#linkBtn').attr('href', 'dashboard.php');
                        $('#linkBtn').text('View bekerja');
                        $('#addMsg').text('Bekerja Added Successfully!');
                        $('#closeBtn').text('Edit Again ?');
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
                                <h4 class="text-center">Add Bekerja Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">


                                    <div class="form-group">
                                        <label>Masukan Id Karyawan :</label>
                                        <input type="text" class="form-control" value="<?php echo $id_karyawan; ?>" name="id_karyawan">
                                        <?php echo $idErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>No Projek :</label>
                                        <input type="text" class="form-control" value="<?php echo $no_projek; ?>" name="no_projek">
                                        <?php echo $no_proErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Gaji :</label>
                                        <input type="text" class="form-control" value="<?php echo $gaji; ?>" name="gaji">

                                    </div>

                                    <div class="form-group">
                                        <label>Jam Kerja :</label>
                                        <input type="time" class="form-control" value="<?php echo $jam_kerja; ?>" name="jam_kerja">

                                    </div>

                                    <div class="form-group">
                                        <label>Status :</label>
                                        <input type="text" class="form-control" value="<?php echo $status; ?>" name="status">

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