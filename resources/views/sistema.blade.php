<?php
session_start();
if(!isset($_SESSION['loginAutorizado'])) {
    echo "USUÁRIO NÃO AUTORIZADO!";
} else {
    echo "usuário autorizado!";
}
?>