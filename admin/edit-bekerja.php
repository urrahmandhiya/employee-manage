<?php
require_once "include/header.php";
?>


<?php


$id_karyawan = $_GET["id_karyawan"];
require_once "../connection.php";

$sql = "SELECT * FROM bekerja WHERE id_karyawan = $id_karyawan ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($rows = mysqli_fetch_assoc($result)) {
        $id_karyawan = $rows["id_karyawan"];
        $no_projek = $rows["no_projek"];
        $gaji = $rows["gaji"];
        $jam_kerja = $rows["jam_kerja"];
        $status = $rows["status"];
    }
}


$id_karyawanErr = $no_projekErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["id_karyawan"])) {
        $id_karyawanErr = "<p style='color:red'> * Id is required</p>";
        $id_karyawan = "";
    } else {
        $id_karyawan = $_REQUEST["id_karyawan"];
    }

    if (empty($_REQUEST["no_projek"])) {
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
        $sql_select_query = "SELECT id_karyawan FROM bekerja WHERE id_karyawan = '$id_karyawan' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "UPDATE bekerja SET id_karyawan = '$id_karyawan', no_projek = '$no_projek', gaji = '$gaji', jam_kerja = '$jam_kerja', status = '$status'  WHERE id_karyawan = $_GET[id_karyawan] ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'dashboard.php');
                            $('#linkBtn').text('View bekerja');
                            $('#addMsg').text('Bekerja Edit Successfully!');
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
                                <h4 class="text-center">Edit Bekerja Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">


                                    <div class="form-group">
                                        <label>Masukan Id Karyawan :</label>
                                        <input type="text" class="form-control" value="<?php echo $id_karyawan; ?>" name="id_karyawan">
                                        <?php echo $id_karyawanErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>No Projek :</label>
                                        <input type="text" class="form-control" value="<?php echo $no_projek; ?>" name="no_projek">

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

                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="dashboard.php" class="btn btn-primary w-20">Close</a>
                                        </div>
                                    </div>
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