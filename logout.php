<?php include 'Static/connect/db.php'?>\
<?php

session_start();
session_destroy();
header("Location: index.php");
?>