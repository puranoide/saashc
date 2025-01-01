<?php

session_start();

if (!isset($_SESSION['idS'])) {
    header("Location: ../index.php");
}

$dni = isset($_GET['dni']) ? $_GET['dni'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;


if ($action == "add" && $action != null) : ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Agregar paciente</title>
    </head>

    <body>

        <h1 class="text-center mt-5">Nuevo paciente</h1>

        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            Agregar Paciente
                        </div>
                        <div class="card-body">
                            <form action="../logic/patient.php" method="POST">
                                <input type="hidden" name="action" value="add">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $dni ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombres y apellidos</label>
                                    <input type="text" name="name_and_surname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

    </html>



<?php
else :

    include_once "../config/db.php";
    function getPatient($con, $dni)
    {
        $query = "SELECT * FROM paciente WHERE dni = '$dni'";
        $paciente = [];
        $QueryResult = $con->query($query);
        if ($QueryResult->num_rows > 0) {
            while ($rowPatiente = $QueryResult->fetch_assoc()) {
                $paciente[] = $rowPatiente;
            }
        } else {
            return "No se encontró la tienda";
        }
        return $paciente;
    }

    $paciente = getPatient($con, $dni);


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Editar paciente</title>
    </head>

    <body>

        <h1 class="text-center mt-5">Editar paciente</h1>

        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            Editar Paciente
                        </div>
                        <div class="card-body">
                            <form action="../logic/patient.php" method="POST">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= $paciente[0]['id'] ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $paciente[0]['dni'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombres y apellidos</label>
                                    <input type="text" name="name_and_surname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $paciente[0]['nombreyapellido'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Correo</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $paciente[0]['correo'] ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>

    </html>



<?php endif ?>