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
            "vendido" => $rows['VENDIDO'],
            "alugado" => $rows['ALUGADO'],
            "reservado" => $rows['RESERVADO'],
            "comercial" => $rows['COMERCIAL'],
            "disponível" => $rows['DISPONIVEL'],
            "permuta" => $rows['PERMUTA']
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