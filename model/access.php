<?php
class Access {
    
    public function acesso(){
                $conexao = new PDO("mysql:host=localhost; dbname=login", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("set names utf8");
    }

    public function insert($nome, $email, $senha){
        try {
                $conexao = new PDO("mysql:host=localhost; dbname=login", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("set names utf8");
                
                $stmt = $conexao->prepare("INSERT INTO login_cadastro (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $email);
                $stmt->bindParam(3, $senha);
                 
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
    
    public function update($nome, $email, $senha, $nomePesquisa){
       
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=login", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
            
            $stmt = $conexao->prepare('UPDATE login_cadastro SET nome = "'.$nome.'", email = "'.$email.'", senha = "'.$senha.'" WHERE nome = "'.$nomePesquisa.'" ');
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
    
    public function delete($nome){
        try{
            $conexao = new PDO("mysql:host=localhost; dbname=login", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
                
            $stmt = $conexao->prepare('DELETE FROM login_cadastro WHERE nome =  "'.$nome.'" ');
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
    
    public function pesquisa($nome, $email){
        try{
                $conexao = new PDO("mysql:host=localhost; dbname=login", "root", "");
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("set names utf8");
                
                 $stmt = $conexao->prepare(' SELECT * FROM login_cadastro WHERE nome like ("'.$nome.'") or email like ("'.$email.'") ');
                /* $stmt->bindParam(1, $nome); 
                 $stmt->bindParam(2, $email);*/
                if ($stmt->execute()) {
                    $aux = 0;
                    $nomes = '';
                    $emails = '';
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        if($rs->nome != null && $rs->nome != '' && $rs->email != null && $rs->email != ''){
                            $nomes[$aux] = $rs->nome.', ';
                            $emails[$aux++] = $rs->email.', '; 
                        }                    
                    }
                    if($nomes != null && $nomes != '' && $emails != null && $emails != ''){
                        $nomes = implode($nomes);
                        $emails = implode($emails);
                        echo json_encode($nomes).' / '.json_encode($emails);
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
}
?>