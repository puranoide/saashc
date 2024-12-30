<?php

print_r($_POST);

function addPatient($con, $dni, $name_and_surname, $email) {
    $sql="INSERT INTO paciente (dni,nombreyapellido,correo) VALUES('$dni','$name_and_surname','$email')";
    $result=$con->query($sql);
    return $result;
}

function updatePatient($con,$id, $dni, $name_and_surname, $email) {
    $sql="UPDATE paciente SET dni='$dni',nombreyapellido='$name_and_surname',correo='$email' WHERE id=$id";
    $result=$con->query($sql);
    return $result;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_POST['action']) {
        case 'add':
            # code...
            echo "agregar";
            include_once "../config/db.php";
            $result=addPatient($con, $_POST['dni'], $_POST['name_and_surname'], $_POST['email']);
            if ($result) {
                header("Location: ../app/inicio.php?messaje=paciente agregado con exito,$_POST[dni]");
            }
            else{
                header("Location: ../app/inicio.php?messaje=error al agregar paciente");
            }
            break;
        
        case 'update':
            echo "update";
            include_once "../config/db.php";
            $result=updatePatient($con, $_POST['id'], $_POST['dni'], $_POST['name_and_surname'], $_POST['email']);
            if ($result) {
                header("Location: ../app/inicio.php?messaje=paciente actualizado con exito,$_POST[dni]");
                var_dump($result);
            }
            else{
                header("Location: ../app/inicio.php?messaje=error al actualizar paciente");
                var_dump($result);
            }
            break;
            break;
        
        default:
            # code...
            break;
    }

}

?>