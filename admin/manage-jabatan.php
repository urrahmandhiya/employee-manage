<?php

require_once "include/header.php";
?>
<?php

//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM jabatan";
$result = mysqli_query($conn, $sql);

$i = 1;
$you = "";


?>

<style>
    table,
    th,
    td {
        border: 1px solid black;
        padding: 15px;
    }

    table {
        border-spacing: 10px;
    }
</style>

<div class="container bg-white shadow">
    <div class="py-4 mt-5">
        <div class='text-center pb-2'>
            <h4>Manage Jabatan</h4>
        </div>
        <table style="width:100%" class="table-hover text-center ">
            <tr class="bg-dark">
                <th>No.</th>
                <th>ID Jabatan</th>
                <th>Nama Jabatan</th>
                <th>Masa Awal Jabatan</th>
                <th>Masa Akhir Jabatan</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
            <?php

            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    $id_jabatan = $rows["id_jabatan"];
                    $nama_jabatan = $rows["nama_jabatan"];
                    $awal_jabatan = $rows["awal_jabatan"];
                    $akhir_jabatan = $rows["akhir_jabatan"];
                    $deskripsi = $rows["deskripsi"];

            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $id_jabatan; ?></td>
                        <td><?php echo $nama_jabatan; ?></td>
                        <td><?php echo $awal_jabatan; ?></td>
                        <td><?php echo $akhir_jabatan; ?></td>
                        <td><?php echo $deskripsi; ?></td>

                        <td> <?php
                                $edit_icon = "<a href='edit-jabatan.php?id_jabatan={$id_jabatan}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                                $delete_icon = " <a href='delete-jabatan.php?id_jabatan={$id_jabatan}' id_jabatan='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
                                echo $edit_icon . $delete_icon;
                                ?>
                        </td>



                <?php
                    $i++;
                }
            } else {
                echo "no jabatan found";
            }
                ?>
                    </tr>
        </table>
    </div>
</div>

<?php
require_once "include/footer.php";
?>