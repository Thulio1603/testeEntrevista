Olá, Bem vindo ao meu CRUD.

Para rodar essa aplicação primeiro devemos instalar o banco de dados na sua máquina,
ou também podemos usar o xampp ou wamp.

Com o banco de dados instalado devemos rodar as seguintes 
query no banco(para facilitar pode dar um ctrl + c e ctrl + v).

CREATE DATABASE loja;

CREATE TABLE cliente (id int PRIMARY KEY AUTO_INCREMENT, nome varchar(50), email varchar(50), telefone float);

CREATE TABLE produto (id int PRIMARY KEY AUTO_INCREMENT, nome varchar(50), descricao varchar(50), preco float);

CREATE TABLE pedidos (id int PRIMARY KEY AUTO_INCREMENT, data_criacao date, cliente int , produto int, qtde int, FOREIGN KEY(cliente) REFERENCES cliente(id), FOREIGN KEY(produto) REFERENCES produto(id));

Prontinho, agr é rodar nossa aplicação abrindo pelo arquivo index.html da pasta view e inserir, atualizar, pesquisar e deletar
produtos, clientes e pedidos. ATENÇÃO para com os nomes.

Obrigado, atenciosamente Thulio Ramos