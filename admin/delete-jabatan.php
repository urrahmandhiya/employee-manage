<?php 

require_once "../connection.php";

$id_jabatan =  $_GET["id_jabatan"];

$sql_jabatan = "DELETE FROM jabatan WHERE id_jabatan = $id_jabatan ";

mysqli_query($conn , $sql_jabatan); 

header("Location: manage-jabatan.php?delete-success-where-id_jabatan=" .$id_jabatan );


?>