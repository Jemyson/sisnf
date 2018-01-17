DROP TABLE IF EXISTS config;

CREATE TABLE config (

	numeroNfe INT NOT NULL DEFAULT 0,
	ambiente INT,
	cnpj VARCHAR(255) NOT NULL PRIMARY_KEY,
	cep VARCHAR(255),
	endereco VARCHAR(255),
	numero VARCHAR(255),
	uf VARCHAR(255),
	bairro VARCHAR(255),
	cidade VARCHAR(255),
	inscricaoEstadual VARCHAR(255)
	
);

DROP TABLE IF EXISTS cliente;

CREATE TABLE cliente (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255),
	cpf VARCHAR(255),
	cnpj VARCHAR(255),
	cep VARCHAR(255),
	endereco VARCHAR(255),
	numero VARCHAR(255),
	bairro VARCHAR(255),
	cidade VARCHAR(255),
	cod_cidade VARCHAR(255),
	uf VARCHAR(255),
	telefone VARCHAR(255),
	celular VARCHAR(255),
	email VARCHAR(255),
	indicacaoIe VARCHAR(255) DEFAULT '9',
	excluido INT DEFAULT 0

);

DROP TABLE IF EXISTS fornecedor;

CREATE TABLE fornecedor (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255),
  cpf VARCHAR(255),
  cnpj VARCHAR(255),
	cep VARCHAR(255),
	endereco VARCHAR(255),
	numero VARCHAR(255),
	bairro VARCHAR(255),
	cidade VARCHAR(255),
	cod_cidade VARCHAR(255),
	uf VARCHAR(255),
	telefone VARCHAR(255),
	celular VARCHAR(255),
	email VARCHAR(255),
	excluido INT DEFAULT 0

);

DROP TABLE IF EXISTS transportadora;

CREATE TABLE transportadora (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255),
	cpf VARCHAR(255),
	cnpj VARCHAR(255),
	cep VARCHAR(255),
	endereco VARCHAR(255),
	numero VARCHAR(255),
	bairro VARCHAR(255),
	cidade VARCHAR(255),
	cod_cidade VARCHAR(255),
	uf VARCHAR(255),
	telefone VARCHAR(255),
	celular VARCHAR(255),
	email VARCHAR(255),
	excluido INT DEFAULT 0

);

DROP TABLE IF EXISTS categoria;

CREATE TABLE categoria (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(255),
	excluido INT DEFAULT 0
);

DROP TABLE IF EXISTS subcategoria;

CREATE TABLE subcategoria (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_categoria INT NOT NULL,
	nome VARCHAR(255),
	excluido INT DEFAULT 0
);

DROP TABLE IF EXISTS produto;

CREATE TABLE produto (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_categoria INT NOT NULL,
	id_subcategoria INT NOT NULL,
	nome VARCHAR(255),
	unidade_medida VARCHAR(255) DEFAULT 'UN',
	preco_custo FLOAT(10,2),
	preco_venda FLOAT(10,2),
	preco_venda_avista FLOAT(10,2),
	qtd INT DEFAULT 0,
	ncm VARCHAR(255),
	cfop VARCHAR(255),
	excluido INT DEFAULT 0

);

DROP TABLE IF EXISTS vendas;

CREATE TABLE vendas (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_cliente INT NOT NULL,
	nome_cliente VARCHAR(255), 
	cpf_cliente VARCHAR(255),
	telefone_cliente VARCHAR(255),
	tipo INT,
	forma_pagamento VARCHAR(255),
	parcelas INT,
	data_venda DATE,
	data_realizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
	valor FLOAT(10,2),
	status INT,
	chave VARCHAR(255),
	nfe VARCHAR(255),
	excluido INT DEFAULT 0
);

DROP TABLE IF EXISTS vendas_produtos;

CREATE TABLE vendas_produtos (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	id_venda INT NOT NULL,
	id_produto VARCHAR(255), 
	nome_produto VARCHAR(255),
	valor_produto FLOAT(10,2),
	qtd_produto VARCHAR(255),
	medida_produto VARCHAR(255),
	data_realizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
	excluido INT DEFAULT 0
);

CREATE TABLE entrada (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nota_fiscal INT,
	data_nota_fiscal DATE,
	id_fornecedor INT,
	nome_fornecedor VARCHAR(255),
	data_entrada DATE,
	data_realizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP()

);
