<?php
class Access {
    //CLASSE DESTINADA A CONEXГO E ALTERAЗХES NO BANCO DE DADOS

    public function insertCliente($nome, $email, $telefone){
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
            $telefone = str_replace('(', '', $telefone);
            $telefone = str_replace(')', '', $telefone);
            $telefone = str_replace(' ', '', $telefone);
            $telefone = str_replace('-', '', $telefone);
            // limpando a variavel telefone
            $stmt = $conexao->prepare("INSERT INTO cliente (nome, email, telefone) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $telefone);
             
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
    
    public function updateCliente($nome, $email, $telefone, $nomePesquisa){
       
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
            
            $telefone = str_replace('(', '', $telefone);
            $telefone = str_replace(')', '', $telefone);
            $telefone = str_replace(' ', '', $telefone);
            $telefone = str_replace('-', '', $telefone);
            // limpando a variavel telefone
            $stmt = $conexao->prepare('UPDATE cliente SET nome = "'.$nome.'", email = "'.$email.'", telefone = "'.$telefone.'" WHERE nome = "'.$nomePesquisa.'" ');
           /* $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $senha);
            $stmt->bindParam(4, $nomePesquisa);*/

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
    
    public function deleteCliente($nome){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
                
            $stmt = $conexao->prepare('DELETE FROM cliente WHERE nome =  "'.$nome.'" ');
            //$stmt->bindParam(1, $nome);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }  
    }
    
    public function pesquisaCliente($nome, $email){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
                
            if($nome != '' && $email != ''){
                $stmt = $conexao->prepare(' SELECT nome, email, telefone FROM cliente WHERE nome like ("%'.$nome.'%") or email like ("%'.$email.'%") ');
            }else if($nome != ''){
                $stmt = $conexao->prepare(' SELECT nome, email, telefone FROM cliente WHERE nome like ("%'.$nome.'%") ');
            }else if($email != ''){
                $stmt = $conexao->prepare(' SELECT nome, email, telefone FROM cliente WHERE email like ("%'.$email.'%") ');
            }
            if ($stmt->execute()) {
                $aux = 0;
                $clientes = '';
                $emails = '';
                $telefone = '';
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $clientes[$aux] = $rs->nome.', ';
                        $telefone[$aux] = $rs->telefone.', ';
                        $emails[$aux++] = $rs->email.', '; 
                                    
                }
                if($clientes != null && $clientes != '' && $emails != null && $emails != ''){
                    $clientes = implode($clientes);
                    $emails = implode($emails);
                    $telefone = implode($telefone);
                    echo json_encode($clientes.$emails.$telefone);
                }else{
                    echo 0;
                }  
            } else {
                echo "Erro: Nгo foi possнvel recuperar os dados do banco de dados";
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }
    
    public function insertProduto($nome, $descricao, $preco){
    try {
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
            
            $stmt = $conexao->prepare("INSERT INTO produto (nome, descricao, preco) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $descricao);
            $stmt->bindParam(3, $preco);
             
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
    
    public function updateProduto($nome, $descricao, $preco, $nomePesquisa){
       
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
            
            $stmt = $conexao->prepare('UPDATE produto SET nome = "'.$nome.'", descricao = "'.$descricao.'", preco = '.$preco.' WHERE nome = "'.$nomePesquisa.'" ');

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
    
    public function deleteProduto($nome){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
                
            $stmt = $conexao->prepare('DELETE FROM produto WHERE nome =  "'.$nome.'" ');
            //$stmt->bindParam(1, $nome);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }  
    }
    
    public function pesquisaProduto($nome, $descricao){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
                
             if($nome != '' && $descricao != ''){
                $stmt = $conexao->prepare(' SELECT nome, descricao, preco FROM produto WHERE nome like ("%'.$nome.'%") or descricao like ("%'.$descricao.'%") ');
            }else if($nome != ''){
                $stmt = $conexao->prepare(' SELECT nome, descricao, preco FROM produto WHERE nome like ("%'.$nome.'%") ');
            }else if($descricao != ''){
                $stmt = $conexao->prepare(' SELECT nome, descricao, preco FROM produto WHERE descricao like ("%'.$descricao.'%") ');
            }
            if ($stmt->execute()) {
                $aux = 0;
                $clientes = '';
                $emails = '';
                $telefone = '';
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $clientes[$aux] = $rs->nome.', ';
                        $telefone[$aux] = $rs->preco.', ';
                        $emails[$aux++] = $rs->descricao.', '; 
                                    
                }
                if($clientes != null && $clientes != '' && $emails != null && $emails != ''){
                    $clientes = implode($clientes);
                    $emails = implode($emails);
                    $telefone = implode($telefone);
                    echo json_encode($clientes.$emails.$telefone);
                }else{
                    echo 0;
                }  
            } else {
                echo "Erro: Nгo foi possнvel recuperar os dados do banco de dados";
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }
    
    public function insertPedido($data, $cliente, $produto, $qtde){
        try {
                $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("set names utf8");
                
                $stmt = $conexao->prepare("INSERT INTO pedidos (data_criacao, cliente, produto, qtde) VALUES (?, ?, ?, ?)");
                $stmt->bindParam(1, $data);
                $stmt->bindParam(2, $cliente);
                $stmt->bindParam(3, $produto);
                $stmt->bindParam(4, $qtde);
                
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                       throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
    }
    public function pesquisaPedido($cliente, $produto){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
            if($cliente != '' && $produto != ''){
                $stmt = $conexao->prepare(' SELECT pedidos.data_criacao as data_criacao, cliente.nome as nomeCliente, produto.nome as nomeProduto, pedidos.qtde as qtde FROM pedidos INNER JOIN produto ON pedidos.produto = produto.id INNER JOIN cliente ON pedidos.cliente = cliente.id WHERE pedidos.cliente = '.$cliente.' AND pedidos.produto = '.$produto);
            }else if($cliente != ''){
                $stmt = $conexao->prepare(' SELECT pedidos.data_criacao as data_criacao, cliente.nome as nomeCliente, produto.nome as nomeProduto, pedidos.qtde as qtde  FROM pedidos INNER JOIN produto ON pedidos.produto = produto.id INNER JOIN cliente ON pedidos.cliente = cliente.id WHERE pedidos.cliente = '.$cliente);
            }else if($produto != ''){
                $stmt = $conexao->prepare(' SELECT pedidos.data_criacao as data_criacao, cliente.nome as nomeCliente, produto.nome as nomeProduto, pedidos.qtde as qtde  FROM pedidos INNER JOIN produto ON pedidos.produto = produto.id INNER JOIN cliente ON pedidos.cliente = cliente.id WHERE pedidos.produto = '.$produto);
            }
            if ($stmt->execute()) {
                $aux = 0;
                $tudo = '';
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    if($rs->nomeCliente != null && $rs->nomeCliente != '' && $rs->nomeProduto != null && $rs->nomeProduto != ''){
                        $clientes = $rs->nomeCliente;
                        $dtCreate = $rs->data_criacao;
                        $qtde = $rs->qtde;
                        $emails = $rs->nomeProduto; 
                        $tudo[$aux] = $dtCreate.','.$clientes.','.$emails.','.$qtde.',';
                        $aux++;
                    }                 
                }
                if($tudo != ''){
                    $tudo = implode($tudo);
    
                    echo json_encode($tudo);
                }else{
                    echo 0;
                }

            } else {
                echo "Erro: Nгo foi possнvel recuperar os dados do banco de dados";
            }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
    }
    public function updatePedido($nome, $descricao, $preco, $data, $nomePesquisa){

        try {
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
 
            $stmt = $conexao->prepare('UPDATE pedidos SET data_criacao = "'.$data.'", cliente = '.$nome.', produto = '.$descricao.', qtde = '.$preco.' WHERE cliente = '.$nomePesquisa.' ');

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
        public function deletePedido($nome){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
                
            $stmt = $conexao->prepare('DELETE FROM pedidos WHERE cliente =  '.$nome);
            //$stmt->bindParam(1, $nome);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    echo 1;
                } else {
                    echo 0;
                }
            } else {
                   throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }  
    }
    
    // classe para fazer o select com os nomes de todos os clientes
        public function select(){
              try{
                $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("set names utf8");
                    
                 $stmt = $conexao->prepare(' SELECT * FROM cliente ');
                /* $stmt->bindParam(1, $nome); 
                 $stmt->bindParam(2, $email);*/
                if ($stmt->execute()) {
                    $aux = 0;
                    $clientes = '';
                    $idCliente = '';
                    
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if($rs->nome != null && $rs->nome != ''){
                            $clientes[$aux] = '#'.$rs->nome.', '; 
                            $idCliente[$aux] = '&'.$rs->id.', ';
                            $aux++;
                        }                    
                    }
                    if($clientes != null && $clientes != '' && $idCliente != null && $idCliente != ''){
                        $clientes = implode($clientes);
                        $idCliente = implode($idCliente);
    
                    } 
                } else {
                    echo "Erro: Nгo foi possнvel recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
            }
            
            try{
                $conexao = new PDO("mysql:host=localhost; dbname=loja", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("set names utf8");
                    
                 $stmt = $conexao->prepare(' SELECT * FROM produto ');
                /* $stmt->bindParam(1, $nome); 
                 $stmt->bindParam(2, $email);*/
                if ($stmt->execute()) {
                    $aux = 0;
                    $produtos = '';
                    $idProduto = '';
    
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if($rs->nome != null && $rs->nome != ''){
                            $produtos[$aux] = '@'.$rs->nome.', '; 
                            $idProduto[$aux] = '*'.$rs->id.', ';
                            $aux++;
                        }                    
                    }
                    if($produtos != null && $produtos != '' && $idProduto != null && $idProduto != ''){
                        $produtos = implode($produtos);
                        $idProduto = implode($idProduto);

                    } 
                } else {
                    echo "Erro: Nгo foi possнvel recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: ".$erro->getMessage();
            }
            
            echo json_encode($produtos.$idProduto.$clientes.$idCliente);
        }
    }

?>