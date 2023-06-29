<?php
require_once "include/header.php";
?>


<?php


$id_karyawan = $_GET["id_karyawan"];
require_once "../connection.php";

$sql = "SELECT * FROM karyawan WHERE id_karyawan = $id_karyawan ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($rows = mysqli_fetch_assoc($result)) {
        $nama_karyawan = $rows["nama_karyawan"];
        $id_jabatan = $rows["id_jabatan"];
        $id_departemen = $rows["id_departemen"];
        $no_telp = $rows["no_telp"];
        $alamat = $rows["alamat"];
    }
}


$idErr = $id_depErr = $id_jabErr = $namaErr = $no_telpErr = $alamatErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["nama_karyawan"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
    } else {
        $nama_karyawan = $_REQUEST["nama_karyawan"];
    }

    if (empty($_REQUEST["id_karyawan"])) {
        $idErr = "<p style='color:red'> * ID is required</p>";
    } else {
        $id_karyawan = $_REQUEST["id_karyawan"];
    }

    if (empty($_REQUEST["alamat"])) {
        $alamatErr = "<p style='color:red'> * Alamat is required</p>";
    } else {
        $alamat = $_REQUEST["alamat"];
    }

    if (empty($_REQUEST["no_telp"])) {
        $no_telpErr = "<p style='color:red'> * Phone number is required</p>";
    } else {
        $no_telp = $_REQUEST["no_telp"];
    }

    if (empty($_REQUEST["id_jabatan"])) {
        $id_jabErr = "<p style='color:red'> * Position ID is required</p> ";
    } else {
        $id_jabatan = $_REQUEST["id_jabatan"];
    }

    if (empty($_REQUEST["id_departemen"])) {
        $id_depErr = "<p style='color:red'> * Departemen ID is required</p> ";
    } else {
        $id_departemen = $_REQUEST["id_departemen"];
    }


    if (!empty($id_karyawan) && !empty($id_jabatan) && !empty($id_departemen) && !empty($nama_karyawan)) {

        // database connection
        $sql_select_query = "SELECT id_karyawan FROM karyawan WHERE id_karyawan = '$id_karyawan' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "UPDATE karyawan SET nama_karyawan = '$nama_karyawan', id_jabatan = '$id_jabatan', id_departemen = '$id_departemen', no_telp = '$no_telp', alamat = '$alamat' WHERE id_karyawan = $_GET[id_karyawan] ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-karyawan.php');
                            $('#linkBtn').text('View Karyawan');
                            $('#addMsg').text('Profile Edit Successfully!');
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
                                <h4 class="text-center">Tambahkan Karyawan Baru</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Full Name :</label>
                                        <input type="text" class="form-control" value="<?php echo $nama_karyawan; ?>" name="nama_karyawan">
                                        <?php echo $namaErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>ID jabatan :</label>
                                        <input type="text" class="form-control" value="<?php echo $id_jabatan; ?>" name="id_jabatan">
                                        <?php echo $id_jabErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>ID departemen: </label>
                                        <input type="text" class="form-control" value="<?php echo $id_departemen; ?>" name="id_departemen">
                                        <?php echo $id_depErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>No. Telephone :</label>
                                        <input type="text" class="form-control" value="<?php echo $no_telp; ?>" name="no_telp">
                                        <?php echo $no_telpErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Alamat :</label>
                                        <input type="text" class="form-control" value="<?php echo $alamat; ?>" name="alamat">
                                        <?php echo $alamatErr; ?>
                                    </div>

                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="manage-karyawan.php" class="btn btn-primary w-20">Close</a>
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