<?php

require 'config.php';

$id = $_GET['id'];

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if($mysqli->connect_errno){
    echo "Fallo al conectar a la BBDD... " . $mysqli->connect_error;
}

$query = "SELECT * FROM usuarios WHERE id = ?";

$stm = $mysqli->prepare($query);
$stm->bind_param('i', $id);
$stm->execute();

$result = $stm->get_result();

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Eliminar Registro</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Informacion de Edicion</a>
            <form class="d-flex" action="busqueda.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="buscar" required>
                <input class="btn btn-outline-secondary" type="submit" value="Search">
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <h3 class="display-4 text-center">Actualizar Registro</h3>
        </div>

        <form action="editar.php" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="usuario" class="form-label">Nombre de usuario:</label>
                    <input type="text" name="usuario" class="form-control form-control-sm" id="usuario" value="<?= $row['usuario'] ?>">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="pass" class="form-label">Contraseña:</label>
                    <input type="password" name="pass" class="form-control form-control-sm" id="pass" value="<?= $row['pass'] ?>">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" name="telefono" class="form-control form-control-sm" id="telefono" value="<?= $row['telefono'] ?>">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-8">
                    <label for="direccion" class="form-label">Direccion:</label>
                    <input type="text" name="direccion" class="form-control form-control-sm" id="direccion" value="<?= $row['direccion'] ?>">
                </div>
            </div>

            <div class="row ms-1">
                <?php if($row['activo'] == true) { ?>

                <div class="mb-3 form-check col-md-2">
                    <input type="radio" name="activo" class="form-check-input" id="uso" value="1" checked>
                    <label for="uso" class="form-label">En Uso</label>
                </div>

                <div class="mb-3 form-check col-md-2">
                    <input type="radio" name="activo" class="form-check-input" id="in" value="0">
                    <label for="in" class="form-label">Inactivo</label>
                </div>

                <?php } else if ($row['activo'] == false) { ?>

                <div class="mb-3 form-check col-md-2">
                    <input type="radio" name="activo" class="form-check-input" id="uso" value="1">
                    <label for="uso" class="form-label">En Uso</label>
                </div>

                <div class="mb-3 form-check col-md-2">
                    <input type="radio" name="activo" class="form-check-input" id="in" value="0" checked>
                    <label for="in" class="form-label">Inactivo</label>
                </div>

                <?php } ?>
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                    <a href="lista-usuarios.php" class="btn btn-dark">Cancelar</a>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>