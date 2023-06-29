<?php
require_once "include/header.php";
?>


<?php


$id_jabatan = $_GET["id_jabatan"];
require_once "../connection.php";

$sql = "SELECT * FROM jabatan WHERE id_jabatan = $id_jabatan ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($rows = mysqli_fetch_assoc($result)) {
        $nama_jabatan = $rows["nama_jabatan"];
        $awal_jabatan = $rows["awal_jabatan"];
        $akhir_jabatan = $rows["akhir_jabatan"];
        $deskripsi = $rows["deskripsi"];
    }
}


$idErr = $namaErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["nama_jabatan"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
        $nama_jabatan = "";
    } else {
        $nama_jabatan = $_REQUEST["nama_jabatan"];
    }

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

    if (empty($_REQUEST["deskripsi"])) {
        $deskripsi = "";
    } else {
        $deskripsi = $_REQUEST["deskripsi"];
    }


    if (!empty($id_jabatan) && !empty($nama_jabatan)) {

        // database connection
        $sql_select_query = "SELECT id_jabatan FROM jabatan WHERE id_jabatan = '$id_jabatan' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "UPDATE jabatan SET nama_jabatan = '$nama_jabatan', akhir_jabatan = '$akhir_jabatan', awal_jabatan = '$awal_jabatan', deskripsi = '$deskripsi' WHERE id_jabatan = $_GET[id_jabatan] ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-jabatan.php');
                            $('#linkBtn').text('View Jabatan');
                            $('#addMsg').text('Jabatan Edit Successfully!');
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
                                <h4 class="text-center">Edit Jabatan Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">


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


                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="manage-jabatan.php" class="btn btn-primary w-20">Close</a>
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