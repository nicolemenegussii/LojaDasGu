    CREATE DATABASE lojinha;
    USE lojinha;

    CREATE TABLE produto (
    id_produto BIGINT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nome_produto VARCHAR(100) NOT NULL,
    categoria_produto VARCHAR(50) NOT NULL,
    descricao_produto TEXT NOT NULL,
    fornecedor_produto VARCHAR(100) NOT NULL,
    valor_produto DECIMAL(10,2) NOT NULL,
    unidadeDeMedida_produto VARCHAR(20) NOT NULL,
    quantidade INT NOT NULL,
    url_foto_produto VARCHAR(255)
    );
    create table cliente(
    id_cliente BIGINT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(100) NOT NULL,
    cpf_cliente CHAR(11) UNIQUE NOT NULL,
    email_cliente VARCHAR(100),
    senha_cliente VARCHAR(50),
    numero_cliente VARCHAR(20),
    endereco_cliente VARCHAR(150)
    );
    CREATE TABLE pedido (
    id_pedido BIGINT AUTO_INCREMENT PRIMARY KEY,
    data_pedido DATE NOT NULL,
    id_expedicao BIGINT NOT NULL,
    id_cliente BIGINT NOT NULL,                                                                                  
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
    );
    CREATE TABLE produto_pedido (
    id_produto BIGINT NOT NULL,
    quantidade_produtoPedido INT NOT NULL,
    id_pedido BIGINT NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produto(id_produto),
    FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido)
    );
    CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
    );
    
    TRUNCATE TABLE administradores;
    -- Insere os admins 
    INSERT INTO administradores (usuario, senha) VALUES 
    ('admin', '$2a$10$cTkdTpBTsvGvwzSQ8ngQbu9hkGZ/e4D8iW/BmED4Nh7AoFD.JL1kq');

    -- JOIN
    -- quem fez o pedido (pedido + cliente)
    -- SELECT p.id_pedido, p.data_pedido, c.nome_cliente AS pedido_mais_cliente
    -- FROM cliente c
    -- JOIN pedido p
    -- ON c.id_cliente = p.id_cliente;

    -- VIEW

    -- produtos apenas por nome e categoria
    -- CREATE VIEW view_estoque_produto AS view_produto
    -- SELECT nome_produto, categoria_produto
    --  FROM produto;

    -- SELECT * FROM view_produto;


    -- AGREGAÇÃO

    -- quantos produtos existem
    -- SELECT COUNT(*) AS total_produtos
    -- FROM produto;

    -- produto mais caro e mais barato
    -- SELECT MAX(valor_produto) AS produto_mais_caro, MIN(valor_produto) AS produto_mais_barato
    -- FROM produto;

    -- valor médio produtos
    --  SELECT AVG(valor_produto) AS preco_medio
    -- FROM produto;


    -- GROUP BY

    -- quantos pedidos existem em uma expedição
    -- SELECT e.id_expedicao, COUNT(p.id_pedido) AS total_pedidos
    -- FROM expedicao e
    -- JOIN pedido p
    -- ON e.id_expedicao = p.id_expedicao
    -- GROUP BY e.id_expedicao;


    -- HAVING

    -- expedição com mais de 5 pedidos
    -- SELECT e.id_expedicao, COUNT(p.id_pedido) AS total_pedidos
    -- FROM expedicao e
    -- JOIN pedido p
    -- ON e.id_expedicao = p.id_expedicao
    -- GROUP BY e.id_expedicao
    -- HAVING COUNT(p.id_pedido) > 5;