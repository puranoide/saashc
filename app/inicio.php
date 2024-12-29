<?php

session_start();

if (!isset($_SESSION['idS'])) {
    header("Location: ../index.php");
    
}


$dni = isset($_GET['dni']) ? $_GET['dni'] : null;


if ($dni == null) :
    print_r($_SESSION);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Buscar historial medico</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>

    <body>

        <h1 class="text-center mt-5"> buscar paciente</h1>

        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            DNI/Pasaporte del paciente
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">DNI</label>
                                <input type="text" name="dni" class="form-control" id="dni" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="buscar">buscar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById("buscar").addEventListener("click", function() {
                let dni = document.getElementById("dni").value;
                window.location.href = "inicio.php?dni=" + dni;
            });
        </script>

    </body>

    </html>

    <?php
elseif ($dni != null) :

    include_once "../config/db.php";
    function buscarPaciente($con, $dni)
    {
        $pacienteQuery = "SELECT*FROM paciente WHERE dni='$dni'";
        $pacienteResult = $con->query($pacienteQuery);
        if ($pacienteResult) {
            if (mysqli_num_rows($pacienteResult) > 0) {
                $paciente = mysqli_fetch_assoc($pacienteResult);
                return $paciente;
            } else {
                return "no se encuentra paciente,intente de nuevo";
            }
        } else {
            return "error al conectarse a la base de datos,contacta con soporte";
        }
    }

    $paciente = buscarPaciente($con, $dni);

    if (is_array($paciente)):
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>paciente buscado</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        </head>

        <body>

            <h1 class="text-center mt-5">paciente buscado</h1>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="card">
                            <div class="card-header">
                                Datos del paciente
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $paciente['dni'] ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="exampleInputPassword1" value="<?= $paciente['nombre y apellido'] ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputPassword1" value="<?= $paciente['correo'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary mt-3" id="agregar" onclick="window.location.href='managementHistoria.php?dni=<?= $paciente['dni'] ?>' ">agregar historia</button>
                </div>


                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        </body>

        </html>
    <?php
    else :
    ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>paciente buscado</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        </head>

        <body>

            <h1 class="text-center mt-5">paciente no encontrado</h1>


            <div class="container mt-5">
                <div class="row">
                    <div class="col-6 offset-3">
                        <div class="card">
                            <div class="card-header">
                                Datos buscado
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $_GET['dni'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary mt-3" id="agregar" onclick="window.location.href='managementHistoria.php?dni=<?= $_GET['dni'] ?>' ">agregar historia</button>
                </div>




                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        </body>
        </html>
<?php
    endif;
endif;
?>