<?php

function addPatient($con, $id, $receta, $antecedente) {
    $date = date('Y-m-d');
    $sql = "INSERT INTO historia (idPaciente,antecedente,receta,dateCreated) VALUES('$id','$antecedente','$receta','$date')";
    $result = $con->query($sql);
    return $result;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_POST['action']) {
        case 'add':
            # code...
            echo "agregar";
            include_once "../config/db.php";
            $result = addPatient($con, $_POST['id'], $_POST['receta'], $_POST['antecendente']);
            var_dump($result);
            if ($result) {
                header("Location: ../app/inicio.php?messaje=historia agregadacon exito,paciente: $_POST[dni]");
            } else {
                header("Location: ../app/inicio.php?messaje=error al agregar paciente");
            }
            break;

        case 'update':
            echo "update";
            include_once "../config/db.php";
            $result = updatePatient($con, $_POST['id'], $_POST['dni'], $_POST['name_and_surname'], $_POST['email']);
            if ($result) {
                header("Location: ../app/inicio.php?messaje=paciente actualizado con exito,$_POST[dni]");
            } else {
                header("Location: ../app/inicio.php?messaje=error al actualizar paciente");
            }
            break;
    }
}
