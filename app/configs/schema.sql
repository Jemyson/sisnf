CREATE TABLE cliente (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255)

);

CREATE TABLE produto (

	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(255),
	unidade_medida INT,
	preco_custo FLOAT(10,2),
	preco_venda FLOAT(10,2)

);