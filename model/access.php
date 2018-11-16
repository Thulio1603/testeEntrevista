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
                       throw new PDOException("Erro: Não foi possível executar a declaração sql");
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
            
            $stmt = $conexao->prepare('UPDATE login_cadastro SET nome = "?", email = "?", senha = "?" WHERE nome = "?" ');
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $email);
            $stmt->bindParam(3, $senha);
            $stmt->bindParam(4, $nomePesquisa);

            if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                       throw new PDOException("Erro: Não foi possível executar a declaração sql");
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
                
            $stmt = $conexao->prepare('DELETE FROM login_cadastro WHERE nome =  "?" ');
            $stmt->bindParam(1, $nome);
            if ($stmt->execute()) {
                    if ($stmt->rowCount() > 0) {
                        echo 1;
                    } else {
                        echo 0;
                    }
                } else {
                       throw new PDOException("Erro: Não foi possível executar a declaração sql");
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
                
                 $stmt = $conexao->prepare(' SELECT * FROM login_cadastro WHERE nome = "?" or email = "?" ');
                 $stmt->bindParam(1, $nome); 
                 $stmt->bindParam(2, $email);
                if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {?>
                                <tr>
                                    <td><?php echo $rs->nome;?></td>
                                    <td><?php echo $rs->fone1;?></td>
                                    <td><?php echo $rs->email_principal;?></td>
                                    <td> <button name="alterar" value="<?php echo $rs->pes_id;?>"> Alterar </button> </a> | 
                                    <button name="excluir" value="<?php echo $rs->pes_id;?>">Excluir</button></td> 
                                </tr>                      
                           <?php }
                        } else {
                            echo "Erro: Não foi possível recuperar os dados do banco de dados";
                        }
                } catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
            }
    }
}
?>