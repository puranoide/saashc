<?php

session_start();

$dni = isset($_GET['dni']) ? $_GET['dni'] : null;
$action = isset($_GET['action']) ? $_GET['action'] : null;


if (is_null($action) && !is_null($dni)) :
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
    
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Agregar paciente</title>
    </head>

    <body>

        <h1 class="text-center mt-5">Nueva historia</h1>
        <p class="text-center mt-2"> paciente:<?= $paciente['nombreyapellido'] ?><br> dni:<?= $paciente['dni'] ?> </p>

        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            Agregar Paciente
                        </div>
                        <div class="card-body">
                            <form action="../logic/historia.php" method="POST">
                                <input type="hidden" name="action" value="add">
                                <input type="hidden" name="id" value="<?= $paciente['id'] ?>">
                                <input type="hidden" name="dni" value="<?= $paciente['dni'] ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Antecendente</label>
                                    
                                    <textarea name="antecendente" id="" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">receta</label>
                                    <textarea name="receta" id="" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">agregar</button>
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
else: 

    include_once "../config/db.php";
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    function buscarHistoria($con, $id)
    {
        $pacienteQuery = "SELECT*FROM historia WHERE id='$id'";
        $pacienteResult = $con->query($pacienteQuery);
        if ($pacienteResult) {
            if (mysqli_num_rows($pacienteResult) > 0) {
                $paciente = mysqli_fetch_assoc($pacienteResult);
                return $paciente;
            } else {
                return "no se encuentra historia,intente de nuevo";
            }
        } else {
            return "error al conectarse a la base de datos,contacta con soporte";
        }
    }
    function buscarPaciente($con, $id)
    {
        $pacienteQuery = "SELECT*FROM paciente WHERE id='$id'";
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
    $historia = buscarHistoria($con, $id);
    $paciente = buscarPaciente($con, $historia['idPaciente']);


    if (is_array($historia)):?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Agregar paciente</title>
    </head>

    <body>

        <h1 class="text-center mt-5">Nueva historia</h1>
        <p class="text-center mt-2"> Paciente:<?= $paciente['nombreyapellido'] ?><br> DNI:<?= $paciente['dni'] ?> </p>

        <div class="container mt-5">
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            Agregar Paciente
                        </div>
                        <div class="card-body">
                            <form action="../logic/historia.php" method="POST">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= $historia['id'] ?>">
                                <input type="hidden" name="dni" value="<?= $paciente['dni'] ?>">
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Antecendente</label>
                                    
                                    <textarea name="antecendente" id="" class="form-control"> <?= $historia['antecedente']?> </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">receta</label>
                                    <textarea name="receta" id="" class="form-control"><?= $historia['receta']?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">agregar</button>
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
    else: ?>
    <h1>no se encuentra historia</h1>
<?php endif;

endif;


?>