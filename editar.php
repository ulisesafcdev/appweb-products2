<?php

require 'config.php';

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$estado = $_POST['activo'];
$id = $_POST['id'];
$msj = null;

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    echo "Fallo al conectar con la BBDD... " . $mysqli->connect_error;
}

$query = "UPDATE usuarios SET usuario = ?, pass = ?, telefono = ?, direccion = ?, activo = ? WHERE id = ?";

$stm = $mysqli->prepare($query);
$stm->bind_param('ssisii', $usuario, $pass, $telefono, $direccion, $estado, $id);

if($stm->execute()){
    $msj = "Se actualizo el usuario";
} else {
    $msj = "Fallo al actualizar";
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Resultado de Edicion</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Usuario Actualizado</a>
            <form class="d-flex" action="busqueda.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="buscar" required>
                <input class="btn btn-outline-secondary" type="submit" value="Search">
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-4">
            <h3 class="display-4 text-center"><?= $msj ?></h3>
        </div>

        <table class="table table bordered">

            <thead>
                <tr>
                    <th>USUARIO</th>
                    <th>CONTRASEÑA</th>
                    <th>TELEFONO</th>
                    <th>DIRECCION</th>
                    <th>ESTADO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $usuario ?></td>
                    <td><?= $pass ?></td>
                    <td><?= $telefono ?></td>
                    <td><?= $direccion ?></td>
                    <?php if ($estado == 1) { ?>
                        <td>En Uso</td>
                    <?php } else if ($estado == 0) { ?>
                        <td>Inactivo</td>
                    <?php } ?>
                </tr>
            </tbody>

        </table>

        <div class="row">
            <div class="col">
                <a href="lista-usuarios.php" class="btn btn-success">Ver Usuarios</a>
            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>