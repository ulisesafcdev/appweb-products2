<?php

require('config.php');

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    echo "Fallo al conectar a BBDD... " . $mysqli->connect_error;
}

$query = "SELECT * FROM usuarios";

$stm = $mysqli->prepare($query);
$stm->execute();

$result = $stm->get_result();

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
            <a class="navbar-brand">Usuarios ingresados</a>
            <form class="d-flex" action="busqueda.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="buscar" required>
                <input class="btn btn-outline-secondary" type="submit" value="Search">
            </form>
        </div>
    </nav>

    <div class="container mt-5">

        <form action="form-nuevo.php" method="post">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="usuario" class="form-label">Nombre de usuario:</label>
                    <input type="text" name="usuario" class="form-control form-control-sm" id="usuario" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="pass" class="form-label">Contraseña:</label>
                    <input type="password" name="pass" class="form-control form-control-sm" id="pass" required>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="number" name="telefono" class="form-control form-control-sm" id="telefono" required>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-8">
                    <label for="direccion" class="form-label">Direccion:</label>
                    <input type="text" name="direccion" class="form-control form-control-sm" id="direccion" required>
                </div>
            </div>

            <div class="row ms-1">
                <div class="mb-3 form-check col-md-2">
                    <input type="radio" name="activo" class="form-check-input" id="uso" value="1">
                    <label for="uso" class="form-label">Usuario En Uso</label>
                </div>

                <div class="mb-3 form-check col-md-2">
                    <input type="radio" name="activo" class="form-check-input" id="in" value="0" checked>
                    <label for="in" class="form-label">Usuario Inhabilitado</label>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </form>

        <hr>

        <div class="row mb-5">
            <h3 class="display-4 text-center">Listado</h3>
        </div>

        <table class="table table-responsive-sm table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>USUARIO</th>
                    <th>CONTRASEÑA</th>
                    <th>TELEFONO</th>
                    <th>DIRECCION</th>
                    <th>ESTADO</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['usuario'] ?></td>
                        <td><?= $row['pass'] ?></td>
                        <td><?= $row['telefono'] ?></td>
                        <td><?= $row['direccion'] ?></td>
                        <?php if ($row['activo'] == 1) { ?>
                            <td>En Uso</td>
                        <?php } else if ($row['activo'] == 0) { ?>
                            <td>Inactivo</td>
                        <?php } ?>
                        <td>
                            <a href="row-delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            <a href="row-update.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>

<?php

$result->close();
$mysqli->close();

?>