<?php include 'Static/connect/db.php'?>\
<?php
//recuperamos la sesión
session_start();
//destruimos la sesión
session_destroy();
header("Location: index.php");
?>