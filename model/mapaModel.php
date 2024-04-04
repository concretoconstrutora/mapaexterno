<?php

//Retorna apenas os ids
function getAll()
{
    $query = "
        SELECT 
           *
        FROM  ZMDIOTSUBUNIDADE        
        ;";
    return $query;
}

//Retorna todos os dados
function getInstalacoes()
{
    $query = "
    SELECT
        IOT.ID AS 'CODIOTSUBUNIDADE',
        XE.NOMEFANTASIA,
        XE.COD_PESS_EMPR,
        XSU.NUM_UNID,
        XSU.NUM_SUB_UNID,
        IOT.IDCOMPONENTE,
        IOT.ATIVO,
		IOT.DESCRICAO,
		TIPO.TIPO,
        ICOMP.TIMERBOTAO,
        ICOMP.TEMPORIZADOR,
        ICOMP.TIMER

    FROM XEMPREENDIMENTO XE

    LEFT OUTER JOIN XEMPREENDIMENTOCOMPL  XC ON( XE.COD_PESS_EMPR = XC.CODPESSEMPR)
    INNER JOIN XSUBUNIDADE XSU ON (XE.COD_PESS_EMPR = XSU.COD_PESS_EMPR)
    INNER JOIN ZMDIOTSUBUNIDADE IOT ON(XSU.COD_PESS_EMPR = IOT.COD_PESS_EMPR AND 
                                            XSU.NUM_UNID = IOT.NUM_UNID AND 
                                            XSU.NUM_SUB_UNID = IOT.NUM_SUB_UNID)
	INNER JOIN [SRVBD].IOT.dbo.ICOMPONENTE ICOMP ON (ICOMP.CODCOMPONENTE = IOT.IDCOMPONENTE)
	INNER JOIN [SRVBD].IOT.dbo.ITIPO TIPO ON (TIPO.CODTIPO = ICOMP.CODTIPO)
    
    WHERE XC.IOT IN('T')
    ORDER BY XSU.NUM_SUB_UNID
    ;";
    return $query;
}

function getSubUnidades()
{
    $query = "
        SELECT DISTINCT       
            XE.NOMEFANTASIA,
            XE.COD_PESS_EMPR,
            XSU.NUM_UNID,

            XSU.NUM_SUB_UNID
        FROM XEMPREENDIMENTO XE
        LEFT OUTER JOIN XEMPREENDIMENTOCOMPL XC ON( XE.COD_PESS_EMPR = XC.CODPESSEMPR)
        INNER JOIN XSUBUNIDADE XSU ON (XE.COD_PESS_EMPR = XSU.COD_PESS_EMPR)
        WHERE XC.IOT IN('T')
        ORDER BY NUM_SUB_UNID
    ;";
    return $query;
}

function getCodInstalacao($dados)
{
    $query = "
        SELECT 
            ID,
            ATIVO
        FROM  ZMDIOTSUBUNIDADE
        WHERE COD_PESS_EMPR = '" . $dados['codEmpreendimento'] . "' AND 
            NUM_UNID = '" . $dados['numUnidade'] . "' AND
            NUM_SUB_UNID = '" . $dados['numSubUnidade'] . "' AND
            IDCOMPONENTE = '" . $dados['codComponente'] . "'
        ;";
    return $query;
}

function excluir($codInstalacao)
{
    $query = "
        DELETE FROM [ZMDIOTSUBUNIDADE]  
        WHERE ID = " . $codInstalacao . "
    ;";

    return $query;
}

function insert($dados)
{
    $query = "
        INSERT INTO [dbo].[ZMDIOTSUBUNIDADE]
        ([IDCOMPONENTE]
        ,[DESCRICAO]
        ,[ATIVO]
        ,[COD_PESS_EMPR]
        ,[NUM_UNID]
        ,[NUM_SUB_UNID]
        ,[CODIMOVEL]
        ,[CODCOLIMOVEL]
        ,[RECCREATEDBY]
        ,[RECCREATEDON]
        ,[RECMODIFIEDBY]
        ,[RECMODIFIEDON])
    VALUES
        ('" . $dados['codComponente'] . "',
        '" . $dados['apelido'] . "',
        '1',
        '" . $dados['codEmpreendimento'] . "',
        '" . $dados['numUnidade'] . "',
        '" . $dados['numSubUnidade'] . "',
        null,
        null,
        'equipe_ti',
        '" . date("Y-m-d H:i:s") . "',
        'equipe_ti',
        '" . date("Y-m-d H:i:s") . "')
    ;";

    return $query;
}
