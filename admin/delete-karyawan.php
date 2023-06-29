<?php 

require_once "../connection.php";

$id_karyawan =  $_GET["id_karyawan"];

$sql_karyawan = "DELETE FROM karyawan WHERE id_karyawan = $id_karyawan ";

mysqli_query($conn , $sql_karyawan); 

header("Location: manage-karyawan.php?delete-success-where-id_karyawan=" .$id_karyawan );


?>