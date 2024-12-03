<?php include '../connect/db.php'; ?>
<?php
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment; filename=test.xls');
?>
<h1>Consultar servicios con precio mayor a 200</h1>
<table class="table-warning">
<thead>
<tr>
    <td>ID</td><td>SERVICIO</td><td>COSTO</td>
</tr>
</thead>
<?php 
$consulta = "SELECT * FROM servicios WHERE precio > 200;";
$result = mysqli_query($conn, $consulta);
while($row = mysqli_fetch_array($result)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['precio']; ?></td>
    </tr>
<?php } ?> 
</table>
