<?php
session_start();   
session_destroy();  
header('location: ../php/adm.php');

exit; 

//encerra a sessão do administrador
?>