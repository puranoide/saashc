<?php

session_start();
function loginUser($con,$email,$password){
    $userQuery="SELECT*FROM users WHERE email='$email' AND password='$password'";
    $loginResult=$con->query($userQuery);
    if($loginResult){
        if (mysqli_num_rows($loginResult) > 0){
            $usuario=mysqli_fetch_assoc($loginResult);
            return $usuario;
        }else{
            return "no se encuentra usuario,intente de nuevo";
        }
    }else{
        return "error al conectarse a la base de datos,contacta con soporte";
    }
}

function createSessionUser($user){
    // user=[idUser=]
    session_start();
    $_SESSION['idS']=$user['id'];
    $_SESSION['passS']=$user['password'];
    $_SESSION['emailS']=$user['email'];
};

function logoutUser(){
    session_destroy();
}

include_once "../config/db.php";

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = loginUser($con, $email, $password);
    if (is_array($user)) {
        createSessionUser($user);
        header("Location:../app/inicio.php");
    }else{
        header("Location: ../index.php?messaje=no se pudo iniciar sesion");
    }
   
}

?>