<?php
class Access {
    
    public function acesso(){
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=login", "root", "");
            //$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexao->exec("set names utf8");
        } catch (PDOException $erro) {
            echo "Erro na conexгo:" . $erro->getMessage();
        }
    }
    
    public function insert($nome, $email, $senha){
        try {
                $stmt = $conexao->prepare("INSERT INTO login_cadastro (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->bindParam(1, $nome);
                $stmt->bindParam(2, $email);
                $stmt->bindParam(3, $senha);
                 
                if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo "Dados cadastrados com sucesso!";
                    } else {
                        echo "Erro ao tentar efetivar cadastro";
                    }
                } else {
                       throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
    }
    
    public function update($nome, $email, $senha){
        try {
            $stmt = $conexao->prepare('UPDATE login_cadastro SET nome = "?", email = "?", 
            senha = "?" WHERE nome = "?" ');
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(1, $senha);
            if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo "Dados cadastrados com sucesso!";
                    } else {
                        echo "Erro ao tentar efetivar cadastro";
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
            $stmt = $conexao->prepare('DELETE FROM login_cadastro WHERE nome =  "?"');
            $stmt->bindParam(1, $nome);
            if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo "Dados cadastrados com sucesso!";
                    } else {
                        echo "Erro ao tentar efetivar cadastro";
                    }
                } else {
                       throw new PDOException("Erro: Nгo foi possнvel executar a declaraзгo sql");
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }  
    }
}
?>