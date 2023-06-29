<?php
require_once "include/header.php";
?>


<?php


$no_projek = $_GET["no_projek"];
require_once "../connection.php";

$sql = "SELECT * FROM projek WHERE no_projek = $no_projek ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($rows = mysqli_fetch_assoc($result)) {
        $id_departemen = $rows["id_departemen"];
        $nama_projek = $rows["nama_projek"];
        $mulai_projek = $rows["mulai_projek"];
        $akhir_projek = $rows["akhir_projek"];
        $deskripsi = $rows["deskripsi"];
    }
}


$no_proErr = $id_depErr = $namaErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["id_departemen"])) {
        $id_depErr = "<p style='color:red'> * Name is required</p>";
        $id_departemen = "";
    } else {
        $id_departemen = $_REQUEST["id_departemen"];
    }

    if (empty($_REQUEST["nama_projek"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
        $nama_projek = "";
    } else {
        $nama_projek = $_REQUEST["nama_projek"];
    }

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

    if (empty($_REQUEST["deskripsi"])) {
        $deskripsi = "";
    } else {
        $deskripsi = $_REQUEST["deskripsi"];
    }


    if (!empty($no_projek) && !empty($id_departemen) && !empty($nama_projek)) {

        // database connection
        $sql_select_query = "SELECT no_projek FROM projek WHERE no_projek = '$no_projek' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "UPDATE projek SET id_departemen = '$id_departemen', nama_projek = '$nama_projek', akhir_projek = '$akhir_projek', mulai_projek = '$mulai_projek', deskripsi = '$deskripsi' WHERE no_projek = $_GET[no_projek] ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-projek.php');
                            $('#linkBtn').text('View Projek');
                            $('#addMsg').text('Projek Edit Successfully!');
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
                                <h4 class="text-center">Edit Projek Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">


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


                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="manage-projek.php" class="btn btn-primary w-20">Close</a>
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