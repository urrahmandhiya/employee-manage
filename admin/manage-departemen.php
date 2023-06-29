<?php

require_once "include/header.php";
?>
<?php

//  database connection
require_once "../connection.php";

$sql = "SELECT * FROM departemen";
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
            <h4>Manage Departemen</h4>
        </div>
        <table style="width:100%" class="table-hover text-center ">
            <tr class="bg-dark">
                <th>No.</th>
                <th>ID Departemen</th>
                <th>Nama Departemen</th>
                <th>Lokasi</th>
                <th>Action</th>
            </tr>
            <?php

            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    $id_departemen = $rows["id_departemen"];
                    $nama_departemen = $rows["nama_departemen"];
                    $lokasi = $rows["lokasi"];

            ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $id_departemen; ?></td>
                        <td><?php echo $nama_departemen; ?></td>
                        <td><?php echo $lokasi; ?></td>

                        <td> <?php
                                $edit_icon = "<a href='edit-departemen.php?id_departemen={$id_departemen}' class='btn-sm btn-primary float-right ml-3 '> <span ><i class='fa fa-edit '></i></span> </a>";
                                $delete_icon = " <a href='delete-departemen.php?id_departemen={$id_departemen}' id_departemen='bin' class='btn-sm btn-primary float-right'> <span ><i class='fa fa-trash '></i></span> </a>";
                                echo $edit_icon . $delete_icon;
                                ?>
                        </td>



                <?php
                    $i++;
                }
            } else {
                echo "no departemen found";
            }
                ?>
                    </tr>
        </table>
    </div>
</div>

<?php
require_once "include/footer.php";
?>