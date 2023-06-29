<?php
require_once "include/header.php";
?>


<?php


$id_departemen = $_GET["id_departemen"];
require_once "../connection.php";

$sql = "SELECT * FROM departemen WHERE id_departemen = $id_departemen ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($rows = mysqli_fetch_assoc($result)) {
        $nama_departemen = $rows["nama_departemen"];
        $lokasi = $rows["lokasi"];
    }
}


$idErr = $namaErr =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_REQUEST["nama_departemen"])) {
        $namaErr = "<p style='color:red'> * Name is required</p>";
        $nama_departemen = "";
    } else {
        $nama_departemen = $_REQUEST["nama_departemen"];
    }

    if (empty($_REQUEST["lokasi"])) {
        $lokasi = "";
    } else {
        $lokasi = $_REQUEST["lokasi"];
    }


    if (!empty($id_departemen) && !empty($nama_departemen)) {

        // database connection
        $sql_select_query = "SELECT id_departemen FROM departemen WHERE id_departemen = '$id_departemen' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "UPDATE departemen SET nama_departemen = '$nama_departemen', lokasi = '$lokasi' WHERE id_departemen = $_GET[id_departemen] ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                        $(document).ready( function(){
                            $('#showModal').modal('show');
                            $('#modalHead').hide();
                            $('#linkBtn').attr('href', 'manage-departemen.php');
                            $('#linkBtn').text('View Departemen');
                            $('#addMsg').text('Departemen Edit Successfully!');
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
                                <h4 class="text-center">Edit Departemen Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">


                                    <div class="form-group">
                                        <label>Masukan Nama Departemen :</label>
                                        <input type="text" class="form-control" value="<?php echo $nama_departemen; ?>" name="nama_departemen">
                                        <?php echo $namaErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Lokasi :</label>
                                        <input type="text" class="form-control" value="<?php echo $lokasi; ?>" name="lokasi">

                                    </div>


                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="manage-departemen.php" class="btn btn-primary w-20">Close</a>
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