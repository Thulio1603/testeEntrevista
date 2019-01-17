<?php
//esse arquivo recebe uma requisiчуo Ajax de geralJquery.min.js
    require_once("../model/access.php");
    
    $access = new Access();
    //$access->acesso();
    
    // fazendo o select dos nomes dos clientes
    if($_POST['tipo'] == 'select'){
        $access->select();
    }

    if(isset($_POST['tipo2'])){
        if($_POST['tipo2'] == 'cliente'){
            if($_POST['tipo'] == 'insercao'){
                $access->insertCliente($_POST['nome'],$_POST['email'],$_POST['telefone']);
            }else if($_POST['tipo'] == 'alteracao'){
                 $access->updateCliente($_POST['nome'],$_POST['email'],$_POST['telefone'], $_POST['alterado']);
            }else if($_POST['tipo'] == 'delecao'){
                 $access->deleteCliente($_POST['nome']);
            }else if($_POST['tipo'] == 'pesquisa'){
                $dados = $access->pesquisaCliente($_POST['nome'],$_POST['email']);
            }
        } else if($_POST['tipo2'] == 'produto'){
            if($_POST['tipo'] == 'insercao'){
                $access->insertProduto($_POST['nome'],$_POST['descricao'],$_POST['preco']);
            }else if($_POST['tipo'] == 'alteracao'){
                 $access->updateProduto($_POST['nome'],$_POST['descricao'],$_POST['preco'], $_POST['alterado']);
            }else if($_POST['tipo'] == 'delecao'){
                 $access->deleteProduto($_POST['nome']);
            }else if($_POST['tipo'] == 'pesquisa'){
                $dados = $access->pesquisaProduto($_POST['nome'],$_POST['descricao']);
            }
        }else if($_POST['tipo2'] == 'pedido'){
            if($_POST['tipo'] == 'insercao'){
                $data = DateTime::createFromFormat('d/m/Y', $_POST['data1'] )->format('Y-m-d') ;
                $access->insertPedido($data,$_POST['cliente'],$_POST['produto'], $_POST['qtde'] );
            }else if($_POST['tipo'] == 'pesquisa'){
                $access->pesquisaPedido($_POST['cliente'],$_POST['produto']);
            }else if($_POST['tipo'] == 'alteracao'){
                $data = DateTime::createFromFormat('d/m/Y', $_POST['data'] )->format('Y-m-d') ;
                $access->updatePedido($_POST['cliente'],$_POST['produto'],$_POST['qtde'],$data,$_POST['alterado']);
            }else if($_POST['tipo'] == 'delecao'){
                $access->deletePedido($_POST['cliente']);
            }
        }
    }
?>