USE [artimage]
GO

/****** Object:  Table [dbo].[Composi]    Script Date: 01/16/2013 18:36:57 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE composicao (
	Codigo varchar(5) NULL,
	Linha varchar(5) NULL,
	Descricao varchar(100) NULL
);



select 'insert into composicao values (''' + codigo + ''',''' + linha + ''',''' + descricao + ''');'
from composi
GO

select * from composi

select id, nome, artista, preco, foto, composicao, descricao from produto p, composicao c 
where p.composicao = c.codigo and artista = 'artista9' and referencia = '' order by nome, linha

select id, nome, artista, preco, foto, composicao, descricao from produto p, composicao c 
where p.composicao = c.codigo and produto = 'FA0164A-PO' and referencia = '' order by nome, linha
-- busca referencia
select id, nome from produto 
where referencia = 'FA0164A-PO' order by nome

select * from produtos


