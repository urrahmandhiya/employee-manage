<?php 

require_once "../connection.php";

$id_karyawan =  $_GET["id_karyawan"];

$sql_bekerja = "DELETE FROM bekerja WHERE id_karyawan = $id_karyawan ";

mysqli_query($conn , $sql_bekerja); 

header("Location: dashboard.php?delete-success-where-id_karyawan=" .$id_karyawan );


?>