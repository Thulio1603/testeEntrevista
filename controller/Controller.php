<?php
    require_once("../model/access.php");
    $access = new Access();
    $access->acesso();
  
    $access->insert($_POST['nome'],$_POST['email']);
    

?>