<?php

header('Content-Type: text/html; charset=UTF-8');
include("../config/conn.php");
include("../model/mapaModel.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "retornarMapa":
                retornarMapa();
                break;
            case "retornarTotalizador":
                retornarTotalizador();
                break;
            case "retornarTorres":
                retornarTorres();
                break;
        }
    }
}

function retornarTotalizador()
{

    $conn = new SQLServer();
    $conn->CorporeRM();
    $conn->conectar();
    $conn->conectarBanco();

    $empree = $_GET['codEmpre'];
    $torre = $_GET['torre'];

    $sql = SQLEmpreendSubUnidTOT($empree, $torre);
    $conn->executarQuery($sql);

    $itens = array();
    while ($rows = $conn->fetchArray()) {

        $item = array(
            "disponivel" => $rows['DISPONIVEL'],
            "indisponivel" => $rows['VENDIDO'] + $rows['ALUGADO'] + $rows['RESERVADO'] + $rows['COMERCIAL'] + $rows['PERMUTA']
        );

        // Adicionar o item ao array de itens
        array_push($itens, $item);
    }

    echo json_encode($itens);
}

function retornarMapa()
{

    $conn = new SQLServer();
    $conn->CorporeRM();
    $conn->conectar();
    $conn->conectarBanco();

    $empree = $_GET['codEmpre'];
    $torre = $_GET['torre'];

    // 1- Buscar num_unid
    $sql = SQLEmpreendUNIDTORRE($empree, $torre);
    $conn->executarQuery($sql);
    while ($rows = $conn->fetchArray()) {
        $numUnid = $rows['NUM_UNID'];
    }

    // 2- Buscar andares
    $sql = SQLEmpreendSubAndar($empree, $numUnid);
    $conn->executarQuery($sql);

    $itens = array();
    while ($rowsAndar = $conn->fetchArray()) {
        $andar = $rowsAndar['ANDAR'];

        // 3- Buscar unidades por andar 
        $sql2 = SQLEmpreendSubUnid($empree, $numUnid, $andar);
        $conn->executarQuery2($sql2);

        while ($rowsUnidade = $conn->fetchArray2()) {
            $itens[] = array(
                "andarUnidade" =>  $andar . '-' .
                    $rowsUnidade['NUM_SUB_UNID'] . '-' .
                    $rowsUnidade['COR'] . '-' .
                    $rowsUnidade['VENDA'] . '-' .
                    $rowsUnidade['DATAVENDA'] . '-' .
                    $rowsUnidade['STATUSVENDA'] . '-' .
                    $rowsUnidade['CLIENTE']
            );
        }
    }
    echo json_encode($itens);
}

function retornarTorres()
{
    $EMPREE = $_GET['codEmpree'];

    $conn = new SQLServer();
    $conn->CRM();
    $conn->conectar();
    $conn->conectarBanco();

    $conn->executarQuery(SQLEmpreendUNID($EMPREE));

    $itens = array();
    while ($rows = $conn->fetchArray()) {
        $itens[] = array(
            "numUnid2" => $rows['NUM_UNID2'],
            "numUnid" => $rows['NUM_UNID']
        );
    }

    // Função de comparação para ordenar por 'numUnid2'
    function compare($a, $b)
    {
        return strcmp($a['numUnid2'], $b['numUnid2']);
    }

    // Ordena o array utilizando a função de comparação
    usort($itens, 'compare');

    echo json_encode($itens);
}
