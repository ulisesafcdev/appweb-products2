<?php

require 'config.php';

$id = $_POST['id'];
$msj = "";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a la BBDD... " . $mysqli->connect_error;
}

$query = "DELETE FROM usuarios WHERE id = ?";

$stm = $mysqli->prepare($query);
$stm->bind_param('i', $id);

if($stm->execute()){
    $msj = "Se elimino el registro.";
} else {
    $msj = "Fallo al borrar registro";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>Usuarios</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Resultado</a>
            <form class="d-flex" action="busqueda.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="buscar" required>
                <input class="btn btn-outline-secondary" type="submit" value="Search">
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h3 class="display-4" text-center><?= $msj ?></h3>
        </div>
        <div class="row">
            <div class="col">
                <a href="lista-usuarios.php" class="btn btn-success">Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php

$stm->close();
$mysqli->close();

?>