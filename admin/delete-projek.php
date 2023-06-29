<?php 

require_once "../connection.php";

$no_projek =  $_GET["no_projek"];

$sql_projek = "DELETE FROM projek WHERE no_projek = $no_projek ";

mysqli_query($conn , $sql_projek); 

header("Location: manage-projek.php?delete-success-where-no_projek=" .$no_projek );

?>