<?php
require_once "include/header.php";
?>
<?php

// database connection
require_once "../connection.php";

$currentDay = date('Y-m-d', strtotime("today"));
$tomorrow = date('Y-m-d', strtotime("+1 day"));

$i = 1;
// total Karyawan
$select_karyawans = "SELECT * FROM karyawan";
$total_karyawans = mysqli_query($conn, $select_karyawans);

// total jabatan
$select_jab = "SELECT * FROM jabatan";
$total_jab = mysqli_query($conn, $select_jab);

// total proyek
$select_pro = "SELECT * FROM projek";
$total_pro = mysqli_query($conn, $select_pro);

// total employee
$select_dep = "SELECT * FROM departemen";
$total_dep = mysqli_query($conn, $select_dep);

// Ascending ID employee
$sql =  "SELECT * FROM bekerja ORDER BY id_karyawan ASC";
$kar_ = mysqli_query($conn, $sql);


?>

<div class="container">

    <div class="row mt-5">
        <div class="col-3">
            <div class="card shadow " style="width: 15.5rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Karyawan</li>
                    <li class="list-group-item">Total Karyawan : <?php echo mysqli_num_rows($total_karyawans); ?> </li>
                    <li class="list-group-item text-center"><a href="manage-karyawan.php"><b>Lihat Semua Karyawan</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow " style="width: 15.5rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Jabatan</li>
                    <li class="list-group-item">Total Jabatan : <?php echo mysqli_num_rows($total_jab); ?> </li>
                    <li class="list-group-item text-center"><a href="manage-jabatan.php"><b>Lihat Semua Jabatan</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow " style="width: 15.5rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Projek</li>
                    <li class="list-group-item">Total Projek : <?php echo mysqli_num_rows($total_pro); ?></li>
                    <li class="list-group-item text-center"><a href="manage-projek.php"> <b>Lihat Semua Projek</b></a></li>
                </ul>
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow " style="width: 15.5rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Departemen</li>
                    <li class="list-group-item">Total Departemen : <?php echo mysqli_num_rows($total_dep); ?></li>
                    <li class="list-group-item text-center"><a href="manage-departemen.php"> <b>Lihat Semua Departemen</b></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-5">
        <div class="col-4">       
        </div>

        <div class="col-4">
            <div class="card shadow " style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">Employees on Leave (Weekwise) </li>
                    <li class="list-group-item">This Week : </li>
                    <li class="list-group-item">Next Week : </li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="row mt-5 bg-white shadow ">
        <div class="col-12">
            <div class=" text-center my-3 ">
                <h4>Data Karyawan Bekerja</h4>
            </div>
            <table class="table  table-hover">
                <thead>
                    <tr class="bg-dark">
                        <th scope="col">No.</th>
                        <th scope="col">Id Karyawan</th>
                        <th scope="col">No Projek</th>
                        <th scope="col">Gaji</th>
                        <th scope="col">Jam Kerja</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($kar_info = mysqli_fetch_assoc($kar_)) {
                        $kar_id_karyawan = $kar_info["id_karyawan"];
                        $kar_no_projek = $kar_info["no_projek"];
                        $kar_gaji = $kar_info["gaji"];
                        $kar_jam_kerja = $kar_info["jam_kerja"];
                        $kar_status = $kar_info["status"];

                    ?>
                        <tr>
                            <th><?php echo "$i. "; ?></th>
                            <th><?php echo $kar_id_karyawan; ?></th>
                            <td><?php echo $kar_no_projek; ?></td>
                            <td><?php echo $kar_gaji; ?></td>
                            <td><?php echo $kar_jam_kerja; ?></td>
                            <td><?php echo $kar_status; ?></td>

                            <td> <?php
                                    $edit_icon = "<a href='edit-bekerja.php?id_karyawan={$kar_id_karyawan}' class='btn-sm btn-primary float-center ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                                    $delete_icon = " <a href='delete-bekerja.php?id_karyawan={$kar_id_karyawan}' id_karyawan='bin' class='btn-sm btn-primary float-center ml-3'> <span ><i class='fa fa-trash '></i></span> </a>";
                                    echo $edit_icon . $delete_icon;

                                    ?>
                            </td>



                        <?php
                        $i++;
                    }
                        ?>
                        </tr>
                </tbody>
            </table>
            <br>
            <a type="button" href="add-bekerja.php" class="btn btn-primary btn-block">Add</a>
            <br>
        </div>
    </div>

</div>

<?php
require_once "include/footer.php";
?>