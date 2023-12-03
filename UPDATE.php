<html>
    
    <head>
        <title>Consulta</title>
    </head>
    <body>
    <center>
        <button>

<?php
require_once('conexion.php');

// echo "Hola ;)";

$conex = new Conexion();
$getConection = $conex->Conectar();

$sql = 'SELECT * FROM SUPER_AIRLINE.NOMBREUSER';
$query = $getConection->prepare($sql);
$query->execute();
echo "<br>";
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  echo "<br>";
  foreach ($row as $key => $value) {
    echo $key." __ ".$value."<br>";
  }
}

?>
</button>
</center>

</body>
</html>