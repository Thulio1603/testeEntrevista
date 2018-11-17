<?php
//esse arquivo recebe uma requisiчуo Ajax de geralJquery.min.js
    require_once("../model/access.php");
    
    $access = new Access();
    //$access->acesso();
    if($_POST['tipo'] == 'insercao'){
        $access->insert($_POST['nome'],$_POST['email'],$_POST['senha']);
    }else if($_POST['tipo'] == 'alteracao'){
         $access->update($_POST['nome'],$_POST['email'],$_POST['senha'], $_POST['alterado']);
    }else if($_POST['tipo'] == 'delecao'){
         $access->delete($_POST['nome']);
    }else if($_POST['tipo'] == 'pesquisa'){
        $dados = $access->pesquisa($_POST['nome'],$_POST['email']);
    }

?>