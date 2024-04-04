<?php

// header("Cache-Control: no-cache, no-store, must-revalidate");
header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=utf-8");

include("./config/conn.php");
include("./model/instalacaoModel.php");
include("./model/logModel.php");


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "retornarSubUnidadesCadastradas":
                retornarSubUnidadesCadastradas();
                break;
            case "retornarInstalacoesIDs":
                retornarInstalacoesIDs();
                break;
            case "retornarInstalacoes":
                retornarInstalacoes();
                break;
            default:
                break;
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case "registrarCheck": 
                registrarCheck();
                break;
            default:
                break;
        }
    }
}

function conectar()
{
    $conn = new SQLServer();
    $conn->CorporeRM();
    $conn->conectar();

    return $conn;
}

//Retorna todos os dados completos
function retornarInstalacoes()
{
    $conn = conectar();
    $conn->executarQuery(getInstalacoes());
    $itens = array();
    while ($rows = $conn->fetchArray()) {
        $itens[] = array(
            "id" => $rows['CODIOTSUBUNIDADE'],
            "nomeFantasia" => $rows['NOMEFANTASIA'],
            "codEmpreendimento" => $rows['COD_PESS_EMPR'],
            "numUnidade" => $rows['NUM_UNID'],
            "numSubUnidade" => $rows['NUM_SUB_UNID'],
            "codComponente" => $rows['IDCOMPONENTE'],
            "ativo" => $rows['ATIVO'],
            "descricao" => $rows['DESCRICAO'],
            "tipo" => $rows['TIPO'], 
            "timerBotao" => $rows['TIMERBOTAO'], 
            "temporizador" => $rows['TEMPORIZADOR'] ,
            "timer" => $rows['TIMER']      
        );
    }

    echo json_encode($itens);
}

function retornarSubUnidadesCadastradas()
{   
    $conn = conectar();
    $conn->executarQuery(getSubUnidades());
    $itens = array();
    while ($rows = $conn->fetchArray()) {
        $itens[] = array(
            "nomeFantasia" => $rows['NOMEFANTASIA'],
            "codEmpreendimento" => $rows['COD_PESS_EMPR'],
            "numUnidade" => $rows['NUM_UNID'],
            "numSubUnidade" => $rows['NUM_SUB_UNID']
        );
    }

    echo json_encode($itens);
}

//Retorna apenas ids
function retornarInstalacoesIDs()
{
    $conn = conectar();
    $conn->executarQuery(getAll());
    $itens = array();
    while ($rows = $conn->fetchArray()) {
        $itens[] = array(
            "id" => $rows['ID'],
            "codComponente" => $rows['IDCOMPONENTE'],
            "descricao" => $rows['DESCRICAO'],
            "ativo" => $rows['ATIVO'],
            "codEmpreendimento" => $rows['COD_PESS_EMPR'],
            "numUnidade" => $rows['NUM_UNID'],
            "numSubUnidade" => $rows['NUM_SUB_UNID']
        );
    }

    echo json_encode($itens);
}

function registrarCheck() //TODO_MIX: trocar o nome
{
    $conn = conectar();
    $dados = $_POST['dadosInstalacao'];

    //Verificar se já existe essa instalação
    $conn->executarQuery(getCodInstalacao($dados));

    $codInstalacao = null;
    while ($rows = $conn->fetchArray()) {
        $codInstalacao = $rows['ID'];
    }

    if ($codInstalacao == null) {
        //INSERIR
        $exec = $conn->executarQueryIUD(insert($dados));

        if ($exec) {
            $response['mensagem'] = "Sucesso! A instalação foi inserida corretamente!";
            $response['status'] = 'success';
        } else {
            $response['mensagem'] = "Erro! A instalação não foi inserida!";
            $response['status'] = 'erro';
        }

        //LOG
        $mensagemLOG = "INSTALAÇÃO REGISTRADA: " . "SUBUNIDADE: " . $dados['numSubUnidade'] . " - COMPONENTE: " .  $dados['codComponente'];
    } else {
        //EXCLUIR            
        $exec = $conn->executarQueryIUD(excluir($codInstalacao));

        if ($exec) {
            $response['mensagem'] = "Sucesso! A instalação foi excluída corretamente!";
            $response['status'] = 'success';
        } else {
            $response['mensagem'] = "Erro! A instalação não foi excluída!";
            $response['status'] = 'erro';
        }

        //LOG
        $mensagemLOG = "INSTALAÇÃO REMOVIDA: " . "SUBUNIDADE: " . $dados['numSubUnidade'] . " - COMPONENTE: " .  $dados['codComponente'];
    }
    echo (json_encode($response));
}
