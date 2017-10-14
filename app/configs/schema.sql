DROP TABLE IF EXISTS cliente;

CREATE TABLE cliente (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255)

);

DROP TABLE IF EXISTS fornecedor;

CREATE TABLE fornecedor (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255)

);

DROP TABLE IF EXISTS produto;

CREATE TABLE produto (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255),
	unidade_medida INT,
	preco_custo FLOAT(10,2),
	preco_venda FLOAT(10,2)

);

DROP TABLE IF EXISTS vendas;

CREATE TABLE vendas (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_cliente INT NOT NULL,
	nome_cliente VARCHAR(255), 
	cpf_cliente VARCHAR(255),
	telefone_cliente VARCHAR(255),
	tipo INT,
	data_venda DATE,
	data_realizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
	valor FLOAT(10,2)
);

DROP TABLE IF EXISTS vendas_produtos;

CREATE TABLE vendas_produtos (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_venda INT NOT NULL,
	id_produto VARCHAR(255), 
	valor_produto FLOAT(10,2),
	qtd_produto VARCHAR(255),
	medida_produto VARCHAR(255),
	data_realizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);
