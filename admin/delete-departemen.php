<?php 

require_once "../connection.php";

$id_departemen =  $_GET["id_departemen"];

$sql_departemen = "DELETE FROM departemen WHERE id_departemen = $id_departemen ";

mysqli_query($conn , $sql_departemen); 

header("Location: manage-departemen.php?delete-success-where-id_departemen=" .$id_departemen );


?>