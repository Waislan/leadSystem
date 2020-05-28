<?php
    function verificarLogin(){
        if (!isset($_SESSION['idColaborador']) ||
            !isset($_SESSION['nomeColaborador']) ||
            !isset($_SESSION['emailColaborador']) ||
            !isset($_SESSION['passwordColaborador']) ||
            !isset($_SESSION['usernameColaborador']) ||
            !isset($_SESSION['permissoesAdmin']) ||
            !isset($_SESSION['cpfColaborador'])) {
            header("Location: login.php");
        }
    }
?>