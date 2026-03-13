CREATE TABLE Alunos (
    AlunoID INT PRIMARY KEY IDENTITY(1,1), 
    Nome VARCHAR(50) NOT NULL,              
    Sobrenome VARCHAR(50) NOT NULL,
    Endereco VARCHAR(150),
    Cidade VARCHAR(50),
    Host VARCHAR(50),
    DataCadastro DATETIME DEFAULT GETDATE() 
);