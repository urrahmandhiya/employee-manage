<?php
require_once "include/header.php";
?>


<?php


// database connection
require_once "../connection.php";


$session_email =  $_SESSION["email"];
$sql = "SELECT * FROM karyawan WHERE email= '$session_email' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($rows = mysqli_fetch_assoc($result)) {
        $username = $rows["username"];
        $email = $rows["email"];
        $gender = $rows["gender"];
        $tgl_lahir = $rows["tgl_lahir"];

        }
    }



$usernameErr = $emailErr = "";
//$name = $email = $tgl_lahir = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_REQUEST["gender"])) {
        $gender = "";
    } else {
        $gender = $_REQUEST["gender"];
    }


    if (empty($_REQUEST["tgl_lahir"])) {
        $tgl_lahir = "";
    } else {
        $tgl_lahir = $_REQUEST["tgl_lahir"];
    }

    if (empty($_REQUEST["username"])) {
        $usernameErr = "<p style='color:red'> * Username is required</p>";
        $username = "";
    } else {
        $username = $_REQUEST["username"];
    }

    if (empty($_REQUEST["email"])) {
        $emailErr = "<p style='color:red'> * Email is required</p> ";
        $email = "";
    } else {
        $email = $_REQUEST["email"];
    }


    if (!empty($username) && !empty($email)) {

        $sql_select_query = "SELECT email FROM karyawan WHERE email = '$email' ";
        $r = mysqli_query($conn, $sql_select_query);

        if (mysqli_num_rows($r) > 0) {
            $sql = "UPDATE karyawan SET username = '$username', email = '$email', tgl_lahir = '$tgl_lahir', gender = '$gender' WHERE email='$_SESSION[email]' ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['email'] = $email;
                echo "<script>
                            $(document).ready( function(){
                                $('#showModal').modal('show');
                                $('#modalHead').hide();
                                $('#linkBtn').attr('href', 'profile.php');
                                $('#linkBtn').text('View Profile');
                                $('#addMsg').text('Profile Edited Successfully!!');
                                $('#closeBtn').hide();
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
                                <h4 class="text-center">Edit Your Profile</h4>
                                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <label>Username :</label>
                                        <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                                        <?php echo $usernameErr; ?>
                                    </div>


                                    <div class="form-group">
                                        <label>Email :</label>
                                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                                        <?php echo $emailErr; ?>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Lahir :</label>
                                        <input type="date" class="form-control" value="<?php echo $tgl_lahir; ?>" name="tgl_lahir">

                                    </div>

                                    <div class="form-group form-check form-check-inline">
                                        <label class="form-check-label">Gender :</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" <?php if ($gender == "PRIA" ) {echo "checked";} ?> value="PRIA" selected>
                                        <label class="form-check-label">Pria</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" <?php if ($gender == "WANITA" ) {echo "checked";} ?> value="WANITA">
                                        <label class="form-check-label">Wanita</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" <?php if ($gender == "LAINNYA" ){ echo "checked";} ?> value="LAINNYA">
                                        <label class="form-check-label">Lainnya</label>
                                    </div>


                                    <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group">
                                            <input type="submit" value="Save Changes" class="btn btn-primary w-20 " name="save_changes">
                                        </div>
                                        <div class="input-group">
                                            <a href="profile.php" class="btn btn-primary w-20">Close</a>
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